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
    private $promotion;

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
     * Set promotion
     *
     * @param \Ema\RgementBundle\Entity\Promotion $promotion
     * @return EtudiantPromotion
     */
    public function setPromotion(\Ema\RgementBundle\Entity\Promotion $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return \Ema\RgementBundle\Entity\Promotion
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set etudiant
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $etudiant
     * @return EtudiantPromotion
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
