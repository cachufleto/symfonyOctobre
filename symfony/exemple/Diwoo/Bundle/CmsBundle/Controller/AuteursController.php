<?php

namespace Diwoo\Bundle\CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Diwoo\Bundle\CmsBundle\Entity\Auteurs;
use Diwoo\Bundle\CmsBundle\Form\AuteursType;

/**
 * Auteurs controller.
 *
 */
class AuteursController extends Controller
{
    /**
     * Lists all Auteurs entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $auteurs = $em->getRepository('DiwooCmsBundle:Auteurs')->findAll();

        return $this->render('DiwooCmsBundle:auteurs:index.html.twig', array(
            'auteurs' => $auteurs,
        ));
    }

    /**
     * Creates a new Auteurs entity.
     *
     */
    public function newAction(Request $request)
    {
        $auteur = new Auteurs();
        $form = $this->createForm('Diwoo\Bundle\CmsBundle\Form\AuteursType', $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            return $this->redirectToRoute('auteurs_show', array('id' => $auteur->getId()));
        }

        return $this->render('DiwooCmsBundle:auteurs:new.html.twig', array(
            'auteur' => $auteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Auteurs entity.
     *
     */
    public function showAction(Auteurs $auteur)
    {
        $deleteForm = $this->createDeleteForm($auteur);

        return $this->render('DiwooCmsBundle:auteurs:show.html.twig', array(
            'auteur' => $auteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Auteurs entity.
     *
     */
    public function editAction(Request $request, Auteurs $auteur)
    {
        $deleteForm = $this->createDeleteForm($auteur);
        $editForm = $this->createForm('Diwoo\Bundle\CmsBundle\Form\AuteursType', $auteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            return $this->redirectToRoute('auteurs_edit', array('id' => $auteur->getId()));
        }

        return $this->render('DiwooCmsBundle:auteurs:edit.html.twig', array(
            'auteur' => $auteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Auteurs entity.
     *
     */
    public function deleteAction(Request $request, Auteurs $auteur)
    {
        $form = $this->createDeleteForm($auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($auteur);
            $em->flush();
        }

        return $this->redirectToRoute('auteurs_index');
    }

    /**
     * Creates a form to delete a Auteurs entity.
     *
     * @param Auteurs $auteur The Auteurs entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Auteurs $auteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auteurs_delete', array('id' => $auteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
