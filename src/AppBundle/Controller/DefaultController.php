<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Default controller.
 *
 * Controlador por defecto
 */
class DefaultController extends Controller
{
    /**
     * Acción para el homepage. Obtiene listados de últimos partidos pendientes y jugados.
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ultimos_no_jugados = $em->getRepository('AppBundle:Partido')->findUltimosOrderedByFechaDesc(false);
        $ultimos_jugados = $em->getRepository('AppBundle:Partido')->findUltimosOrderedByFechaDesc(true);

        // replace this example code with whatever you need
        return $this->render('@App/default/index.html.twig', array(
            'ultimos_no_jugados' => $ultimos_no_jugados,
            'ultimos_jugados' => $ultimos_jugados,
        ));
    }
}
