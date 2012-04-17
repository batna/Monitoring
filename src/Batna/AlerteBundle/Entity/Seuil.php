<?php

namespace Batna\AlerteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\AlerteBundle\Entity\Seuil
 *
 * @ORM\Table(name="ALERTE_Seuil")
 * @ORM\Entity(repositoryClass="Batna\AlerteBundle\Entity\SeuilRepository")
 */
class Seuil
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
     * @var integer $debut
     *
     * @ORM\Column(name="debut", type="integer")
     */
    private $debut;

    /**
     * @var integer $fin
     *
     * @ORM\Column(name="fin", type="integer")
     */
    private $fin;

    /**
     * @var string $unite
     *
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;

    /**
     * @var string $severite
     *
     * @ORM\Column(name="severite", type="string", length=255)
     */
    private $severite;

    /**
     * @var text $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text $message
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var string $variables
     *
     * @ORM\Column(name="variables", type="string", length=255)
     */
    private $variables;

    /**
     * @var Categorie $categorie
     *
     * @ORM\ManyToOne(targetEntity="Batna\AlerteBundle\Entity\Categorie")
     */
    private $categorie;

    /**
     * @var Diffusion $diffusion
     *
     * @ORM\ManyToOne(targetEntity="Batna\AlerteBundle\Entity\Diffusion")
     */
    private $diffusion;
    
	
    public function __toString()
    {
    	return $this->categorie.' : '.$this->debut.$this->unite.' => '.$this->fin.$this->unite.' : '.$this->severite;
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
     * Set debut
     *
     * @param integer $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * Get debut
     *
     * @return integer 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param integer $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * Get fin
     *
     * @return integer 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set unite
     *
     * @param string $unite
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    }

    /**
     * Get unite
     *
     * @return string 
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set severite
     *
     * @param string $severite
     */
    public function setSeverite($severite)
    {
        $this->severite = $severite;
    }

    /**
     * Get severite
     *
     * @return string 
     */
    public function getSeverite()
    {
        return $this->severite;
    }

    /**
     * Set titre
     *
     * @param text $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return text 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set variables
     *
     * @param string $variables
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    /**
     * Get variables
     *
     * @return string 
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set Categorie
     *
     * @param integer $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * Get Categorie
     *
     * @return Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set diffusion
     *
     * @param integer $diffusion
     */
    public function setDiffusion($diffusion)
    {
        $this->diffusion = $diffusion;
    }

    /**
     * Get diffusion
     *
     * @return Diffusion 
     */
    public function getDiffusion()
    {
        return $this->diffusion;
    }
}