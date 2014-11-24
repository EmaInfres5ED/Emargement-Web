<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retard
 *
 * @ORM\Table(name="retard", indexes={@ORM\Index(name="fk_retard_participation_idx", columns={"id_participation"})})
 * @ORM\Entity
 */
class Retard
{
    /**
     * @var integer
     *
     * @ORM\Column(name="duree_retard", type="integer", nullable=false)
     */
    private $dureeRetard;

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
     * Set dureeRetard
     *
     * @param integer $dureeRetard
     * @return Retard
     */
    public function setDureeRetard($dureeRetard)
    {
        $this->dureeRetard = $dureeRetard;

        return $this;
    }

    /**
     * Get dureeRetard
     *
     * @return integer 
     */
    public function getDureeRetard()
    {
        return $this->dureeRetard;
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
     * @return Retard
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
