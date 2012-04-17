<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\Environnement
 *
 * @ORM\Table(name="ARCHI_Environnement")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\EnvironnementRepository")
 */
class Environnement
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
     * @var string $shortName
     *
     * @ORM\Column(name="shortName", type="string", length=255)
     */
    private $shortName;

    /**
     * @var string $longName
     *
     * @ORM\Column(name="longName", type="string", length=255)
     */
    private $longName;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Contexte $contexte
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Contexte")
     */
    private $contexte;
    
    public function __toString(){
    	return $this->shortName;
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
     * Set shortName
     *
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set longName
     *
     * @param string $longName
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;
    }

    /**
     * Get longName
     *
     * @return string 
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set contexte
     *
     * @param integer $contexte
     */
    public function setContexte($contexte)
    {
        $this->contexte = $contexte;
    }

    /**
     * Get contexte
     *
     * @return integer 
     */
    public function getContexte()
    {
        return $this->contexte;
    }
}