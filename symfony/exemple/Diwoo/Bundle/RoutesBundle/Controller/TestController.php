<?php

namespace Diwoo\Bundle\RoutesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction($fecha = NULL)
    {
        //return $this->render('DiwooRoutesBundle:Default:index.html.twig');
        // REDIRECTION
        $date = strtotime($fecha);
        $url = $this->generateUrl('diwoo_routes_date', array(
            'argumentUn' => $fecha,
            'resultat' => $date,
        ));

        return $this->redirect($url);

    }

    public function deuxArgumentsAction($arg1, $arg2)
    {
        //Action 1 : prend en entrée 2 arguments. Les deux arguments sont obligatoires et sont forcément des nombres.
        // L'action multiplie les nombres entre eux et la vue affiche le calcul effectué ainsi que le résultat du calcul.
        // replace this example code with whatever you need

        return $this->render('DiwooRoutesBundle:Exec:deuxArguments.html.twig', array(
            'argumentUn' => $arg1,
            'argumentDeux' => $arg2,
            'resultatMultiplication' => ($arg1 * $arg2),
        ));
    }

    public function troisArgumentsAction($arg1, $arg2, $arg3)
    {
        //Action 2 : prend en entrée 3 arguments. Les deux premiers arguments sont obligatoires et correspondent
        // forcément à une liste de possibilités autorisées. Le 3ème argument est optionnel. L'action concaténe le
        // premier argument avec le second et la vue affiche dans un premier paragraphe la concaténation effectuée,
        // puis affiche dans un second paragraphe le 3ème argument mais seulement si il est fourni.
        // replace this example code with whatever you need
        return $this->render('DiwooRoutesBundle:Exec:troisArguments.html.twig', array(
            'argumentUn' => $arg1,
            'argumentDeux' => $arg2,
            'argumentTrois' => $arg3,
            'resultatConcatenation' => $arg1 . ' et ' . $arg2,
        ));
    }

    public function dateArgumentsAction($fecha)
    {
        //Action 3 : prend en entrée 1 argument. Cet argument est obligatoire et doit être une date au
        // format YYYY-MM-DD (utiliser une expression régulière). Le traitement transforme cette date en timestamp.
        // La vue affiche la date et affiche le timestamp correspondant.
        // replace this example code with whatever you need
        $date = strtotime($fecha);
        return $this->render('DiwooRoutesBundle:Exec:date.html.twig', array(
            'argumentUn' => $fecha,
            'resultat' => $date,
        ));
    }

}
