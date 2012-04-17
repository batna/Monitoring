<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\Host
 *
 * @ORM\Table(name="ARCHI_Host")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\HostRepository")
 */
class Host
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
     * @var string $hostname
     *
     * @ORM\Column(name="hostname", type="string", length=255)
     */
    private $hostname;

    /**
     * @var string $ip
     *
     * @ORM\Column(name="ip", type="string", length=40, nullable="true")
     */
    private $ip;

    /**
     * @var integer $ram
     *
     * @ORM\Column(name="ram", type="integer", nullable="true")
     */
    private $ram;

    /**
     * @var integer $cpuCore
     *
     * @ORM\Column(name="cpuCore", type="integer", nullable="true")
     */
    private $cpuCore;

    /**
     * @var integer $cpuFrequency
     *
     * @ORM\Column(name="cpuFrequency", type="integer", nullable="true")
     */
    private $cpuFrequency;

    /**
     * @var Version $os
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Version")
     */
    private $os;

    /**
     * @var boolean $isPhysical
     *
     * @ORM\Column(name="isPhysical", type="boolean", nullable="true")
     */
    private $isPhysical;

	
    public function __toString()
    {
    	return $this->hostname;
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
     * Set hostname
     *
     * @param string $hostname
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * Get hostname
     *
     * @return string 
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set ip
     *
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set ram
     *
     * @param integer $ram
     */
    public function setRam($ram)
    {
        $this->ram = $ram;
    }

    /**
     * Get ram
     *
     * @return integer 
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * Set cpuCore
     *
     * @param integer $cpuCore
     */
    public function setCpuCore($cpuCore)
    {
        $this->cpuCore = $cpuCore;
    }

    /**
     * Get cpuCore
     *
     * @return integer 
     */
    public function getCpuCore()
    {
        return $this->cpuCore;
    }

    /**
     * Set cpuFrequency
     *
     * @param integer $cpuFrequency
     */
    public function setCpuFrequency($cpuFrequency)
    {
        $this->cpuFrequency = $cpuFrequency;
    }

    /**
     * Get cpuFrequency
     *
     * @return integer 
     */
    public function getCpuFrequency()
    {
        return $this->cpuFrequency;
    }

    /**
     * Set os
     *
     * @param integer $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * Get os
     *
     * @return integer 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set isPhysical
     *
     * @param boolean $isPhysical
     */
    public function setIsPhysical($isPhysical)
    {
        $this->isPhysical = $isPhysical;
    }

    /**
     * Get isPhysical
     *
     * @return boolean 
     */
    public function getIsPhysical()
    {
        return $this->isPhysical;
    }
}