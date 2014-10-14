<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity
 */
class Document
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url_document", type="string", length=200)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $urlDocument;



    /**
     * Set id
     *
     * @param integer $id
     * @return Document
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set urlDocument
     *
     * @param string $urlDocument
     * @return Document
     */
    public function setUrlDocument($urlDocument)
    {
        $this->urlDocument = $urlDocument;

        return $this;
    }

    /**
     * Get urlDocument
     *
     * @return string 
     */
    public function getUrlDocument()
    {
        return $this->urlDocument;
    }
}
