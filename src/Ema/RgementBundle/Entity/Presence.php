<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presence
 *
 * @ORM\Table(name="presence", indexes={@ORM\Index(name="fk_presence_participation_idx", columns={"id_participation"})})
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
    private $participation;



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
     * Set Participation
     *
     * @param \Ema\RgementBundle\Entity\Participation $participation
     * @return Presence
     */
    public function setParticipation(\Ema\RgementBundle\Entity\Participation $participation = null)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return \Ema\RgementBundle\Entity\Participation
     */
    public function getParticipation()
    {
        return $this->participation;
    }
}
