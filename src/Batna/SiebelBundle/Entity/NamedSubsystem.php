<?php

namespace Batna\SiebelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\NamedSubsystem
 *
 * @ORM\Table(name="SIEBEL_Named_Subsystem")
 * @ORM\Entity
 */
class NamedSubsystem
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
     * @var string $subsystemName
     *
     * @ORM\Column(name="subsystemName", type="string", length=255, nullable=true)
     */
    private $subsystemName;

    /**
     * @var string $objectId
     *
     * @ORM\Column(name="objectId", type="string", length=255, nullable=true)
     */
    private $objectId;

	/**
	 * @var array $parameters
	 *
	 * @ORM\Column(name="parameters", type="array", nullable=true)
	 */
	private $parameters;
	
	
	/**
	 * @var Enterprise $enterprise
	 *
     * @ORM\ManyToOne(targetEntity="Batna\SiebelBundle\Entity\Enterprise")
	 */
	private $enterprise;

	
	public function __construc()
	{
		$this->parameters = array();
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
     * Set subsystemName
     *
     * @param string $subsystemName
     */
    public function setSubsystemName($subsystemName)
    {
        $this->subsystemName = $subsystemName;
    }

    /**
     * Get subsystemName
     *
     * @return string 
     */
    public function getSubsystemName()
    {
        return $this->subsystemName;
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
	 * Set parameters
	 *
	 * @param array $parameters
	 */
	public function setParameters($parameters) {
		$this->parameters = $parameters;
	}

	/**
	 * Get parameters
	 *
	 * @return array 
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * Has parameter
	 *
	 * @param array $parameter
	 * @return boolean
	 */
	public function hasParameter($parameter) {
		return ($this->parameters != null && in_array($parameter, $this->parameters, true));
	}

	/**
	 * Add parameter
	 * 
	 * @param array $parameter
	 */
	public function addParameter($parameter) {
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
	public function removeParameter($parameter) {
		if ($this->hasParameter($parameter)) {
			$key = array_search($parameter, $this->parameters);
			unset($this->parameters[$key]);
		}
		return $this;
	}

    /**
     * Set enterprise
     *
     * @param string $enterprise
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
        $this->enterprise->addNamedSubsystem($this);
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
}