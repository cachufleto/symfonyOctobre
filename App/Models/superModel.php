<?php

namespace App\Models;

class superModel
{
    static $instance;
    private $connexion;
    private $num = 0;

    public function connexionBDD()
    {
        if(!self::$instance){
            self::$instance = $this->connexionINT();
        }

        return $this->connexion;
    }

    public function connexionINT()
    {
        $this->num++; // 'BDD<br>';
        $host = 'localhost';
        $user = 'root';
        $mdp = '';
        $bdd = 'blogsymfony';

        $connexion = new \mysqli($host, $user, $mdp, $bdd);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $this->connexion = $connexion;

        return true;

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo $this->num;
        $this->connexion->close();
    }
}
