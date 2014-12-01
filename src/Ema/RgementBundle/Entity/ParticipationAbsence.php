<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipationAbsence
 *
 * @ORM\Table(name="participation_absence", indexes={@ORM\Index(name="fk_participation_abs_idx", columns={"id_participation"}), @ORM\Index(name="fk_abs_participation_idx", columns={"id_absence"})})
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
    private $absence;

    /**
     * @var \Participation
     *
     * @ORM\ManyToOne(targetEntity="Participation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_participation", referencedColumnName="id")
     * })
     */
    private $participation;



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
     * Set Absence
     *
     * @param \Ema\RgementBundle\Entity\Absence $absence
     * @return ParticipationAbsence
     */
    public function setAbsence(\Ema\RgementBundle\Entity\Absence $absence = null)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get Absence
     *
     * @return \Ema\RgementBundle\Entity\Absence
     */
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set Participation
     *
     * @param \Ema\RgementBundle\Entity\Participation $participation
     * @return ParticipationAbsence
     */
    public function setParticipation(\Ema\RgementBundle\Entity\Participation $participation = null)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get Participation
     *
     * @return \Ema\RgementBundle\Entity\Participation
     */
    public function getParticipation()
    {
        return $this->participation;
    }
}
