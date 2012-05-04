<?php

namespace Batna\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;

/**
 * Batna\UserBundle\Entity\User
 *
 * @ORM\Table(name="ADMIN_User")
 * @ORM\Entity(repositoryClass="Batna\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string $surname
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\ManyToMany(targetEntity="Batna\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="ADMIN_User_Group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    public function __construct()
    {
    	parent::__construct();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }
    
    /**
     * Get Alertes
     *
     * @return array
     */
    public function getDiffusionLists()
    {
    	$ctrl = new Controller();
    	$em = $ctrl->getDoctrine()->getEntityManager();
    	
    	$diffusions = $em->getRepository('BatnaAlerteBundle:Diffusion')->findAll();
    	$groupeLists = array();
    	$userLists = array();
    	
    	foreach($diffusions as $diffusion)
    	{
    		$difGroupes = $diffusion->getGroupes();
    		foreach ($difGroupes as $difGroupe)
    		{
    			if($this->hasGroup($difGroupe))
    			{
    				$groupeLists[] = $diffusion;
    			}
    		}
    		$difUsers = $diffusion->getUsers();
    		foreach ($difUsers as $difUser)
    		{
    			if($this === $difUser)
    			{
    				$userLists[] = $diffusion;
    			}
    		}
    	}
    	
    	return array_unique(array_merge($groupeLists, $userLists));
    }
}