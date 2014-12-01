<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipationAbsence
 *
 * @ORM\Table(name="participation_absence", indexes={@ORM\Index(name="fk_participation_abs_idx", columns={"id_participation"}), @ORM\Index(name="fk_abs_participation_idx", columns={"id_absence"})})
 * @ORM\Entity
 */
class ParticipationAbsence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_participation_absence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipationAbsence;

    /**
     * @var \Absence
     *
     * @ORM\ManyToOne(targetEntity="Absence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_absence", referencedColumnName="id")
     * })
     */
    private $idAbsence;

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
