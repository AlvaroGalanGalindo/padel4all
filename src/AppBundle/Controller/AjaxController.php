<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
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
        $partidoId = $request->get('partidoId');
        $jugador = $this->getUser();
        $jugador_nombre = $jugador->getNickNombre();
        $resultado = false;
        $mensaje = "";

        $partido = $em->getRepository('AppBundle:Partido')->find($partidoId);
        if (!$partido->UserInPartido($jugador)) {
            $resultado = $this->addUserToPartido($partidoId, $jugador->getId(), $posicion);
            if ($resultado) { $mensaje = "¡Te has apuntado al partido!"; }
        } else {
            $mensaje = "¡Ya estás en este partido!";
        }

        $response = array("jugador" => $jugador_nombre, "success" => $resultado, "mensaje" => $mensaje);
        return new Response(json_encode($response));
    }

    private function addUserToPartido($partidoId, $userId, $posicion)
    {
        $em = $this->getDoctrine()->getManager();
        $partido = $em->getRepository('AppBundle:Partido')->find($partidoId);
        $user = $em->getRepository('AppBundle:User')->find($userId);

        if (!$partido || !$user) {
            return false;
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

