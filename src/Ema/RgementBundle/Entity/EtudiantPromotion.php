<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtudiantPromotion
 *
 * @ORM\Table(name="etudiant_promotion", indexes={@ORM\Index(name="fk_etudiant_idx", columns={"id_etudiant"}), @ORM\Index(name="fk_etus_prom_p_idx", columns={"id_promotion"})})
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\EtudiantPromotionRepository")
 */
class EtudiantPromotion
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
     * @var \Promotion
     *
     * @ORM\ManyToOne(targetEntity="Promotion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promotion", referencedColumnName="id")
     * })
     */
    private $idPromotion;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPromotion
     *
     * @param \Ema\RgementBundle\Entity\Promotion $idPromotion
     * @return EtudiantPromotion
     */
    public function setIdPromotion(\Ema\RgementBundle\Entity\Promotion $idPromotion = null)
    {
        $this->idPromotion = $idPromotion;

        return $this;
    }

    /**
     * Get idPromotion
     *
     * @return \Ema\RgementBundle\Entity\Promotion
     */
    public function getIdPromotion()
    {
        return $this->idPromotion;
    }

    /**
     * Set idEtudiant
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $idEtudiant
     * @return EtudiantPromotion
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
}
