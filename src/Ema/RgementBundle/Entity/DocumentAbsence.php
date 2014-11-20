<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentAbsence
 *
 * @ORM\Table(name="document_absence", indexes={@ORM\Index(name="fk_document_abs_idx", columns={"id_absence"}), @ORM\Index(name="fk_abs_document_idx", columns={"id_document"})})
 * @ORM\Entity
 */
class DocumentAbsence
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
     * @var \Ema\RgementBundle\Entity\Document
     *
     * @ORM\ManyToOne(targetEntity="Ema\RgementBundle\Entity\Document")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_document", referencedColumnName="id")
     * })
     */
    private $idDocument;

    /**
     * @var \Ema\RgementBundle\Entity\Absence
     *
     * @ORM\ManyToOne(targetEntity="Ema\RgementBundle\Entity\Absence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_absence", referencedColumnName="id")
     * })
     */
    private $idAbsence;



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
     * Set idDocument
     *
     * @param \Ema\RgementBundle\Entity\Document $idDocument
     * @return DocumentAbsence
     */
    public function setIdDocument(\Ema\RgementBundle\Entity\Document $idDocument = null)
    {
        $this->idDocument = $idDocument;

        return $this;
    }

    /**
     * Get idDocument
     *
     * @return \Ema\RgementBundle\Entity\Document 
     */
    public function getIdDocument()
    {
        return $this->idDocument;
    }

    /**
     * Set idAbsence
     *
     * @param \Ema\RgementBundle\Entity\Absence $idAbsence
     * @return DocumentAbsence
     */
    public function setIdAbsence(\Ema\RgementBundle\Entity\Absence $idAbsence = null)
    {
        $this->idAbsence = $idAbsence;

        return $this;
    }

    /**
     * Get idAbsence
     *
     * @return \Ema\RgementBundle\Entity\Absence 
     */
    public function getIdAbsence()
    {
        return $this->idAbsence;
    }
}
