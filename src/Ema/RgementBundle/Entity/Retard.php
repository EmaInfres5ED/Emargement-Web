<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retard
 *
 * @ORM\Table(name="retard", indexes={@ORM\Index(name="fk_retard_participation_idx", columns={"id_participation"}), @ORM\Index(name="fk_retard_etudiant", columns={"id_etudiant"})})
 * @ORM\Entity
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
    private $idEtudiant;

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
     * @param \Ema\RgementBundle\Entity\Etudiant $idEtudiant
     * @return Retard
     */
    public function setIdEtudiant(\Ema\RgementBundle\Entity\Etudiant $idEtudiant = null)
    {
        $this->idEtudiant = $idEtudiant;

        return $this;
    }

    /**
     * Get idEtudiant
     *
     * @return \Ema\RgementBundle\Entity\Etudiant
     */
    public function getIdEtudiant()
    {
        return $this->idEtudiant;
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
