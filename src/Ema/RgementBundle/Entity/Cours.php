<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 */
class Cours
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="professeur", type="string", length=100, nullable=true)
     */
    private $professeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_debut", type="string", length=10, nullable=true)
     */
    private $heureDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fin", type="string", length=10, nullable=true)
     */
    private $heureFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cybema", type="integer", nullable=true)
     */
    private $idCybema;

    /**
     * @var string
     *
     * @ORM\Column(name="salle", type="string", length=45, nullable=true)
     */
    private $salle;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Cours
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set professeur
     *
     * @param string $professeur
     * @return Cours
     */
    public function setProfesseur($professeur)
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * Get professeur
     *
     * @return string 
     */
    public function getProfesseur()
    {
        return $this->professeur;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Cours
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
     * Set heureDebut
     *
     * @param string $heureDebut
     * @return Cours
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return string 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param string $heureFin
     * @return Cours
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return string 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set idCybema
     *
     * @param integer $idCybema
     * @return Cours
     */
    public function setIdCybema($idCybema)
    {
        $this->idCybema = $idCybema;

        return $this;
    }

    /**
     * Get idCybema
     *
     * @return integer 
     */
    public function getIdCybema()
    {
        return $this->idCybema;
    }

    /**
     * Set salle
     *
     * @param string $salle
     * @return Cours
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return string 
     */
    public function getSalle()
    {
        return $this->salle;
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
}
