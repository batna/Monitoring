<?php

namespace Batna\SiebelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\Server
 *
 * @ORM\Table(name="SIEBEL_Server")
 * @ORM\Entity(repositoryClass="Batna\SiebelBundle\Entity\ServerRepository")
 */
class Server
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string $fullName
     *
     * @ORM\Column(name="fullName", type="string", length=255, nullable=true)
     */
    private $fullName;

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
     * @var string $version
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string $eventLog
     *
     * @ORM\Column(name="eventLog", type="string", length=255, nullable=true)
     */
    private $eventLog;

    /**
     * @var string $etat
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var Host $host
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Host")
     */
    private $host;

    /**
     * @var Enterprise $enterprise
     *
     * @ORM\ManyToOne(cascade={"persist"}, targetEntity="Batna\SiebelBundle\Entity\Enterprise")
     */
    private $enterprise;

    /**
     * @var array $parameters
     *
     * @ORM\Column(name="parameters", type="array", nullable=true)
     */
    private $parameters;

    /**
     * @var array $attributes
     *
     * @ORM\Column(name="attributes", type="array", nullable=true)
     */
    private $attributes;

    /**
     * @var array $componentGroups
     *
     * @ORM\Column(name="componentGroups", type="array", nullable=true)
     */
    private $componentGroups;

    
    public function __construct()
    {
    	$this->parameters = array();
    	$this->attributes = array();
    	$this->componentGroups = array();
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
     * Set version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set eventLog
     *
     * @param string $eventLog
     */
    public function setEventLog($eventLog)
    {
        $this->eventLog = $eventLog;
    }

    /**
     * Get eventLog
     *
     * @return string 
     */
    public function getEventLog()
    {
        return $this->eventLog;
    }

    /**
     * Set etat
     *
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set host
     *
     * @param integer $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Get host
     *
     * @return integer 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set enterprise
     *
     * @param Enterprise $enterprise
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
        $this->enterprise->addServer($this);
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
     * Get parameters
     *
     * @return array 
     */
    public function getParameters()
    {
        return $this->parameters;
    }   
    
    /**
     * Has parameter
     *
     * @param array $parameter
     * @return boolean
     */
    public function hasParameter($parameter)
    {
    	return ($this->parameters != null && in_array($parameter, $this->parameters, true));
    }

    /**
     * Add parameter
     * 
     * @param array $parameter
     */
    public function addParameter($parameter)
    {
        if (!$this->hasParameter($parameter)) {
            $this->parameters[] = $parameter;
        }
        return $this;
    }
    
    /**
     *  Remove parameter
     * 
     * @param array parameter
     */
    public function removeParameter($parameter)
    {
    	if (false !== $key = array_search($parameter, $this->parameters, true)) {
    		unset($this->parameters[$key]);
    		$this->parameters = array_values($this->parameters);
    	}
    	return $this;
    }

    /**
     * Set parameters
     *
     * @param array $parameters
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get attributes
     *
     * @return array 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }   
    
    /**
     * Has attribute
     *
     * @param array $attribute
     * @return boolean
     */
    public function hasAttribute($attribute)
    {
    	return ($this->attributes != null && in_array($attribute, $this->attributes, true));
    }

    /**
     * Add attribute
     * 
     * @param array $attribute
     */
    public function addAttribute($attribute)
    {
        if (!$this->hasAttribute($attribute)) {
            $this->attributes[] = $attribute;
        }
        return $this;
    }
    
    /**
     *  Remove attribute
     * 
     * @param array attribute
     */
    public function removeAttribute($attribute)
    {
    	if (false !== $key = array_search($attribute, $this->attributes, true)) {
    		unset($this->attributes[$key]);
    		$this->attributes = array_values($this->attributes);
    	}
    	return $this;
    }

    /**
     * Get componentGroups
     *
     * @return ComponentGroup 
     */
    public function getComponentGroups()
    {
        return $this->componentGroups;
    }   
    
    /**
     * Has componentGroup
     *
     * @param ComponentGroup $componentGroup
     * @return boolean
     */
    public function hasComponentGroup(ComponentGroup $componentGroup)
    {
    	return in_array(array($componentGroup->getId(), $componentGroup->getName()), $this->componentGroups, true);
    }

    /**
     * Add componentGroup
     * 
     * @param ComponentGroup $componentGroup
     */
    public function addComponentGroup(ComponentGroup $componentGroup)
    {
        if (!$this->hascomponentGroup($componentGroup)) {
            $this->componentGroups[] = array($componentGroup->getId(),$componentGroup->getName());
        }
        return $this;
    }
    
    /**
     *  Remove componentGroup
     * 
     * @param ComponentGroup componentGroup
     */
    public function removeComponentGroup(ComponentGroup $componentGroup)
    {
    	if (false !== $key = array_search(array($componentGroup->getId(), $componentGroup->getName()), $this->componentGroups, true)) {
    		unset($this->componentGroups[$key]);
    		$this->componentGroups = array_values($this->componentGroups);
    	}
    	return $this;
    }
        
    public function getComponentGroupIdByName($name)
    {
    	$tab = $this->componentGroups;
    	foreach($tab as $cg)
    	{
    		if(array_search($name, $cg))
    		{
    			return $cg[0];
    		}
    	}
    	return false;
    }
}