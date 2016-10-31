<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Pista;
use AppBundle\Form\PistaType;

/**
 * Pista controller.
 *
 * @Route("/pistas")
 */
class PistaController extends Controller
{
    /**
     * Lists all Pista entities.
     *
     * @Route("/", name="pista_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (is_object($user)) {
            $user_id = $this->get('security.token_storage')->getToken()->getUser()->getId();

            if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
                $pistas = $em->getRepository('AppBundle:Pista')->findAll();
            } else {
                $pistas = $em->getRepository('AppBundle:Pista')->findBy(array('user' => $user_id));
            }

            return $this->render('AppBundle:pista:index.html.twig', array(
                'pistas' => $pistas,
            ));
        }
        $this->redirect("homepage");
    }

    /**
     * Creates a new Pista entity.
     *
     * @Route("/new", name="pista_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pistum = new Pista();
        $form = $this->createForm('AppBundle\Form\PistaType', $pistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pistum);
            $em->flush();

            return $this->redirectToRoute('pista_show', array('id' => $pistum->getId()));
        }

        $user = $this->get('security.context')->getToken()->getUser();
        $form->get('user')->setData($user);

        return $this->render('AppBundle:pista:edit.html.twig', array(
            'pistum' => $pistum,
            'form' => $form->createView(),
            'modo' => "new",
        ));
    }

    /**
     * Finds and displays a Pista entity.
     *
     * @Route("/{id}", name="pista_show")
     * @Method("GET")
     */
    public function showAction(Pista $pistum)
    {
        $deleteForm = $this->createDeleteForm($pistum);

        return $this->render('AppBundle:pista:show.html.twig', array(
            'pistum' => $pistum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pista entity.
     *
     * @Route("/{id}/edit", name="pista_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pista $pistum)
    {
        $deleteForm = $this->createDeleteForm($pistum);
        $editForm = $this->createForm('AppBundle\Form\PistaType', $pistum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pistum);
            $em->flush();

            return $this->redirectToRoute('pista_edit', array('id' => $pistum->getId()));
        }

        return $this->render('AppBundle:pista:edit.html.twig', array(
            'pistum' => $pistum,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'modo' => 'edit',
        ));
    }

    /**
     * Deletes a Pista entity.
     *
     * @Route("/{id}", name="pista_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pista $pistum)
    {
        $form = $this->createDeleteForm($pistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pistum);
            $em->flush();
        }

        return $this->redirectToRoute('pista_index');
    }

    /**
     * Creates a form to delete a Pista entity.
     *
     * @param Pista $pistum The Pista entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pista $pistum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pista_delete', array('id' => $pistum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
