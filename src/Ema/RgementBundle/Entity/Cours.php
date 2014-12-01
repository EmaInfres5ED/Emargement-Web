<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cybema", type="integer", nullable=false)
     */
    private $idCybema;

    /**
     * @var string
     *
     * @ORM\Column(name="salle", type="string", length=45, nullable=true)
     */
    private $salle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $dateFin;



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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Cours
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
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
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Cours
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
}
