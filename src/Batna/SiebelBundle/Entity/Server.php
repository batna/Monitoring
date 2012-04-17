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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string $fullName
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string $enableState
     *
     * @ORM\Column(name="enableState", type="string", length=255)
     */
    private $enableState;

    /**
     * @var string $objectId
     *
     * @ORM\Column(name="objectId", type="string", length=255)
     */
    private $objectId;

    /**
     * @var string $version
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var string $eventLog
     *
     * @ORM\Column(name="eventLog", type="string", length=255)
     */
    private $eventLog;

    /**
     * @var Host $host
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Host")
     */
    private $host;

    /**
     * @var Enterprise $enterprise
     *
     * @ORM\ManyToOne(targetEntity="Batna\SiebelBundle\Entity\Enterprise")
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

    
    public function __construct()
    {
    	$this->parameters = array();
    	$this->attributes = array();
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
     * Set parameters
     *
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
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
            $this->parameters[] = strtoupper($parameter);
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
            $this->attributes[] = strtoupper($attribute);
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
}