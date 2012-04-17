<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\Version
 *
 * @ORM\Table(name="ARCHI_OS_Version")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\VersionRepository")
 */
class Version
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
     * @var Os $os
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Os")
     */
    private $os;

    
    public function __toString()
    {
    	return $this->os->__toString().' '.$this->name;
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
}