<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Retard
 *
 * @ORM\Table(name="retard", indexes={@ORM\Index(name="fk_retard_participation_idx", columns={"id_participation"}), @ORM\Index(name="fk_retard_etudiant", columns={"id_etudiant"})})
 * @ORM\Entity
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


}
