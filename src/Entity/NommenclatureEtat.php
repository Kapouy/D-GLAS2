<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NommenclatureEtat
 *
 * @ORM\Table(name="nommenclature_etat")
 * @ORM\Entity(repositoryClass="App\Repository\NommenclatureEtatRepository")
 */
class NommenclatureEtat
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
     * @ORM\Column(name="nom", type="string", length=50, unique=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;
	
    /**
     * @var bool
     *
     * @ORM\Column(name="inventoriable", type="boolean")
     */
    private $inventoriable  = true;

	/**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide  = true;
	
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
     * @return NommenclatureEtat
     */
    public function setInventoriable($inventoriable)
    {
        $this->inventoriable = $inventoriable;

        return $this;
    }

		/**
     * Get valide
     *
     * @return boolean
     */
    public function isValide()
    {
        return $this->valide;
    }

/**
     * Set valide
     *
     * @param string $valide
     *
     * @return NommenclatureEtat
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }
	
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return NommenclatureEtat
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return NommenclatureEtat
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        
    }

	public function __toString() {
if ($this->nom == null) {
return '';}
		return $this->nom;
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
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }
}
