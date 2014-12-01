<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EtudiantPromotion
 *
 * @ORM\Table(name="etudiant_promotion", indexes={@ORM\Index(name="fk_etudiant_idx", columns={"id_etudiant"}), @ORM\Index(name="fk_etus_prom_p_idx", columns={"id_promotion"})})
 * @ORM\Entity
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


}
