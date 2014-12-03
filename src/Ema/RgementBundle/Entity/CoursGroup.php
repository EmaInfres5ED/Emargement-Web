<?php

namespace Ema\RgementBundle\Entity;

class CoursGroup
{
    private $dateCours;

    private $cours = array();

    private $cpt = 0;

    /**
     * Set dateCours
     *
     * @param \DateTime $dateCours
     * @return CoursGroup
     */
    public function setDateCours($dateCours)
    {
        $this->dateCours = $dateCours;

        return $this;
    }

    /**
     * Get dateCours
     *
     * @return \DateTime 
     */
    public function getDateCours()
    {
        return $this->dateCours;
    }

   /**
     * Set cours
     *
     * @param \Ema\RgementBundle\Entity\Etudiant $cours
     * @return CoursGroup
     */
    public function addCours($cours)
    {
        $this->cours[$this->cpt] = $cours;
        $this->cpt++;
        return $this;
    }

    /**
     * Get cours
     *
     * @return \Ema\RgementBundle\Entity\Cours
     */
    public function getCours()
    {
        return $this->cours;
    }
}
