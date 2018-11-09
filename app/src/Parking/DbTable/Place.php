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

    public function findFree()
    {
        $sql = $this->getSqlStatut();
        $sql .= ' WHERE id_pl IS NULL OR id_pl NOT IN (SELECT id_pl FROM reservation WHERE date_fin >= CURRENT_DATE()) LIMIT 1 ';
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function rowToObject(array $row)
    {
        $place = new \Parking\Place();
        $place->setId($row['id_place'])
              ->setNumero($row['numero'])
              ->setEtage($row['etage']);
        return $place;
    }

    protected function getSqlStatut()
    {
        $sql = 'SELECT *,
                       place.id       as id_place,
                       reservation.id as id_reservation
                FROM place
                LEFT JOIN reservation ON place.id = reservation.id_pl';

        return $sql;
    }
}