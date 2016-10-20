<?php

namespace Diwoo\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteurs
 */
class Auteurs
{
    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $article;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Auteurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Auteurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Auteurs
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Auteurs
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add article
     *
     * @param \Diwoo\Bundle\BlogBundle\Entity\Articles $article
     * @return Auteurs
     */
    public function addArticle(\Diwoo\Bundle\BlogBundle\Entity\Articles $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Diwoo\Bundle\BlogBundle\Entity\Articles $article
     */
    public function removeArticle(\Diwoo\Bundle\BlogBundle\Entity\Articles $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
