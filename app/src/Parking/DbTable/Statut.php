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

class Statut
{
    private $db;

    public function __construct(Pdo $db) {
        $this->db = $db;
    }
    
    public function getDb()
    {
        return $this->db->getDb();
    }

    public function find($id)
    {
        $sql = $this->getSqlStatut();
        $sql .= ' WHERE id = ' . (int)$id;
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function rowToObject(array $row)
    {
        $statut = new \Parking\Statut();
        $statut->setId($row['id'])
               ->setLibelle($row['libelle']);
        return $statut;
    }

    protected function getSqlStatut()
    {
        $sql = 'SELECT *
                FROM statut';

        return $sql;
    }
}