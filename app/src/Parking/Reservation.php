<?php

namespace Parking;

class Reservation
{
    private $id;
    private $debut;
    private $fin;
    private $personne;
    private $place;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param mixed $id
     */
    public function setPersonne(\Parking\Personne $personne)
    {
        $this->personne = $personne;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $nom
     */
    public function setPlace(\Parking\Place $place)
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param mixed $prenom
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $prenom
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
        return $this;
    }
}
