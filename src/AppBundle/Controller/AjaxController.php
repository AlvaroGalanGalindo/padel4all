<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 */
class AjaxController extends Controller
{
    /**
     * Displays a form to edit an existing Partido entity.
     *
     * @Route("/ajax_usermatch", name="ajax_usermatch")
     * @Method({"GET", "POST"})
     */
    public function userMatchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posicion = $request->get('posicion');
        $quitar = "true" == $request->get('quitar');
        $partidoId = $request->get('partido_id');
        $jugador = $this->getUser();
        $jugador_nombre = $jugador->getUsername();
        $resultado = false;
        $mensaje = "";

        $partido = $em->getRepository('AppBundle:Partido')->find($partidoId);
        if ($quitar || !$partido->UserInPartido($jugador)) {
            $error_jugador = $this->get('app.partido_service')->getErrorUserOccupied($partido, $jugador->getId());
            if (!empty($error_jugador)) {
                $mensaje = $error_jugador;
            } else {
                $resultado = $this->addUserToPartido($partidoId, $jugador->getId(), $posicion, $quitar);
                if ($resultado) {
                    $mensaje = $quitar ? "¡Te has quitado del partido!" : "¡Te has apuntado al partido!";
                }
            }
        } else {
            $mensaje = "¡Ya estás apuntado en este partido!";
        }

        $response = array("jugador" => $jugador_nombre, "success" => $resultado, "mensaje" => $mensaje);
        return new Response(json_encode($response));
    }

    private function addUserToPartido($partidoId, $userId, $posicion, $quitar)
    {
        $em = $this->getDoctrine()->getManager();
        $partido = $em->getRepository('AppBundle:Partido')->find($partidoId);
        $user = null;

        if (!$quitar) {
            $user = $em->getRepository('AppBundle:User')->find($userId);
            if (!$partido || !$user) {
                return false;
            }
        }

        switch ($posicion) {
            case "p1j1": $partido->setP1J1($user); break;
            case "p1j2": $partido->setP1J2($user); break;
            case "p2j1": $partido->setP2J1($user); break;
            case "p2j2": $partido->setP2J2($user); break;
        }

        $em->flush();

        return true;
    }


}

