<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\ValVarContexte
 *
 * @ORM\Table(name="ARCHI_Variable_Contexte")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\ValVarContexteRepository")
 */
class ValVarContexte
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
     * @var Contexte $contexte
     *
     * @ORM\ManyToOne(targetEntity="Batna\ArchiBundle\Entity\Contexte")
     */
    private $contexte;
    
    
    public function __toString()
    {
    	return $this->variable->getName().'('.$this->contexte->getName().') = '.$this->value;
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