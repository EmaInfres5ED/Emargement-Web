<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipationAbsence
 *
 * @ORM\Table(name="participation_absence", indexes={@ORM\Index(name="fk_participation_abs_idx", columns={"id_participation"}), @ORM\Index(name="fk_abs_participation_idx", columns={"id_absence"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\ParticipationAbsenceRepository")
 */
class ParticipationAbsence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_participation_absence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipationAbsence;

    /**
     * @var \Absence
     *
     * @ORM\ManyToOne(targetEntity="Absence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_absence", referencedColumnName="id")
     * })
     */
    private $idAbsence;

    /**
     * @var \Participation
     *
     * @ORM\ManyToOne(targetEntity="Participation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_participation", referencedColumnName="id")
     * })
     */
    private $idParticipation;



    /**
     * Get idParticipationAbsence
     *
     * @return integer
     */
    public function getIdParticipationAbsence()
    {
        return $this->idParticipationAbsence;
    }

    /**
     * Set idAbsence
     *
     * @param \Ema\RgementBundle\Entity\Absence $idAbsence
     * @return ParticipationAbsence
     */
    public function setIdAbsence(\Ema\RgementBundle\Entity\Absence $idAbsence = null)
    {
        $this->idAbsence = $idAbsence;

        return $this;
    }

    /**
     * Get idAbsence
     *
     * @return \Ema\RgementBundle\Entity\Absence
     */
    public function getIdAbsence()
    {
        return $this->idAbsence;
    }

    /**
     * Set idParticipation
     *
     * @param \Ema\RgementBundle\Entity\Participation $idParticipation
     * @return ParticipationAbsence
     */
    public function setIdParticipation(\Ema\RgementBundle\Entity\Participation $idParticipation = null)
    {
        $this->idParticipation = $idParticipation;

        return $this;
    }

    /**
     * Get idParticipation
     *
     * @return \Ema\RgementBundle\Entity\Participation
     */
    public function getIdParticipation()
    {
        return $this->idParticipation;
    }
}
