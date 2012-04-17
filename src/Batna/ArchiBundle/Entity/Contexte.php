<?php

namespace Batna\ArchiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\ArchiBundle\Entity\Contexte
 *
 * @ORM\Table(name="ARCHI_Contexte")
 * @ORM\Entity(repositoryClass="Batna\ArchiBundle\Entity\ContexteRepository")
 */
class Contexte
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
}