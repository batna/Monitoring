<?php

namespace Batna\SiebelBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\SiebelBundle\Entity\Component
 *
 * @ORM\Table(name="SIEBEL_Component")
 * @ORM\Entity(repositoryClass="Batna\SiebelBundle\Entity\ComponentRepository")
 */
class Component {
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
	 * @var string $startMode
	 *
	 * @ORM\Column(name="startMode", type="string", length=255, nullable=true)
	 */
	private $startMode;

	/**
	 * @var string $runMode
	 *
	 * @ORM\Column(name="runMode", type="string", length=255, nullable=true)
	 */
	private $runMode;

	/**
	 * @var string $incarnationNumber
	 *
	 * @ORM\Column(name="incarnationNumber", type="string", length=255, nullable=true)
	 */
	private $incarnationNumber;

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
	 * @var string $componentType
	 *
	 * @ORM\Column(name="componentType", type="string", length=255, nullable=true)
	 */
	private $componentType;

	/**
	 * @var string $serviceName
	 *
	 * @ORM\Column(name="serviceName", type="string", length=255, nullable=true)
	 */
	private $serviceName;

	/**
	 * @var string $serviceType
	 *
	 * @ORM\Column(name="serviceType", type="string", length=255, nullable=true)
	 */
	private $serviceType;

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
	 * @var string $writeFlag
	 *
	 * @ORM\Column(name="writeFlag", type="string", length=255, nullable=true)
	 */
	private $writeFlag;

	/**
	 * @var string $configFile
	 *
	 * @ORM\Column(name="configFile", type="string", length=255, nullable=true)
	 */
	private $configFile;

	/**
	 * @var string $dataSource
	 *
	 * @ORM\Column(name="dataSource", type="string", length=255, nullable=true)
	 */
	private $dataSource;

	/**
	 * @var string $connectString
	 *
	 * @ORM\Column(name="connectString", type="string", length=255, nullable=true)
	 */
	private $connectString;

	/**
	 * @var string $namedDataSource
	 *
	 * @ORM\Column(name="namedDataSource", type="string", length=255, nullable=true)
	 */
	private $namedDataSource;

	/**
	 * @var string $lang
	 *
	 * @ORM\Column(name="lang", type="string", length=255, nullable=true)
	 */
	private $lang;

	/**
	 * @var array $parameters
	 *
	 * @ORM\Column(name="parameters", type="array", nullable=true)
	 */
	private $parameters;

    /**
     * @var ComponentGroup $componentGroup
     *
     * @ORM\ManyToOne(targetEntity="Batna\SiebelBundle\Entity\ComponentGroup")
     */
    private $componentGroup;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return string 
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set startMode
	 *
	 * @param string $startMode
	 */
	public function setStartMode($startMode) {
		$this->startMode = $startMode;
	}

	/**
	 * Get startMode
	 *
	 * @return string 
	 */
	public function getStartMode() {
		return $this->startMode;
	}

	/**
	 * Set runMode
	 *
	 * @param string $runMode
	 */
	public function setRunMode($runMode) {
		$this->runMode = $runMode;
	}

	/**
	 * Get runMode
	 *
	 * @return string 
	 */
	public function getRunMode() {
		return $this->runMode;
	}

	/**
	 * Set incarnationNumber
	 *
	 * @param string $incarnationNumber
	 */
	public function setIncarnationNumber($incarnationNumber) {
		$this->incarnationNumber = $incarnationNumber;
	}

	/**
	 * Get incarnationNumber
	 *
	 * @return string 
	 */
	public function getIncarnationNumber() {
		return $this->incarnationNumber;
	}

	/**
	 * Set fullName
	 *
	 * @param string $fullName
	 */
	public function setFullName($fullName) {
		$this->fullName = $fullName;
	}

	/**
	 * Get fullName
	 *
	 * @return string 
	 */
	public function getFullName() {
		return $this->fullName;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get description
	 *
	 * @return string 
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set componentType
	 *
	 * @param string $componentType
	 */
	public function setComponentType($componentType) {
		$this->componentType = $componentType;
	}

	/**
	 * Get componentType
	 *
	 * @return string 
	 */
	public function getComponentType() {
		return $this->componentType;
	}

	/**
	 * Set serviceName
	 *
	 * @param string $serviceName
	 */
	public function setServiceName($serviceName) {
		$this->serviceName = $serviceName;
	}

	/**
	 * Get serviceName
	 *
	 * @return string 
	 */
	public function getServiceName() {
		return $this->serviceName;
	}

	/**
	 * Set serviceType
	 *
	 * @param string $serviceType
	 */
	public function setServiceType($serviceType) {
		$this->serviceType = $serviceType;
	}

	/**
	 * Get serviceType
	 *
	 * @return string 
	 */
	public function getServiceType() {
		return $this->serviceType;
	}

	/**
	 * Set enableState
	 *
	 * @param string $enableState
	 */
	public function setEnableState($enableState) {
		$this->enableState = $enableState;
	}

	/**
	 * Get enableState
	 *
	 * @return string 
	 */
	public function getEnableState() {
		return $this->enableState;
	}

	/**
	 * Set objectId
	 *
	 * @param string $objectId
	 */
	public function setObjectId($objectId) {
		$this->objectId = $objectId;
	}

	/**
	 * Get objectId
	 *
	 * @return string 
	 */
	public function getObjectId() {
		return $this->objectId;
	}

	/**
	 * Set writeFlag
	 *
	 * @param string $writeFlag
	 */
	public function setWriteFlag($writeFlag) {
		$this->writeFlag = $writeFlag;
	}

	/**
	 * Get writeFlag
	 *
	 * @return string 
	 */
	public function getWriteFlag() {
		return $this->writeFlag;
	}

	/**
	 * Set configFile
	 *
	 * @param string $configFile
	 */
	public function setConfigFile($configFile) {
		$this->configFile = $configFile;
	}

	/**
	 * Get configFile
	 *
	 * @return string 
	 */
	public function getConfigFile() {
		return $this->configFile;
	}

	/**
	 * Set connectString
	 *
	 * @param string $connectString
	 */
	public function setConnectString($connectString) {
		$this->connectString = $connectString;
	}

	/**
	 * Get connectString
	 *
	 * @return string 
	 */
	public function getConnectString() {
		return $this->dataSource;
	}

	/**
	 * Set dataSource
	 *
	 * @param string $dataSoconnectString
	 */
	public function setDataSource($dataSource) {
		$this->dataSource = $dataSource;
	}

	/**
	 * Get dataSource
	 *
	 * @return string 
	 */
	public function getDataSource() {
		return $this->dataSource;
	}

	/**
	 * Set namedDataSource
	 *
	 * @param string $namedDataSource
	 */
	public function setNamedDataSource($namedDataSource) {
		$this->namedDataSource = $namedDataSource;
	}

	/**
	 * Get namedDataSource
	 *
	 * @return string 
	 */
	public function getNamedDataSource() {
		return $this->namedDataSource;
	}

	/**
	 * Set lang
	 *
	 * @param string $lang
	 */
	public function setLang($lang) {
		$this->lang = $lang;
	}

	/**
	 * Get lang
	 *
	 * @return string 
	 */
	public function getLang() {
		return $this->lang;
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
	 * Set componentGroup
	 *
	 * @param ComponentGroup $componentGroup
	 */
	public function setComponentGroup($componentGroup) {
		$this->componentGroup = $componentGroup;
	}

	/**
	 * Get componentGroup
	 *
	 * @return ComponentGroup 
	 */
	public function getComponentGroup() {
		return $this->componentGroup;
	}
}
