<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var bool
     *
     * @ORM\Column(name="jeuUtilisable", type="boolean")
     */
    private $jeuUtilisable;
	
	/**
     * @var bool
     *
     * @ORM\Column(name="inventoriable", type="boolean")
     */
    private $inventoriable  = true;
	
	/**
     * @var bool
     *
     * @ORM\Column(name="defaut", type="boolean")
     */
    private $defaut  = true;

	/**
     * Get inventoriable
     *
     * @return boolean
     */
    public function isInventoriable()
    {
        return $this->inventoriable;
    }

    /**
     * Set inventoriable
     *
     * @param string $inventoriable
     *
     * @return Lieu
     */
    public function setInventoriable($inventoriable)
    {
        $this->inventoriable = $inventoriable;

        return $this;
    }
	
	/**
     * Get defaut
     *
     * @return boolean
     */
    public function isDefaut()
    {
        return $this->defaut;
    }

    /**
     * Set defaut
     *
     * @param string $defaut
     *
     * @return Lieu
     */
    public function setDefaut($defaut)
    {
        $this->defaut = $defaut;

        return $this;
    }
	
    /**
     * @var Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $lieuParent;


    /**
     * @var Lieu
     *
     * @ORM\OneToMany(targetEntity="Lieu", mappedBy="lieuParent", fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     */
     private $lieuFils;

     
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Lieu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set jeuUtilisable
     *
     * @param boolean $jeuUtilisable
     *
     * @return Lieu
     */
    public function setJeuUtilisable($jeuUtilisable)
    {
        $this->jeuUtilisable = $jeuUtilisable;

        return $this;
    }

    /**
     * Get jeuUtilisable
     *
     * @return bool
     */
    public function getJeuUtilisable()
    {
        return $this->jeuUtilisable;
    }

    /**
     * Set lieuParent
     *
     * @param Lieu $lieuParent
     *
     * @return Lieu
     */
    public function setLieuParent(Lieu $lieuParent)
    {
        $this->lieuParent = $lieuParent;

        return $this;
    }

    /**
     * Get lieuParent
     *
     * @return Lieu
     */
    public function getLieuParent()
    {
        return $this->lieuParent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lieuFils = new \Doctrine\Common\Collections\ArrayCollection();
		$this->jeuUtilisable = true;
    }

	public function __toString() {
      		if ($this->getLieuParent() != null) {
      			return $this->getLieuParent()->getNom().'-'.$this->nom;
      		}
      		return ''.$this->nom;
      	}
	
    /**
     * Add lieuFil
     *
     * @param \App\Entity\Lieu $lieuFil
     *
     * @return Lieu
     */
    public function addLieuFil(\App\Entity\Lieu $lieuFil)
    {
        $this->lieuFils[] = $lieuFil;

        return $this;
    }

    /**
     * Remove lieuFil
     *
     * @param \App\Entity\Lieu $lieuFil
     */
    public function removeLieuFil(\App\Entity\Lieu $lieuFil)
    {
        $this->lieuFils->removeElement($lieuFil);
    }

    /**
     * Get lieuFils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLieuFils()
    {
        return $this->lieuFils;
    }

    /**
     * Get inventoriable
     *
     * @return boolean
     */
    public function getInventoriable()
    {
        return $this->inventoriable;
    }

    /**
     * Get defaut
     *
     * @return boolean
     */
    public function getDefaut()
    {
        return $this->defaut;
    }
}
