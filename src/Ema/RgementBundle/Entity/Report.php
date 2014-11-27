<?php

namespace Ema\RgementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ema\RgementBundle\Entity\ReportRepository")
 * @ORM\Table('')
 */
class Report
{

    private $course;
    private $absences;
    private $delays;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->course->id;
    }

    /**
     * Set course
     *
     * @param \stdClass $course
     * @return Report
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \stdClass
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set absences
     *
     * @param array $absences
     * @return Report
     */
    public function setAbsences($absences)
    {
        $this->absences = $absences;

        return $this;
    }

    /**
     * Get absences
     *
     * @return array
     */
    public function getAbsences()
    {
        return $this->absences;
    }

    /**
     * Set delays
     *
     * @param array $delays
     * @return Report
     */
    public function setDelays($delays)
    {
        $this->delays = $delays;

        return $this;
    }

    /**
     * Get delays
     *
     * @return array
     */
    public function getDelays()
    {
        return $this->delays;
    }
}
