<?php

namespace Diwoo\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 */
class Articles
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $picture;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Diwoo\Bundle\BlogBundle\Entity\Auteurs
     */
    private $auteur;


    /**
     * Set title
     *
     * @param string $title
     * @return Articles
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Articles
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Articles
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Articles
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
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
     * Set auteur
     *
     * @param \Diwoo\Bundle\BlogBundle\Entity\Auteurs $auteur
     * @return Articles
     */
    public function setAuteur(\Diwoo\Bundle\BlogBundle\Entity\Auteurs $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Diwoo\Bundle\BlogBundle\Entity\Auteurs 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}
