<?php

namespace Diwoo\Bundle\BlogBundle\Controller;

use Diwoo\Bundle\BlogBundle\Entity\Articles;
use Diwoo\Bundle\BlogBundle\Entity\Auteurs;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
        $entityRepository = $doctrine->getRepository('DiwooBlogBundle:Articles');
        $resultat = $entityRepository->findAll();

        return $this->render('DiwooBlogBundle:Default:blog.html.twig', ['liste' => $resultat]);
    }

    public function creeAction()
    {
        return $this->render('DiwooBlogBundle:Default:ajouterOk.html.twig');
    }

    public function ajouterAuteurAction(Request $requete)
    {
        //structure des données a traiter
        $auteur = new \Diwoo\Bundle\BlogBundle\Entity\Auteurs();

        // Objet de creation du formulaire
        $formBuilder = $this->createFormBuilder($auteur);

        // parametres du formulaire
        $formBuilder->add('prenom', TextType::class, array('label'=>'Prenom :'));
        $formBuilder->add('nom', TextType::class, array('label'=>'Nom :'));
        $formBuilder->add('pseudo', TextType::class, array('label'=>'Login :'));
        $formBuilder->add('mdp', PasswordType::class, array('label'=>'MDP :'));
        // exemple de liste déroulante à partir d'une entité
        /*
        $formBuilder->add('article', EntityType::class, array(
            'class'=>'DiwooBlogBundle:Articles',
            'choice_label' => 'title',
            'query_builder' => function( EntityRepository $entity){
                $objectTypeQuery = $entity->createQueryBuilder('reqSQL');
                $objectTypeQuery->where('reqSQL.id = :idArticle');
                $objectTypeQuery->setParameter('idArticle', 1);
                return $objectTypeQuery;
            }
            ));
        */
        $formBuilder->add('create', SubmitType::class, array('label' => 'Envoi'));

        // Récuperation de la structure du formulaire
        $formTypeForm = $formBuilder->getForm();

        /************************************************************************/

        // validation du formulaire
        $formTypeForm->handleRequest($requete);
        // test de summition et de validation des entrées
        if($formTypeForm->isSubmitted() && !$formTypeForm->isEmpty()){
            // enregistrement des données
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            // auteur est une reference
            $entityManager->persist($auteur);
            $entityManager->flush();

            // rediretion sur la page de finalisation
            return $this->redirect($this->generateUrl('diwoo_blog_ajouter_ok'));
        }

        /************************************************************************/

        $formTypeFormView = $formTypeForm->createView();

        return $this->render('DiwooBlogBundle:Default:ajouterAuteur.html.twig', array( 'formulaireAjout' => $formTypeFormView, 'req' => $requete ));
    }

    public function ajouterArticleAction(Request $requete)
    {
        $_SESSION['user'] = 2;
        //structure des données a traiter
        $article = new \Diwoo\Bundle\BlogBundle\Entity\Articles();

        $formTypeForm = $this->formulaireArticle($article);

        /************************************************************************/

        // validation du formulaire
        $formTypeForm->handleRequest($requete);
        // test de summition et de validation des entrées
        if($formTypeForm->isSubmitted() && !$formTypeForm->isEmpty()){
            // enregistrement des données
            // recuperation des données triates
            $doctrine = $this->getDoctrine();
            $entityRepository = $doctrine->getRepository('DiwooBlogBundle:Auteurs');
            $auteur = $entityRepository->find($_SESSION['user']);

            $article->setAuteur($auteur);
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            // rediretion sur la page de finalisation
            return $this->redirect($this->generateUrl('diwoo_blog_ajouter_ok'));
        }

        /************************************************************************/

        $formTypeFormView = $formTypeForm->createView();
        return $this->render('DiwooBlogBundle:Default:ajouterAuteur.html.twig', array( 'formulaireAjout' => $formTypeFormView, 'req' => $requete ));
    }

    public function formulaireArticle($article)
    {
        // Objet de creation du formulaire
        $formBuilder = $this->createFormBuilder($article);

        // parametres du formulaire
        $formBuilder->add('title', TextType::class, array('label'=>'titre :'));
        $formBuilder->add('content', TextareaType::class, array('label'=>'Texte :'));
        $formBuilder->add('picture', FileType::class, array('label'=>'Image :'));
        // exemple de liste déroulante à partir d'une entité
        $formBuilder->add('create', SubmitType::class, array('label' => 'Envoi'));

        // Récuperation de la structure du formulaire
        return $formBuilder->getForm();
    }

    public function supprimerAction($id)
    {
        // utilisation de Doctrine
        $doctrine = $this->getDoctrine();
        $entityRepository = $doctrine->getRepository('DiwooBlogBundle:Articles');
        $existant = $entityRepository->findOneBy(array('id' => $id));

        $entityManager = $doctrine->getManager();
        $entityManager->remove($existant);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('diwoo_blog_homepage'));
    }

    public function modifierAction(Request $requete, Articles $article)
    {
        $_SESSION['user'] = 2;
        //structure des données a traiter
        // SANS UTILISATION DE DOCTRINE -> Injection de dépendances
        $formTypeForm = $this->formulaireArticle($article);

        /************************************************************************/

        // validation du formulaire
        $formTypeForm->handleRequest($requete);
        // test de summition et de validation des entrées
        if($formTypeForm->isSubmitted() && !$formTypeForm->isEmpty()){
            // enregistrement des données
            // recuperation des données triates
            $doctrine = $this->getDoctrine();
            $entityRepository = $doctrine->getRepository('DiwooBlogBundle:Auteurs');
            $auteur = $entityRepository->find($_SESSION['user']);

            $article->setAuteur($auteur);
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            // rediretion sur la page de finalisation
            return $this->redirect($this->generateUrl('diwoo_blog'));
        }

        /************************************************************************/

        $formTypeFormView = $formTypeForm->createView();

        return $this->render('DiwooBlogBundle:Default:ajouterAuteur.html.twig', array( 'formulaireAjout' => $formTypeFormView, 'req' => $requete ));
    }

}
