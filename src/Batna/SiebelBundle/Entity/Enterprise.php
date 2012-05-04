<?php

namespace Batna\SiebelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\Enterprise
 *
 * @ORM\Table(name="SIEBEL_Enterprise")
 * @ORM\Entity(repositoryClass="Batna\SiebelBundle\Entity\EnterpriseRepository")
 */

class Enterprise
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
     * @var string $signature
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=true)
     */
    private $signature;

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
     * @var string $databasePlatform
     *
     * @ORM\Column(name="databasePlatform", type="string", length=255, nullable=true)
     */
    private $databasePlatform;

    /**
     * @var string $useMSStored
     *
     * @ORM\Column(name="useMSStored", type="string", length=255, nullable=true)
     */
    private $useMSStored;

    /**
     * @var string $attrDescription
     *
     * @ORM\Column(name="attrDescription", type="string", length=255, nullable=true)
     */
    private $attrDescription;

    /**
     * @var string $databaseConStr
     *
     * @ORM\Column(name="databaseConStr", type="string", length=255, nullable=true)
     */
    private $databaseConStr;

    /**
     * @var string $namedSubsystemSequence
     *
     * @ORM\Column(name="serverSequence", type="string", length=255, nullable=true)
     */
    private $serverSequence;

    /**
     * @var string $componentGroupSequence
     *
     * @ORM\Column(name="componentGroupSequence", type="string", length=255, nullable=true)
     */
    private $componentGroupSequence;

    /**
     * @var string $componentSequence
     *
     * @ORM\Column(name="componentSequence", type="string", length=255, nullable=true)
     */
    private $componentSequence;

    /**
     * @var string $namedSubsystemSequence
     *
     * @ORM\Column(name="namedSubsystemSequence", type="string", length=255, nullable=true)
     */
    private $namedSubsystemSequence;

    /**
     * @var array $parameters
     *
     * @ORM\Column(name="parameters", type="array")
     */
    private $parameters;

    /**
     * @var array $components
     *
     * @ORM\Column(name="components", type="array")
     */
    private $components;

    /**
     * @var Gateway $gateway
     *
     * @ORM\ManyToOne(cascade={"persist"}, targetEntity="Batna\SiebelBundle\Entity\Gateway")
     */
    private $gateway;

    /**
     * @var array $servers
     *
     * @ORM\Column(name="servers", type="array", nullable=true)
     */
    private $servers;

    /**
     * @var array $namedSubsystems
     *
     * @ORM\Column(name="namedSubsystems", type="array", nullable=true)
     */
    private $namedSubsystems;

    /**
     * @var array $componentGroups
     *
     * @ORM\Column(name="componentGroups", type="array", nullable=true)
     */
    private $componentGroups;


    public function __construct()
    {
    	$this->parameters = array();
    	$this->components = array();
    	$this->servers = array();
    	$this->namedSubsystems = array();
    	$this->componentGroups = array();
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
     * Set signature
     *
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
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
     * Set DatabasePlatform
     *
     * @param string $databasePlatform
     */
    public function setDatabasePlatform($databasePlatform)
    {
        $this->databasePlatform = $databasePlatform;
    }

    /**
     * Get databasePlatform
     *
     * @return string 
     */
    public function getDatabasePlatform()
    {
        return $this->databasePlatform;
    }

    /**
     * Set useMSStored
     *
     * @param string $useMSStored
     */
    public function setUseMSStored($useMSStored)
    {
        $this->useMSStored = $useMSStored;
    }

    /**
     * Get useMSStored
     *
     * @return string 
     */
    public function getUseMSStored()
    {
        return $this->useMSStored;
    }

    /**
     * Set attrDescription
     *
     * @param string $attrDescription
     */
    public function setAttrDescription($attrDescription)
    {
        $this->attrDescription = $attrDescription;
    }

    /**
     * Get attrDescription
     *
     * @return string 
     */
    public function getAttrDescription()
    {
          return $this->attrDescription;
    }

    /**
     * Set databaseConStr
     *
     * @param string $databaseConStr
     */
    public function setDatabaseConStr($databaseConStr)
    {
        $this->databaseConStr = $databaseConStr;
    }

    /**
     * Get databaseConStr
     *
     * @return string 
     */
    public function getDatabaseConStr()
    {
        return $this->databaseConStr;
    }

    /**
     * Set serverSequence
     *
     * @param string $serverSequence
     */
    public function setServerSequence($serverSequence)
    {
        $this->serverSequence = $serverSequence;
    }

    /**
     * Get serverSequence
     *
     * @return string 
     */
    public function getServerSequence()
    {
        return $this->serverSequence;
    }

    /**
     * Set componentGroupSequence
     *
     * @param string $componentGroupSequence
     */
    public function setComponentGroupSequence($componentGroupSequence)
    {
        $this->componentGroupSequence = $componentGroupSequence;
    }

    /**
     * Get componentGroupSequence
     *
     * @return string 
     */
    public function getComponentGroupSequence()
    {
        return $this->componentGroupSequence;
    }

    /**
     * Set componentSequence
     *
     * @param string $componentSequence
     */
    public function setComponentSequence($componentSequence)
    {
        $this->componentSequence = $componentSequence;
    }

    /**
     * Get componentSequence
     *
     * @return string 
     */
    public function getComponentSequence()
    {
        return $this->componentSequence;
    }

    /**
     * Set namedSubsystemSequence
     *
     * @param string $namedSubsystemSequence
     */
    public function setNamedSubsystemSequence($namedSubsystemSequence)
    {
        $this->namedSubsystemSequence = $namedSubsystemSequence;
    }

    /**
     * Get namedSubsystemSequence
     *
     * @return string 
     */
    public function getNamedSubsystemSequence()
    {
        return $this->namedSubsystemSequence;
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
    	return in_array($parameter, $this->parameters, true);
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
     * Get components
     *
     * @return array 
     */
    public function getComponents()
    {
        return $this->components;
    }   
    
    /**
     * Has component
     *
     * @param array $component
     * @return boolean
     */
    public function hasComponent($component)
    {
    	return in_array($component, $this->components, true);
    }

    /**
     * Add component
     * 
     * @param array $component
     */
    public function addComponent($component)
    {
        if (!$this->hasComponent($component)) {
            $this->components[] = $component;
        }
        return $this;
    }
    
    /**
     *  Remove component
     * 
     * @param array component
     */
    public function removeComponent($component)
    {
    	if (false !== $key = array_search($component, $this->components, true)) {
    		unset($this->components[$key]);
    		$this->components = array_values($this->components);
    	}
    	return $this;
    }

    /**
     * Set gateway
     *
     * @param Gateway $gateway
     */
    public function setGateway(Gateway $gateway)
    {
        $this->gateway = $gateway;
        $this->gateway->addEnterprise($this);
    }

    /**
     * Get gateway
     *
     * @return Gateway 
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * Get servers
     *
     * @return Server 
     */
    public function getServers()
    {
        return $this->servers;
    }   
    
    /**
     * Has server
     *
     * @param Server $server
     * @return boolean
     */
    public function hasServer(Server $server)
    {
    	return in_array(array($server->getId(), $server->getName()), $this->servers, true);
    }

    /**
     * Add server
     * 
     * @param Server $server
     */
    public function addServer(Server $server)
    {
        if (!$this->hasServer($server)) {
            $this->servers[] = array($server->getId(),$server->getName());
        }
        return $this;
    }
    
    /**
     *  Remove server
     * 
     * @param Server server
     */
    public function removeServer(Server $server)
    {
    	if (false !== $key = array_search(array($server->getId, $server->getName()), $this->servers, true)) {
    		unset($this->servers[$key]);
    		$this->servers = array_values($this->servers);
    	}
    	return $this;
    }
        
    public function getServerIdByName($name)
    {
    	$tab = $this->servers;
    	foreach($tab as $ss)
    	{
    		if(array_search($name, $ss))
    		{
    			return $ss[0];
    		}
    	}
    	return false;
    }

    /**
     * Get namedSubsystems
     *
     * @return NamedSubsystem 
     */
    public function getNamedSubsystems()
    {
        return $this->namedSubsystems;
    }   
    
    /**
     * Has namedSubsystem
     *
     * @param NamedSubsystem $namedSubsystem
     * @return boolean
     */
    public function hasNamedSubsystem(NamedSubsystem $namedSubsystem)
    {
    	return in_array(array($namedSubsystem->getId(), $namedSubsystem->getName()), $this->namedSubsystems, true);
    }

    /**
     * Add namedSubsystem
     * 
     * @param NamedSubsystem $namedSubsystem
     */
    public function addNamedSubsystem(NamedSubsystem $namedSubsystem)
    {
        if (!$this->hasNamedSubsystem($namedSubsystem)) {
            $this->namedSubsystems[] = array($namedSubsystem->getId(),$namedSubsystem->getName());
        }
        return $this;
    }
    
    /**
     *  Remove namedSubsystem
     * 
     * @param NamedSubsystem namedSubsystem
     */
    public function removeNamedSubsystem(NamedSubsystem $namedSubsystem)
    {
    	if (false !== $key = array_search(array($namedSubsystem->getId, $namedSubsystem->getName()), $this->namedSubsystems, true)) {
    		unset($this->namedSubsystems[$key]);
    		$this->namedSubsystems = array_values($this->namedSubsystems);
    	}
    	return $this;
    }
        
    public function getNamedSubsystemIdByName($name)
    {
    	$tab = $this->namedSubsystems;
    	foreach($tab as $ns)
    	{
    		if(array_search($name, $ns))
    		{
    			return $ns[0];
    		}
    	}
    	return false;
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
    	if (false !== $key = array_search(array($componentGroup->getId, $componentGroup->getName()), $this->componentGroups, true)) {
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