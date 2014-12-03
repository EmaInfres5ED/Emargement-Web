<?php

namespace Ema\RgementBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;

/**
 * Warn
 */
class Warn
{
    const TYPE_ABSENCE = "absence";
    const TYPE_RETARD = "retard";
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomEleve;

    /**
     * @var \DateTime
     */
    private $retardDate;

    /**
     * @var \DateTime
     */
    private $retardHour;

    /**
     * @var string
     */
    private $motif;

    /**
     * @var \DateTime
     */
    private $absenceDateDebut;

    /**
     * @var \DateTime
     */
    private $absenceDateFin;

    /**
     * @var \string
     */
    private $type;

    public function __construct() 
    {
        $this->absenceDateDebut = new \DateTime();
        $this->absenceDateFin = new \DateTime();
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
     * Set nomEleve
     *
     * @param string $nomEleve
     * @return Warn
     */
    public function setNomEleve($nomEleve)
    {
        $this->nomEleve = $nomEleve;

        return $this;
    }

    /**
     * Get nomEleve
     *
     * @return string 
     */
    public function getNomEleve()
    {
        return $this->nomEleve;
    }

    /**
     * Set retardDate
     *
     * @param \DateTime $retardDate
     * @return Warn
     */
    public function setRetardDate($retardDate)
    {
        $this->retardDate = $retardDate;

        return $this;
    }

    /**
     * Get retardDate
     *
     * @return \DateTime 
     */
    public function getRetardDate()
    {
        return $this->retardDate;
    }

    /**
     * Set retardHour
     *
     * @param \DateTime $retardHour
     * @return Warn
     */
    public function setRetardHour($retardHour)
    {
        $this->retardHour = $retardHour;

        return $this;
    }

    /**
     * Get retardHour
     *
     * @return \DateTime 
     */
    public function getRetardHour()
    {
        return $this->retardHour;
    }

    /**
     * Set motif
     *
     * @param string $motif
     * @return Warn
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string 
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set absenceDateDebut
     *
     * @param \DateTime $absenceDateDebut
     * @return Warn
     */
    public function setAbsenceDateDebut($absenceDateDebut)
    {
        $this->absenceDateDebut = $absenceDateDebut;

        return $this;
    }

    /**
     * Get absenceDateDebut
     *
     * @return \DateTime 
     */
    public function getAbsenceDateDebut()
    {
        return $this->absenceDateDebut;
    }

    /**
     * Set absenceHourDebut
     *
     * @param \DateTime $absenceHourDebut
     * @return Warn
     */
    public function setAbsenceHourDebut($absenceHourDebut)
    {
        $this->absenceHourDebut = $absenceHourDebut;

        return $this;
    }

    /**
     * Get absenceHourDebut
     *
     * @return \DateTime 
     */
    public function getAbsenceHourDebut()
    {
        return $this->absenceHourDebut;
    }

    /**
     * Set absenceDateFin
     *
     * @param \DateTime $absenceDateFin
     * @return Warn
     */
    public function setAbsenceDateFin($absenceDateFin)
    {
        $this->absenceDateFin = $absenceDateFin;

        return $this;
    }

    /**
     * Get absenceDateFin
     *
     * @return \DateTime 
     */
    public function getAbsenceDateFin()
    {
        return $this->absenceDateFin;
    }

    /**
     * Set absenceHourFin
     *
     * @param \DateTime $absenceHourFin
     * @return Warn
     */
    public function setAbsenceHourFin($absenceHourFin)
    {
        $this->absenceHourFin = $absenceHourFin;

        return $this;
    }

    /**
     * Get absenceHourFin
     *
     * @return \DateTime 
     */
    public function getAbsenceHourFin()
    {
        return $this->absenceHourFin;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Warn
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
