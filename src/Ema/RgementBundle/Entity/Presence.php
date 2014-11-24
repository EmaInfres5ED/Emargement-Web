<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presence
 *
 * @ORM\Table(name="presence", indexes={@ORM\Index(name="fk_presence_participation_idx", columns={"id_participation"})})
 * @ORM\Entity
 */
class Presence
{
    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=150, nullable=true)
     */
    private $signature;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Ema\RgementBundle\Entity\Participation
     *
     * @ORM\ManyToOne(targetEntity="Ema\RgementBundle\Entity\Participation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_participation", referencedColumnName="id")
     * })
     */
    private $idParticipation;



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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
