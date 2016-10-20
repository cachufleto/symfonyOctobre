<?php

namespace Sami\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($x, $y)
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
}
