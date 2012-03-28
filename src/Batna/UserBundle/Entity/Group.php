<?php

namespace Batna\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ADMIN_Group")
 * @ORM\Entity(repositoryClass="Batna\UserBundle\Entity\UserRepository")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
     protected $id;
     
     public function __toString()
     {
     	return $this->name;
     }
}