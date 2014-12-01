<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presence
 *
 * @ORM\Table(name="presence", indexes={@ORM\Index(name="fk_presence_participation_idx", columns={"id_participation"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\PresenceRepository")
 */
class Presence
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
     * @ORM\Column(name="signature", type="string", length=150, nullable=true)
     */
    private $signature;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horodatage", type="datetime", nullable=false)
     */
    private $horodatage;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set signature
     *
     * @param string $signature
     * @return Presence
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set horodatage
     *
     * @param \DateTime $horodatage
     * @return Presence
     */
    public function setHorodatage($horodatage)
    {
        $this->horodatage = $horodatage;

        return $this;
    }

    /**
     * Get horodatage
     *
     * @return \DateTime
     */
    public function getHorodatage()
    {
        return $this->horodatage;
    }

    /**
     * Set idParticipation
     *
     * @param \Ema\RgementBundle\Entity\Participation $idParticipation
     * @return Presence
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
