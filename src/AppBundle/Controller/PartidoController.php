<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Partido;
use AppBundle\Form\PartidoType;

/**
 * Partido controller.
 *
 * @Route("/partidos")
 */
class PartidoController extends Controller
{
    /**
     * Lists all Partido entities.
     *
     * @Route("/", name="partidos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partidos = $em->getRepository('AppBundle:Partido')->findAll();

        return $this->render('@App/partido/index.html.twig', array(
            'partidos' => $partidos,
        ));
    }

    /**
     * Creates a new Partido entity.
     *
     * @Route("/new", name="partidos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $partido = new Partido();
        $form = $this->createForm('AppBundle\Form\PartidoType', $partido);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $error_ocupada = $this->getErrorPistaOccupied($partido);
            if (!empty($error_ocupada)) {
                $form->addError(new FormError($error_ocupada));
            }

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($partido);
                $em->flush();

                return $this->redirectToRoute('partidos_show', array('id' => $partido->getId()));
            }
        }

        return $this->render('@App/partido/new.html.twig', array(
            'partido' => $partido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Partido entity.
     *
     * @Route("/{id}", name="partidos_show")
     * @Method("GET")
     */
    public function showAction(Partido $partido)
    {
        $deleteForm = $this->createDeleteForm($partido);

        return $this->render('@App/partido/show.html.twig', array(
            'partido' => $partido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Partido entity.
     *
     * @Route("/{id}/edit", name="partidos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Partido $partido)
    {
        $deleteForm = $this->createDeleteForm($partido);
        $editForm = $this->createForm('AppBundle\Form\PartidoType', $partido);
        $editForm->handleRequest($request);

        $error_ocupada = $this->getErrorPistaOccupied($partido);
        if (!empty($error_ocupada)) {
            $editForm->addError(new FormError($error_ocupada));
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partido);
            $em->flush();

            return $this->redirectToRoute('partidos_edit', array('id' => $partido->getId()));
        }

        return $this->render('@App/partido/edit.html.twig', array(
            'partido' => $partido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Partido entity.
     *
     * @Route("/{id}", name="partidos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Partido $partido)
    {
        $form = $this->createDeleteForm($partido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partido);
            $em->flush();
        }

        return $this->redirectToRoute('partidos_index');
    }

    /**
     * Creates a form to delete a Partido entity.
     *
     * @param Partido $partido The Partido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partido $partido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partidos_delete', array('id' => $partido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Check if Pista is in use by another Partido at the same time.
     *
     * @param Partido $partido
     *
     * @return string
     */
    private function getErrorPistaOccupied(Partido $partido)
    {
        $mensaje_error = "";

        $em = $this->getDoctrine()->getManager();
        $reserva = $em->getRepository('AppBundle:Partido')->getPartidoAtPistaFecha(
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

}
