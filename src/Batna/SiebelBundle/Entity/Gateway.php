<?php

namespace Batna\SiebelBundle\Entity;

use Doctrine\ORM\Mapping\Id;

use Batna\ArchiBundle\Entity\Environnement;
use Batna\ArchiBundle\Entity\Host;
use Batna\ToolsBundle\Entity\Document;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\Gateway
 *
 * @ORM\Table(name="SIEBEL_Gateway")
 * @ORM\Entity(repositoryClass="Batna\SiebelBundle\Entity\GatewayRepository")
 */
class Gateway
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
     * @var Host $host
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Host")
     */
    private $host;

    /**
     * @var integer $port
     *
     * @ORM\Column(name="port", type="integer", nullable=true)
     */
    private $port;

    /**
     * @var Environnement $environnement
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Environnement")
     */
    private $environnement;

    /**
     * @var string $version
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

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
     * @var string $createDefault
     *
     * @ORM\Column(name="createDefault", type="string", length=255, nullable=true)
     */
    private $createDefault;

    /**
     * @var string $useDefault
     *
     * @ORM\Column(name="useDefault", type="string", length=255, nullable=true)
     */
    private $useDefault;

    /**
     * @var string $currentFile
     *
     * @ORM\ManyToOne(targetEntity="Batna\ToolsBundle\Entity\Document")
     */
    private $currentFile;

    /**
     * @var array $enterprises
     *
     * @ORM\Column(name="enterprises", type="array")
     */
    private $enterprises;
    
    
    public function __construct()
    {
    	$this->enterprises = array();
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
     * Set port
     *
     * @param integer $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Get port
     *
     * @return integer 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set environnement
     *
     * @param integer $environnement
     */
    public function setEnvironnement($environnement)
    {
        $this->environnement = $environnement;
    }

    /**
     * Get environnement
     *
     * @return integer 
     */
    public function getEnvironnement()
    {
        return $this->environnement;
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
     * Set createDefault
     *
     * @param string $createDefault
     */
    public function setCreateDefault($createDefault)
    {
        $this->createDefault = $createDefault;
    }

    /**
     * Get createDefault
     *
     * @return string 
     */
    public function getCreateDefault()
    {
        return $this->createDefault;
    }

    /**
     * Set useDefault
     *
     * @param string $useDefault
     */
    public function setUseDefault($useDefault)
    {
        $this->useDefault = $useDefault;
    }

    /**
     * Get useDefault
     *
     * @return string 
     */
    public function getUseDefault()
    {
        return $this->useDefault;
    }

    /**
     * Set currentFile
     *
     * @param string $useDefault
     */
    public function setCurrentFile($currentFile)
    {
        $this->currentFile = $currentFile;
    }

    /**
     * Get currentFile
     *
     * @return string 
     */
    public function getCurrentFile()
    {
        return $this->currentFile;
    }

    /**
     * Get enterprises
     *
     * @return Enterprise 
     */
    public function getEnterprises()
    {
        return $this->enterprises;
    }   
    
    /**
     * Has enterprise
     *
     * @param Enterprise $enterprise
     * @return boolean
     */
    public function hasEnterprise(Enterprise $enterprise)
    {
    	return in_array(array($enterprise->getId(), $enterprise->getName()), $this->enterprises, true);
    }

    /**
     * Add enterprise
     * 
     * @param Enterprise $enterprise
     */
    public function addEnterprise(Enterprise $enterprise)
    {
        if (!$this->hasenterprise($enterprise)) {
            $this->enterprises[] = array($enterprise->getId(),$enterprise->getName());
        }
        return $this;
    }
    
    /**
     *  Remove enterprise
     * 
     * @param Enterprise enterprise
     */
    public function removeEnterprise(Enterprise $enterprise)
    {
    	if (false !== $key = array_search(array($enterprise->getId, $enterprise->getName()), $this->enterprises, true)) {
    		unset($this->enterprises[$key]);
    		$this->enterprises = array_values($this->enterprises);
    	}
    	return $this;
    }
        
	public function getEnterpriseIdByName($name)
    {
    	$tab = $this->enterprises;
    	foreach($tab as $es)
    	{
    		if(array_search($name, $es))
    		{
    			return $es[0];
    		}
    	}
    	return false;
    }
}