<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Presence
 *
 * @ORM\Table(name="presence", indexes={@ORM\Index(name="fk_presence_participation_idx", columns={"id_participation"})})
 * @ORM\Entity
 */
class Presence
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
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=150, nullable=true)
     */
    private $signature;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horodatage", type="datetime", nullable=false)
     */
    private $horodatage;

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
