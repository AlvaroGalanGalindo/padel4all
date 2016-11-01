<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Resultado;
use AppBundle\Form\ResultadoType;

/**
 * Resultado controller.
 *
 * @Route("/resultados")
 */
class ResultadoController extends Controller
{
    /**
     * Lists all Resultado entities.
     *
     * @Route("/", name="resultados_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resultados = $em->getRepository('AppBundle:Resultado')->findAll();
        $admin = $this->get('security.context')->isGranted('ROLE_ADMIN');

        return $this->render('@App/resultado/index.html.twig', array(
            'resultados' => $resultados,
            'admin' => $admin,
        ));
    }

    /**
     * Creates a new Resultado entity.
     *
     * @Route("/new/{id_partido}", name="resultados_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($user)) {
            return $this->redirectToRoute("homepage");
        }

        $resultado = new Resultado();
        $em = $this->getDoctrine()->getManager();

        $partido = $em->getRepository('AppBundle:Partido')->find($request->get('id_partido'));
        $resultado->setPartido($partido);

        $form = $this->createForm('AppBundle\Form\ResultadoType', $resultado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($resultado);
            $em->flush();

            return $this->redirectToRoute('partidos_show', array('id' => $partido->getId()));
        }

        $pareja1 = $partido->getP1J1() . " - " . $partido->getP1J2();
        $pareja2 = $partido->getP2J1() . " - " . $partido->getP2J2();

        return $this->render('@App/resultado/edit.html.twig', array(
            'resultado' => $resultado,
            'form' => $form->createView(),
            'modo' => 'new',
            'pareja1' => $pareja1,
            'pareja2' => $pareja2,
        ));
    }

    /**
     * Finds and displays a Resultado entity.
     *
     * @Route("/{id}", name="resultados_show")
     * @Method("GET")
     */
    public function showAction(Resultado $resultado)
    {
        $deleteForm = $this->createDeleteForm($resultado);

        return $this->render('@App/resultado/show.html.twig', array(
            'resultado' => $resultado,
            'delete_form' => $deleteForm->createView(),
            'admin' => $this->get('security.context')->isGranted('ROLE_ADMIN'),
        ));
    }

    /**
     * Displays a form to edit an existing Resultado entity.
     *
     * @Route("/{id}/edit", name="resultados_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Resultado $resultado)
    {
        $esAdmin = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = is_object($user) ? $user->getId() : 0;

        if (!$esAdmin && $resultado->getPartido()->getUser()->getId() != $user_id) {
            return $this->redirectToRoute("homepage");
        }

        $deleteForm = $this->createDeleteForm($resultado);
        $editForm = $this->createForm('AppBundle\Form\ResultadoType', $resultado);
        $editForm->handleRequest($request);
        $partido = $resultado->getPartido();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultado);
            $em->flush();

            return $this->redirectToRoute('partidos_show', array('id' => $partido->getId()));
        }

        $pareja1 = $partido->getP1J1() . " - " . $partido->getP1J2();
        $pareja2 = $partido->getP2J1() . " - " . $partido->getP2J2();

        return $this->render('@App/resultado/edit.html.twig', array(
            'resultado' => $resultado,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'modo' => 'edit',
            'pareja1' => $pareja1,
            'pareja2' => $pareja2,
        ));
    }

    /**
     * Deletes a Resultado entity.
     *
     * @Route("/{id}", name="resultados_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Resultado $resultado)
    {
        $esAdmin = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = is_object($user) ? $user->getId() : 0;

        if (!$esAdmin && $resultado->getPartido()->getUser()->getId() != $user_id) {
            return $this->redirectToRoute("homepage");
        }

        $form = $this->createDeleteForm($resultado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resultado);
            $em->flush();
        }

        return $this->redirectToRoute('partidos_show', array('id' => $resultado->getPartido()->getId()));
    }

    /**
     * Creates a form to delete a Resultado entity.
     *
     * @param Resultado $resultado The Resultado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Resultado $resultado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resultados_delete', array('id' => $resultado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
