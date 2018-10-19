<?php

namespace Parking\DbTable;

/**
 * CRUD
 *
 * C REATE
 * R EAD
 * U PDATE
 * D ELETE
 *
 */

use \Db\Connexion\Pdo;

class Reservation
{
    private $db;

    public function __construct(Pdo $db) {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db->getDb();
    }
    
    public function add(\Parking\Reservation $reservation)
    {
        $stmt = 'INSERT INTO reservation ( date_debut, 
                                           date_fin, 
                                           id_pe, 
                                           id_pl)  
                                  VALUES (:date_debut,
                                          :date_fin,
                                          :id_pe,
                                          :id_pl)';
        $query = $this->getDb()->prepare($stmt);
        return $query->execute(array(
                    'date_debut'  => $reservation->getDebut(),
                    'date_fin'    => $reservation->getFin(),
                    'id_pe'       => $reservation->getPersonne()->getId(),
                    'id_pl'       => $reservation->getPlace()->getId()
        ));
    }

    public function findByPersonne($id_pe)
    {
        $sql = $this->getSqlReservation();
        $sql .= ' WHERE reservation.id_pe = ' . (int)$id_pe . ' ORDER BY date_debut DESC';
        $query = $this->getDb()->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $reservations = array();
        $i = 0;
        foreach($result as $r)
        {
            $reservations[$i] = $this->rowToObject($r);
            $i++;
        }
        return $reservations;
    }

    public function rowToObject(array $row)
    {
        $reservation = new \Parking\Reservation();
        $reservation->setId($row['id_reservation'])
                    ->setDebut($row['date_debut'])
                    ->setFin($row['date_fin']);

        if (isset($row['id_personne']))
        {
            $personne = new \Parking\Personne();
            $personne->setId($row['id_personne'])
                     ->setNom($row['nom'])
                     ->setPrenom($row['prenom'])
                     ->setMail($row['mail'])
                     ->setPassword($row['password']);
            $reservation->setPersonne($personne);
        }

        if (isset($row['id_place']))
        {
            $place = new \Parking\Place();
            $place->setId($row['id_place'])
                  ->setNumero($row['numero'])
                  ->setEtage($row['etage']);
            $reservation->setPlace($place);
        }

        return $reservation;
    }

    protected function getSqlReservation()
    {
        $sql = 'SELECT *,
                      reservation.id as id_reservation,
                       personne.id as id_personne,
                       place.id as id_place
                FROM reservation
                INNER JOIN personne
                ON reservation.id_pe = personne.id
                INNER JOIN place
                ON reservation.id_pl = place.id';

        return $sql;
    }
}