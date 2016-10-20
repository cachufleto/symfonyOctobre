<?php

namespace Sami\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 */
class Users
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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
     * Add article
     *
     * @param \Sami\Bundle\BlogBundle\Entity\Posts $article
     * @return Users
     */
    public function addArticle(\Sami\Bundle\BlogBundle\Entity\Posts $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Sami\Bundle\BlogBundle\Entity\Posts $article
     */
    public function removeArticle(\Sami\Bundle\BlogBundle\Entity\Posts $article)
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $posts;


    /**
     * Add posts
     *
     * @param \Sami\Bundle\BlogBundle\Entity\Posts $posts
     * @return Users
     */
    public function addPost(\Sami\Bundle\BlogBundle\Entity\Posts $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Sami\Bundle\BlogBundle\Entity\Posts $posts
     */
    public function removePost(\Sami\Bundle\BlogBundle\Entity\Posts $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
