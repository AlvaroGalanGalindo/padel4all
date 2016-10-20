<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Partido;

class PartidoService {

    /**
     *
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Check if Pista is in use by another Partido at the same time.
     *
     * @param Partido $partido
     *
     * @return string
     */
    public function getErrorPistaOccupied(Partido $partido)
    {
        $mensaje_error = "";

        $reserva = $this->em->getRepository('AppBundle:Partido')->getPartidoAtPistaFecha(
            empty($partido->getId()) ? 0 : $partido->getId(),
            $partido->getPista()->getId(),
            $partido->getFecha()
        );

        if (!empty($reserva)) {
            $desde = $reserva->getFecha()->format('H:i');
            $hasta = $reserva->getFechaFin()->format('H:i');
            $mensaje_error = "Pista ya reservada de $desde a $hasta";
        }

        return $mensaje_error;
    }

    /**
     * Check if User is assigned in another Partido at the same time.
     *
     * @param Partido $partido
     *
     * @return string
     */
    public function getErrorUserOccupied(Partido $partido, $user_id = null)
    {
        $mensaje_error = "";

        $usuarios = [];
        if (!empty($user_id)) { $usuarios[] = $user_id; }
        if (!empty($partido->getP1j1())) { $usuarios[] = $partido->getP1j1()->getId(); }
        if (!empty($partido->getP1j2())) { $usuarios[] = $partido->getP1j2()->getId(); }
        if (!empty($partido->getP2j1())) { $usuarios[] = $partido->getP2j1()->getId(); }
        if (!empty($partido->getP2j2())) { $usuarios[] = $partido->getP2j2()->getId(); }

        if (count($usuarios) > 0) {
            $reserva = $this->em->getRepository('AppBundle:Partido')->getPartidoWithUserFecha(
                empty($partido->getId()) ? 0 : $partido->getId(),
                $usuarios,
                $partido->getFecha()
            );

            if (!empty($reserva)) {
                $desde = $reserva->getFecha()->format('H:i');
                $hasta = $reserva->getFechaFin()->format('H:i');
                $pista = $reserva->getPista()->getPropietario() . " - " . $reserva->getPista()->getNombre();
                $mensaje_error = empty($user_id)
                    ? "Hay algún jugador que en esa fecha estará jugando en la pista $pista de $desde a $hasta"
                    : "Ya tienes partido a esa hora en la pista $pista de $desde a $hasta";
            }
        }

        return $mensaje_error;
    }

}