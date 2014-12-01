<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retard
 *
 * @ORM\Table(name="retard", indexes={@ORM\Index(name="fk_retard_participation_idx", columns={"id_participation"}), @ORM\Index(name="fk_retard_etudiant", columns={"id_etudiant"})})
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\RetardRepository")
 */
class Retard
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
     * @var integer
     *
     * @ORM\Column(name="duree_retard", type="integer", nullable=false)
     */
    private $dureeRetard;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=255, nullable=true)
     */
    private $motif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateprevu", type="datetime", nullable=true)
     */
    private $dateprevu;

    /**
     * @var \Etudiant
     *
     * @ORM\ManyToOne(targetEntity="Etudiant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $etudiant;

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
     * Set motif
     *
     * @param string $motif
     * @return Retard
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
     * Set dateprevu
     *
     * @param \DateTime $dateprevu
     * @return Retard
     */
    public function setDateprevu($dateprevu)
    {
        $this->dateprevu = $dateprevu;

        return $this;
    }

    /**
     * Get dateprevu
     *
     * @return \DateTime
     */
    public function getDateprevu()
    {
        return $this->dateprevu;
    }

    /**
     * Set idEtudiant
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $etudiant
     * @return Retard
     */
    public function setEtudiant(\Ema\RgementBundle\Entity\Etudiant $etudiant = null)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \Ema\RgementBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * Set participation
     *
     * @param \Ema\RgementBundle\Entity\Participation $participation
     * @return Retard
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
