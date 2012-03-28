<?php

namespace Batna\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\UserBundle\Entity\Message
 *
 * @ORM\Table(name="ADMIN_Message")
 * @ORM\Entity(repositoryClass="Batna\UserBundle\Entity\MessageRepository")
 */
class Message
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text $corps
     *
     * @ORM\Column(name="corps", type="text")
     */
    private $corps;

    /**
     * @var User $auteur
     *
     * @ORM\ManyToOne(targetEntity="Batna\UserBundle\Entity\User")
     */
    private $auteur;

    /**
     * @var User $destinataire
     *
     * @ORM\ManyToOne(targetEntity="Batna\UserBundle\Entity\User")
     */
    private $destinataire;

    /*/**
     * @var Discussion $discussion
     *
     * @ORM\ManyToOne(targetEntity="Batna\UserBundle\Entity\Discussion")
     */
    //private $discussion;

    /**
     * @var datetime $dateCreation
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var datetime $dateModification
     *
     * @ORM\Column(name="dateModification", type="datetime")
     */
    private $dateModification;

    /**
     * @var boolean $isViewed
     *
     * @ORM\Column(name="isViewed", type="boolean")
     */
    private $isViewed;


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
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set corps
     *
     * @param text $corps
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;
    }

    /**
     * Get corps
     *
     * @return text 
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set auteur
     *
     * @param User $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Get auteur
     *
     * @return User 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set destinataire
     *
     * @param User $destinataire
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;
    }

    /**
     * Get destinataire
     *
     * @return User 
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /*/**
     * Set discussion
     *
     * @param integer $discussion
     */
    /*public function setDiscussion($discussion)
    {
        $this->discussion = $discussion;
    }/**/

    /*/**
     * Get discussion
     *
     * @return integer 
     */
    /*public function getDiscussion()
    {
        return $this->discussion;
    }/**/

    /**
     * Set dateCreation
     *
     * @param datetime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * Get dateCreation
     *
     * @return datetime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param datetime $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * Get dateModification
     *
     * @return datetime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set isViewed
     *
     * @param boolean $isViewed
     */
    public function setIsViewed($isViewed)
    {
        $this->isViewed = $isViewed;
    }

    /**
     * Get isViewed
     *
     * @return boolean 
     */
    public function getIsViewed()
    {
        return $this->isViewed;
    }
}