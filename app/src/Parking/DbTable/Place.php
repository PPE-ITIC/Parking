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

use Ipf\Db\Connection\Pdo;

class Place
{
    private $db;

    public function __construct(Pdo $db) {
        $this->db = $db;
    }
    
    public function getDb()
    {
        return $this->db->getDb();
    }

    public function findAll()
    {
        $sql = $this->getSqlPersonne();
        $query = $this->getDb()->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $personnes = array();
        $i = 0;
        foreach($result as $p)
        {
            $personnes[$i] = $this->rowToObject($p);
            $i++;
        }
        return $personnes;
    }

    public function find($id)
    {
        $sql = $this->getSqlPersonne();
        $sql .= ' WHERE personne.id = ' . (int)$id;
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function rowToObject(array $row)
    {
        $personne = new \Parking\Personne();
        $personne->setId($row['id_personne'])
                 ->setNom($row['nom'])
                 ->setPrenom($row['prenom'])
                 ->setMail($row['mail'])
                 ->setPassword($row['password']);

        if (isset($row['id_statut']))
        {
            $statut = new \Parking\Statut();
            $statut->setId($row['id_statut'])
                   ->setLibelle($row['libelle']);
            $personne->setStatut($statut);
        }

        if (isset($row['id_attente']))
        {
            $attente = new \Parking\Attente();
            $attente->setId($row['id_attente'])
                    ->setDate($row['date']);
            $personne->setAttente($attente);
        }

        $crudReservation = new \Parking\DbTable\Reservation($this->db);
        $reservations = $crudReservation->findByPersonne($row['id_personne']);
        foreach($reservations as $reservation)
        {
            $personne->addResevation($reservation);
        }

        return $personne;
    }

    protected function getSqlPersonne()
    {
        $sql = 'SELECT *,
                       personne.id as id_personne,
                       statut.id  as id_statut,
                       attente.id as id_attente
                FROM personne
                INNER JOIN statut
                ON personne.id_s = statut.id
                LEFT JOIN attente
                ON personne.id = attente.id_pe';

        return $sql;
    }
}