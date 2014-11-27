<?php

namespace Ema\RgementBundle\Entity;

/**
 * JustifyAbsence
 */

class JustifyAbsence
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $cours;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $heure_debut;

    /**
     * @var string
     */
    private $heure_fin;

    /**
     * Get the value of Nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of Nom
     *
     * @param string nom
     *
     * @return self
     */
    public function setNom($value)
    {
        $this->nom = $value;

        return $this;
    }

    /**
     * Get the value of Prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @param string prenom
     *
     * @return self
     */
    public function setPrenom($value)
    {
        $this->prenom = $value;

        return $this;
    }

    /**
     * Get the value of Cours
     *
     * @return string
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Set the value of Cours
     *
     * @param string cours
     *
     * @return self
     */
    public function setCours($value)
    {
        $this->cours = $value;

        return $this;
    }

    /**
     * Get the value of Date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of Date
     *
     * @param \DateTime date
     *
     * @return self
     */
    public function setDate(\DateTime $value)
    {
        $this->date = $value;

        return $this;
    }

    /**
     * Get the value of Heure Debut
     *
     * @return string
     */
    public function getHeureDebut()
    {
        return $this->heure_debut;
    }

    /**
     * Set the value of Heure Debut
     *
     * @param string heure_debut
     *
     * @return self
     */
    public function setHeureDebut($value)
    {
        $this->heure_debut = $value;

        return $this;
    }

    /**
     * Get the value of Heure Fin
     *
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heure_fin;
    }

    /**
     * Set the value of Heure Fin
     *
     * @param string heure_fin
     *
     * @return self
     */
    public function setHeureFin($value)
    {
        $this->heure_fin = $value;

        return $this;
    }

}
