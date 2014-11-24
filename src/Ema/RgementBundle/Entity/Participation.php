<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_participation_cours_idx", columns={"id_cours"}), @ORM\Index(name="fk_participation_etudiant_idx", columns={"id_etudiant"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Ema\RgementBundle\Entity\Etudiant
     *
     * @ORM\ManyToOne(targetEntity="Ema\RgementBundle\Entity\Etudiant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $idEtudiant;

    /**
     * @var \Ema\RgementBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="Ema\RgementBundle\Entity\Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours", referencedColumnName="id")
     * })
     */
    private $idCours;



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
     * Set idEtudiant
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $idEtudiant
     * @return Participation
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
     * Set idCours
     *
     * @param \Ema\RgementBundle\Entity\Cours $idCours
     * @return Participation
     */
    public function setIdCours(\Ema\RgementBundle\Entity\Cours $idCours = null)
    {
        $this->idCours = $idCours;

        return $this;
    }

    /**
     * Get idCours
     *
     * @return \Ema\RgementBundle\Entity\Cours
     */
    public function getIdCours()
    {
        return $this->idCours;
    }
}
