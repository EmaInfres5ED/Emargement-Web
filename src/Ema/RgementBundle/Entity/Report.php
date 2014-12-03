<?php

namespace Ema\RgementBundle\Entity;

/**
 * Description of Report
 *
 * @author yohan
 */
class Report
{

    private $student;
    private $absences;
    private $retards;
    private $promotion;

    function getStudent()
    {
        return $this->student;
    }

    function setStudent($student)
    {
        $this->student = $student;
    }

    function getAbsences()
    {
        return $this->absences;
    }

    function setAbsences($absences)
    {
        $this->absences = $absences;
    }

    function getRetards()
    {
        return $this->retards;
    }

    function setRetards($retards)
    {
        $this->retards = $retards;
    }

    public function getPromotion()
    {
        return $this->promotion;
    }

    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

}
