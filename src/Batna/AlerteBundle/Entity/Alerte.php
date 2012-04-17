<?php

namespace Batna\AlerteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Batna\AlerteBundle\Entity\Alerte
 *
 * @ORM\Table(name="ALERTE_Alerte")
 * @ORM\Entity(repositoryClass="Batna\AlerteBundle\Entity\AlerteRepository")
 */
class Alerte
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
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string $valeurs
     *
     * @ORM\Column(name="valeurs", type="string", length=255)
     */
    private $valeurs;

    /**
     * @var boolean $estDiffusee
     *
     * @ORM\Column(name="estDiffusee", type="boolean", nullable=true)
     */
    private $estDiffusee;

    /**
     * @var Seuil $seuil
     *
     * @ORM\ManyToOne(targetEntity="Batna\AlerteBundle\Entity\Seuil")
     */
    private $seuil;


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
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set valeurs
     *
     * @param string $valeurs
     */
    public function setValeurs($valeurs)
    {
        $this->valeurs = $valeurs;
    }

    /**
     * Get valeurs
     *
     * @return string 
     */
    public function getValeurs()
    {
        return $this->valeurs;
    }

    /**
     * Set estDiffusee
     *
     * @param boolean $estDiffusee
     */
    public function setEstDiffusee($estDiffusee)
    {
        $this->estDiffusee = $estDiffusee;
    }

    /**
     * Get estDiffusee
     *
     * @return boolean 
     */
    public function getEstDiffusee()
    {
        return $this->estDiffusee;
    }

    /**
     * Set Seuil
     *
     * @param integer $seuil
     */
    public function setSeuil($seuil)
    {
        $this->seuil = $seuil;
    }

    /**
     * Get Seuil
     *
     * @return Seuil 
     */
    public function getSeuil()
    {
        return $this->seuil;
    }
}