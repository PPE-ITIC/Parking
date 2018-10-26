<?php

namespace Parking;

class Attente
{
    private $id;
    private $ordre;
    private $personne;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    public function setOrdre($ordre)
    {
        $this->ordre = (int) $ordre;
        return $this;
    }

    public function getPersonne()
    {
        return $this->personne;
    }
    /**
     * @param mixed $nom
     */
    public function setPersonne(\Parking\Personne $personne)
    {
        $this->personne = $personne;
        return $this;
    }
}
