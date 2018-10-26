<?php

namespace Parking;

class Personne
{
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $isAdmin;
    private $statut;
    private $attente;
    private $reservations = array();

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    public function isAdmin($db = false)
    {
        if ($db)
            return $this->isAdmin;
        
        if ($this->isAdmin === 1)
        {
            return true;
        }
        
        return false;
    }
    
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = (int) $isAdmin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut(\Parking\Statut $statut)
    {
       $this->statut = $statut;
       return $this;
    }

    public function getAttente()
    {
        return $this->attente;
    }

    public function setAttente(\Parking\Attente $attente)
    {
        $this->attente = $attente;
        return $this;
    }

    public function getReservations()
    {
        return $this->reservations;
    }

    public function getReservation($i)
    {
        if (isset($this->reservations[$i]))
            return $this->reservations[$i];
        return null;
    }

    public function addResevation(\Parking\Reservation $reservation)
    {
        array_push($this->reservations, $reservation);
        return $this;
    }
}
