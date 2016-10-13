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

        return $this->render('@App/resultado/index.html.twig', array(
            'resultados' => $resultados,
        ));
    }

    /**
     * Creates a new Resultado entity.
     *
     * @Route("/new", name="resultados_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $resultado = new Resultado();
        $form = $this->createForm('AppBundle\Form\ResultadoType', $resultado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultado);
            $em->flush();

            return $this->redirectToRoute('resultados_show', array('id' => $resultado->getId()));
        }

        return $this->render('@App/resultado/new.html.twig', array(
            'resultado' => $resultado,
            'form' => $form->createView(),
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
        $deleteForm = $this->createDeleteForm($resultado);
        $editForm = $this->createForm('AppBundle\Form\ResultadoType', $resultado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultado);
            $em->flush();

            return $this->redirectToRoute('resultados_edit', array('id' => $resultado->getId()));
        }

        return $this->render('@App/resultado/edit.html.twig', array(
            'resultado' => $resultado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
        $form = $this->createDeleteForm($resultado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resultado);
            $em->flush();
        }

        return $this->redirectToRoute('resultados_index');
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
