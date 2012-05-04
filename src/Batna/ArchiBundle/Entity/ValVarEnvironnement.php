<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\ValVarEnvironnement
 *
 * @ORM\Table(name="ARCHI_Variable_Environnement")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\ValVarEnvironnementRepository")
 */
class ValVarEnvironnement
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
     * @var string $value
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var Variable $variable
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Variable")
     */
    private $variable;

    /**
     * @var Environnement $environnement
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Environnement")
     */
    private $environnement;
    
	public function __toString()
	{
		return $this->variable->getName().'('.$this->environnement->getShortName().') = '.$this->value;
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
     * Set value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set variable
     *
     * @param integer $variable
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    }

    /**
     * Get variable
     *
     * @return integer 
     */
    public function getVariable()
    {
        return $this->variable;
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
}