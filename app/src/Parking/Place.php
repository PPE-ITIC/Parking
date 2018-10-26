<?php

namespace Parking;

class Place
{
    private $id;
    private $numero;
    private $etage;
    
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setNumero($numero)
    {
        $this->numero = (int) $numero;
        return $this;
    }
    public function getNumero()
    {
        return $this->numero;
    }
 
    
    public function getEtage()
    {
        return $this->etage;
    }

    public function setEtage($etage)
    {
        $this->etage = (int) $etage;
        return $this;
    }
}
