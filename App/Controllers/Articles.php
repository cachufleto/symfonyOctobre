<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 12:20
 */
namespace App\Controllers;
//require_once MOD . 'Articles.php';
//require_once CONT . 'superController.php';

class articles extends superController
{
    public function home()
    {
        $model = new \App\Models\Articles();

        // on génere la liste des Articles
        if (!empty($articles = $model->listeArticles())) {
            $listeArticles = count($articles) . ' ARTICLES EN LISTE';
        } else {
            $listeArticles = 'LISTE DES ARTICLES VIDE';
        }
        //include_once 'home.tpl.php';
        $this->render('Articles' . DS . 'home', [
            'title' => "HOME",
            'message' => "Bienvenue à mon BLOG",
            'alert' => '',
            'listeArticles' => $listeArticles,
            'articles' => $articles
        ]);
    }

    public function ajouter()
    {
        $this->session();
        $alert = "";
        $error = false;

        //use App\Models;
        $model = new \App\Models\Articles();

        if ($this->testPost()) {
            // valider les informations
            if (!isset($_POST['titre']) OR empty($_POST['titre'])) {
                $error = true;
                $alert .= "Vous devez renseigner le titre<br>";
            }

            if (!isset($_POST['content']) OR empty($_POST['content'])) {
                $error = true;
                $alert .= "Vous devez renseigner le contenu<br>";
            }

            if (!$error && $model->ajoutArticle($_POST)) {
                $alert = 'Article Ajouté!';
                unset($_POST);
                header('Location:?page=ajouter');
            }

        }

        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';

        // on génere la liste des Articles
        if (!empty($articles = $model->listeArticles())) {
            $listeArticles = 'LISTE DES NOS ' . count($articles) . ' ARTICLES';
        } else {
            $listeArticles = 'LISTE DES ARTICLES VIDE';
        }

        $this->render('Articles' . DS . 'ajouter', [
            'title' => "AJOUTER",
            'titre' => $titre,
            'token' => $_SESSION['newToken'],
            'infoToken' => $_SESSION['newSession'],
            'message' => "Bonjour {$_SESSION['auteur']['prenom']} {$_SESSION['auteur']['nom']}",
            'alert' => $alert,
            'listeArticles' => $listeArticles,
            'content' => $content,
            'articles' => $articles
        ]);
    }

    public function modifier()
    {
        $this->session();
        $error = false;
        //use App\Models;
        $model = new \App\Models\Articles();

        // On valide l'existance d'un ID
        if (isset($_GET['article'])) {
            // on verifie que il s'agit du même article
            if ($_POST && intval($_POST['id']) == intval($_GET['article'])) {
                // valider les informations
                if (!isset($_POST['titre']) OR empty($_POST['titre'])) {
                    $error = true;
                    $alert .= "Vous devez renseigner le titre<br>";
                }

                if (!isset($_POST['content']) OR empty($_POST['content'])) {
                    $error = true;
                    $alert .= "Vous devez renseigner le contenu<br>";
                }

                if (!$error && $model->updateArticle($_POST)) {
                    unset($_POST);
                    header('Location:?page=ajouter');
                    exit();
                }

            }

            $article = $model->recupArticle(intval($_GET['article']));

        } else {
            header('Location:?page=ajouter');
            exit();
        }

        // on génere la liste des Articles
        $this->render('Articles' . DS . 'modifier', [
            'title' => "AJOUTER",
            'message' => "Bonjour {$_SESSION['auteur']['prenom']} {$_SESSION['auteur']['nom']}",
            'alert' => "",
            'article' => isset($article) ? $article : [],
            'titre' => isset($article) ? $article['title'] : '',
            'content' => isset($article) ? $article['content'] : '',
            'id' => isset($article) ? $article['id'] : ''
        ]);
    }

// On valide l'existance d'un ID
    public function supprimer()
    {
        $this->session();
        if (isset($_GET['article'])) {
            // on verifie que il s'agit du même article
            $model = new \App\Models\Articles();
            if ($model->supprimerArticle($_GET)) {
                header('Location:?page=ajouter');
            }

        }

        $alert = isset($_GET['article']) ?
            "l'article " . (intval($_GET['article'])) . " n'existe pas" :
            " Vous n'avez pas choisi un article à suppimer";

        $this->render('Articles' . DS . 'supprimer', [
            'title' => "SUPPRIMER",
            'message' => "Bienvenue à mon BLOG",
            'alert' => "Impossible d'efectuer la suppretion: $alert"
        ]);
    }
}
