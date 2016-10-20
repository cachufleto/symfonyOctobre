<?php

namespace Sami\Bundle\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function voirArticleAction(Request $requete,\Sami\Bundle\BlogBundle\Entity\Posts $article)
    {
      var_dump($article);
      exit();
      
    }


    public function indexAction(Request $requete, $x, $y)
    {
        $doctrine = $this->getDoctrine();

        /**
        * entityRepository : boite à outils pour accéder en lecture à la base de données
        * voir : http://www.doctrine-project.org/api/orm/2.5/class-Doctrine.ORM.EntityRepository.html
        */
        $entityRepository = $doctrine->getRepository('SamiBlogBundle:Users');

        $donnees = $entityRepository->findAll();
        // accède au titre du premier article du premier utilisateur
        //var_dump($donnees[0]->getPosts()[0]->getTitle());

        $entityRepository = $doctrine->getRepository('SamiBlogBundle:Posts');

        $donnees = $entityRepository->findAll();

        // accède au nom d'utilisateur de l'auteur du premier article
        //var_dump($donnees[0]->getUser()->getUsername());

        $entityRepository = $doctrine->getRepository('SamiBlogBundle:Users');

        $donnees = $entityRepository->findOneBy(array(
         'id' => array(1, 2) 
        ));

        //var_dump($donnees);

        $queryBuilder = $entityRepository->createQueryBuilder('users');
        $query = $queryBuilder
                  ->where('users.email = :crepesuzette')
                  ->setParameter('crepesuzette', 'sam@sam.com')
                  ->getQuery();
        $donnees = $query->getResult();

        //var_dump($donnees);

        /**
        * entityManager : boite à outils pour effectuer d'opérations d'insertion, suppression, mise à jour sur la base de données
        * voir : http://www.doctrine-project.org/api/orm/2.5/class-Doctrine.ORM.EntityManager.html
        */

        // Insertion
        /*
        $entityManager = $doctrine->getManager();

        $utilisateur = new \Sami\Bundle\BlogBundle\Entity\Users();

        $utilisateur->setUsername('Raoul');
        $utilisateur->setEmail('raoul@lepitbull.fr');
        $utilisateur->setPassword('zergz87ZRz');

        $entityManager->persist($utilisateur);

        $entityManager->flush();
        */

        // Suppression
        /*
        $entityRepository = $doctrine->getRepository('SamiBlogBundle:Users');
        $utilisateur = $entityRepository->find(3);

        if ($utilisateur) {
          $entityManager = $doctrine->getManager();
          $entityManager->remove($utilisateur);
          $entityManager->flush();
        }
        */
        

        // Mise à jour
        /*
        $entityRepository = $doctrine->getRepository('SamiBlogBundle:Users');
        $utilisateur = $entityRepository->find(2);

        if ($utilisateur) {
          $utilisateur->setUsername('Robert');
          $entityManager = $doctrine->getManager();
          $entityManager->persist($utilisateur);
          $entityManager->flush();
        }
        */

        return $this->render('SamiBlogBundle:Default:index.html.twig');
    }

    public function unbeauformulaireAction(Request $requete){
        // Définir les caractéristiques du formulaire ainsi que la structure de données associée.
        $donnees = array(
          'nombre1' => NULL,
          'nombre2' => NULL,
        );

        $formBuilder = $this->createFormBuilder($donnees);

        $formBuilder->add('nombre1', \Symfony\Component\Form\Extension\Core\Type\NumberType::class, array());
        $formBuilder->add('nombre2', \Symfony\Component\Form\Extension\Core\Type\NumberType::class, array(
          'attr' => array(
            'class' => 'ma-classe-css-perso'
          )
        ));

        $formBuilder->add('envoyer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);

        // Effectuer mes opérations de validation sur le formulaire
        $form = $formBuilder->getForm();

        var_dump($donnees);

        $form->handleRequest($requete);

        // si le formulaire vient d'être soumis (requête POST) et que la requête n'est pas vide
        if ($form->isSubmitted() && !$form->isEmpty()) {
          $donnees = $form->getData();

          var_dump($donnees); //on effectue des traitements puis,
          exit('...redirection vers une autre page ou affichage d\'un autre twig.');
          // return $this->render ...
          // ou
          // return $this->redirect ...
        }

        // Produire l'objet qui sera utilisé pour l'affichage
        $formView = $form->createView();
        
        return $this->render('SamiBlogBundle:Default:unbeauformulaire.html.twig', array('monObjetFormView' => $formView, 'req' => $requete));
    }

    public function dessineMoiUnFormulaire($utilisateur){
      // paramétrage du formulaire
      $objetDeTypeFormBuilder = $this->createFormBuilder($utilisateur);
      $objetDeTypeFormBuilder->add('username', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Nom d\'utilisateur :'));
      $objetDeTypeFormBuilder->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, array('label' => 'Mot de passe :'));
      $objetDeTypeFormBuilder->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, array('label' => 'Adresse de courriel :'));
      // exemple d'utilisation d'entité comme source de données pour alimenter une liste de selection
      /* N'a pas d'utilité dans le cas de la création d'utilisateur...
      $objetDeTypeFormBuilder->add('posts', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
        'class' => 'SamiBlogBundle:Posts',
        'choice_label' => 'title',
        'query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository){
          $objetDeTypeQueryBuilder = $entityRepository->createQueryBuilder('reqSQL');
          $objetDeTypeQueryBuilder->where('reqSQL.title LIKE :texte');
          $objetDeTypeQueryBuilder->setParameter('texte', '%art%');
          return $objetDeTypeQueryBuilder;
        }
      ));
      */
      $objetDeTypeFormBuilder->add('create', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => 'Créér'));

      return $objetDeTypeFormBuilder->getForm();
    }

    public function ajouterUtilisateurAction(Request $requete){

      // structure de données
      $utilisateur = new \Sami\Bundle\BlogBundle\Entity\Users();

      /*$objetDeTypeForm = $this->dessineMoiUnFormulaire($utilisateur);*/

      $objetDeTypeForm = $this->createForm(new \Sami\Bundle\BlogBundle\Form\UsersType(), $utilisateur);

      // validation du formulaire
      $objetDeTypeForm->handleRequest($requete);

      if($objetDeTypeForm->isSubmitted() && !$objetDeTypeForm->isEmpty() && $objetDeTypeForm->isValid()) {
        // enregistrement des données en bdd
        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();
        $entityManager->persist($utilisateur);
        $entityManager->flush();
        return $this->render('SamiBlogBundle:Default:ajouterutilisateur-succes.html.twig');
      }

      // création de l'objet pour l'affichage
      $objetDeTypeformView = $objetDeTypeForm->createView();

      return $this->render('SamiBlogBundle:Default:ajouterutilisateur.html.twig', array('formulaireAjout' => $objetDeTypeformView));
    }
}
