<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PartidoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartidoRepository extends EntityRepository
{
    public function getPartidoAtPistaFecha($partido_id, $pista_id, $fecha_reserva){

        $fecha_reserva_fin = new \DateTime($fecha_reserva->format('Y-m-d H:i'));
        $fecha_reserva_fin->modify("+90 minutes");

        $partido = $this->createQueryBuilder('p')
            ->select('p')
            ->join('p.pista','t')
            ->where('t.id = :pista_id')
            ->andWhere('p.id <> :partido_id')
            ->andWhere(':fecha_reserva BETWEEN p.fecha AND p.fecha_fin OR :fecha_reserva_fin BETWEEN p.fecha AND p.fecha_fin')
            ->setParameter('pista_id', $pista_id)
            ->setParameter('partido_id', $partido_id)
            ->setParameter('fecha_reserva', $fecha_reserva)
            ->setParameter('fecha_reserva_fin', $fecha_reserva_fin)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $partido;
    }
}
