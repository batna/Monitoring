<?php

namespace Batna\SiebelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\ComponentGroup
 *
 * @ORM\Table(name="SIEBEL_Component_Group")
 * @ORM\Entity(repositoryClass="Batna\SiebelBundle\Entity\ComponentGroupRepository")
 */
class ComponentGroup
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $fullName
     *
     * @ORM\Column(name="fullName", type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string $enableState
     *
     * @ORM\Column(name="enableState", type="string", length=255, nullable=true)
     */
    private $enableState;

    /**
     * @var string $objectId
     *
     * @ORM\Column(name="objectId", type="string", length=255, nullable=true)
     */
    private $objectId;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;
    
    
    /**
     * @var Enterprise $enterprise
     *
     * @ORM\ManyToOne(targetEntity="Batna\SiebelBundle\Entity\Enterprise")
     */
    private $enterprise;

    /**
     * @var Server $server
     *
     * @ORM\ManyToOne(targetEntity="Batna\SiebelBundle\Entity\Server")
     */
    private $server;

    /**
     * @var array $components
     *
     * @ORM\Column(name="components", type="array")
     */
    private $components;
    
    
    public function __construct()
    {
    	$this->components = array();
    }
    
    public function __toString()
    {
    	return $this->name;
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
     * Set fullName
     *
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enableState
     *
     * @param string $enableState
     */
    public function setEnableState($enableState)
    {
        $this->enableState = $enableState;
    }

    /**
     * Get enableState
     *
     * @return string 
     */
    public function getEnableState()
    {
        return $this->enableState;
    }

    /**
     * Set objectId
     *
     * @param string $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    /**
     * Get objectId
     *
     * @return string 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set enterprise
     *
     * @param Enterprise $enterprise
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
        $this->enterprise->addComponentGroup($this);
    }

    /**
     * Get enterprise
     *
     * @return Enterprise 
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * Set server
     *
     * @param Server $server
     */
    public function setServer($server)
    {
        $this->server = $server;
        $this->server->addComponentGroup($this);
    }

    /**
     * Get server
     *
     * @return Server 
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Get components
     *
     * @return Component 
     */
    public function getComponents()
    {
        return $this->components;
    }   
    
    /**
     * Has component
     *
     * @param Component $component
     * @return boolean
     */
    public function hasComponent(Component $component)
    {
    	return in_array(array($component->getId(), $component->getName()), $this->components, true);
    }

    /**
     * Add component
     * 
     * @param Component $component
     */
    public function addComponent(Component $component)
    {
        if (!$this->hasComponent($component)) {
            $this->components[] = array($component->getId(),$component->getName());
        }
        return $this;
    }
    
    /**
     *  Remove component
     * 
     * @param Component component
     */
    public function removeComponent(component $component)
    {
    	if (false !== $key = array_search(array($component->getId, $component->getName()), $this->components, true)) {
    		unset($this->components[$key]);
    		$this->components = array_values($this->components);
    	}
    	return $this;
    }
        
    public function getComponentIdByName($name)
    {
    	$tab = $this->components;
    	foreach($tab as $ss)
    	{
    		if(array_search($name, $ss))
    		{
    			return $ss[0];
    		}
    	}
    	return false;
    }
}