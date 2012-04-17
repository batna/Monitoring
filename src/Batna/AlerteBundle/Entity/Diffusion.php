<?php

namespace Batna\AlerteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\AlerteBundle\Entity\Diffusion
 *
 * @ORM\Table(name="ALERTE_Diffusion")
 * @ORM\Entity(repositoryClass="Batna\AlerteBundle\Entity\DiffusionRepository")
 */
class Diffusion
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
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @ORM\ManyToMany(targetEntity="Batna\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="ALERTE_Diffusion_Group",
     *      joinColumns={@ORM\JoinColumn(name="diffusion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groupes;
    
    /**
     * @ORM\ManyToMany(targetEntity="Batna\UserBundle\Entity\User")
     * @ORM\JoinTable(name="ALERTE_Diffusion_User",
     *      joinColumns={@ORM\JoinColumn(name="diffusion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $users;

    public function __construct()
    {
    	$this->groupes = new \Doctrine\Common\Collections\ArrayCollection;
    	$this->users = new \Doctrine\Common\Collections\ArrayCollection;
    }
    
    public function __toString(){
    	return $this->libelle;
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
     * Set libelle
     *
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
	
	public function addGroupe(\Batna\UserBundle\Entity\Group $groupe)
	{
		$this->groupes[] = $groupe;
	}
    
    public function getGroupes()
	{
		return $this->groupes;
	}
	
	public function addUser(\Batna\UserBundle\Entity\User $user)
	{
		$this->users[] = $user;
	}
    
    public function getUsers()
	{
		return $this->users;
	}
}