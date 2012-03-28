<?php

namespace Batna\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\UserBundle\Entity\Discussion
 *
 * @ORM\Table(name="ADMIN_Discussion")
 * @ORM\Entity(repositoryClass="Batna\UserBundle\Entity\DiscussionRepository")
 */
class Discussion
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
     * @var datetime $dateCreation
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\ManyToMany(targetEntity="Batna\UserBundle\Entity\User")
     * @ORM\JoinTable(name="ADMIN_Discussion_User",
     *      joinColumns={@ORM\JoinColumn(name="discussion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $participants;
    
    public function __construct()
    {
    	$this->participants = new \Doctrine\Common\Collections\ArrayCollection;
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
     * Set isActive
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function addParticipants(\Batna\UserBundle\Entity\User $participant)
    {
    	$this->participants[] = $participant;
    }
    
    public function getParticipants()
    {
    	return $this->participants;
    }
}