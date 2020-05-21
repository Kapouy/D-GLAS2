<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\EtatJeu;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Inventaire
 *
 * @ORM\Table(name="inventaire")
 * @ORM\Entity(repositoryClass="App\Repository\InventaireRepository")
 */
class Inventaire
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", unique=true)
     */
    private $date;

    /**
     * @var EtatJeu
     *
     * @ORM\OneToMany(targetEntity="EtatJeu", mappedBy="inventaire"))
     * @ORM\JoinColumn(nullable=true)
     */
    private $etatJeu;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Inventaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etatJeu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etatJeu
     *
     * @param \App\Entity\EtatJeu $etatJeu
     *
     * @return Inventaire
     */
    public function addEtatJeu(\App\Entity\EtatJeu $etatJeu)
    {
        $this->etatJeu[] = $etatJeu;

        return $this;
    }

    /**
     * Remove etatJeu
     *
     * @param \App\Entity\EtatJeu $etatJeu
     */
    public function removeEtatJeu(\App\Entity\EtatJeu $etatJeu)
    {
        $this->etatJeu->removeElement($etatJeu);
    }

    /**
     * Get etatJeu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtatJeu()
    {
        return $this->etatJeu;
    }

}
