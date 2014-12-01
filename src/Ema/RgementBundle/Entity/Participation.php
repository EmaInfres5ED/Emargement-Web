<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_participation_cours_idx", columns={"id_cours"}), @ORM\Index(name="fk_participation_etudiant_idx", columns={"id_etudiant"})})
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\ParticipationRepository")
 */
class Participation
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
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours", referencedColumnName="id")
     * })
     */
    private $cours;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Cours
     *
     * @param \Ema\RgementBundle\Entity\Cours $cours
     * @return Participation
     */
    public function setCours(\Ema\RgementBundle\Entity\Cours $cours = null)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get Cours
     *
     * @return \Ema\RgementBundle\Entity\Cours
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Set Etudiant
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $etudiant
     * @return Participation
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
}
