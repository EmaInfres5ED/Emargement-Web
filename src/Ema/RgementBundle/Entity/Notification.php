<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="saw", type="boolean")
     */
    private $saw;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Notification
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set saw
     *
     * @param boolean $saw
     * @return Notification
     */
    public function setSaw($saw)
    {
        $this->saw = $saw;

        return $this;
    }

    /**
     * Get saw
     *
     * @return boolean
     */
    public function getSaw()
    {
        return $this->saw;
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
}
