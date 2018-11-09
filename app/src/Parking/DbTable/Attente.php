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

class Attente
{
    private $db;

    public function __construct(Pdo $db) {
        $this->db = $db;
    }
    
    public function getDb()
    {
        return $this->db->getDb();
    }

    public function findByPersonne($id)
    {
        $sql = $this->getSqlAttente();
        $sql .= ' WHERE id_pe = ' . (int)$id;
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function findByOrdre($ordre)
    {
        $sql = $this->getSqlAttente();
        $sql .= ' WHERE ordre = ' . (int)$ordre;
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function findAfter($ordre)
    {
        $sql = $this->getSqlAttente();
        $sql .= ' WHERE ordre > ' . (int)$ordre;
        $query = $this->getDb()->query($sql);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $attentes = array();
        $i = 0;
        foreach($result as $a)
        {
            $attentes[$i] = $this->rowToObject($a);
            $i++;
        }
        return $attentes;
    }

    public function delete(\Parking\Attente $attente)
    {
        $stmt = 'DELETE FROM attente WHERE id = :id)';
        $query = $this->getDb()->prepare($stmt);
        return $query->execute(array(
            'id'  => $attente->getId()
        ));
    }

    public function findLast()
    {
        $sql = $this->getSqlAttente();
        $sql .= ' ORDER BY ordre DESC';
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result)
            return $this->rowToObject($result);

        return null;
    }

    public function update(\Parking\Attente $attente)
    {
        $stmt = 'UPDATE attente SET ordre = :ordre,
                                    id_pe = :id_pe
                               WHERE id   = :id';
        $query = $this->getDb()->prepare($stmt);
        return $query->execute(array(
            'ordre' => $attente->getOrdre(),
            'id_pe' => $attente->getPersonne()->getId(),
            'id'    => $attente->getId()
        ));
    }

    public function add(\Parking\Attente $attente)
    {
        $stmt = 'INSERT INTO attente ( ordre,
                                       id_pe)
                                  VALUES (:ordre,
                                          :id_pe)';
        $query = $this->getDb()->prepare($stmt);
        return $query->execute(array(
            'ordre'  => $attente->getOrdre(),
            'id_pe'  => $attente->getPersonne()->getId()
        ));
    }

    public function rowToObject(array $row)
    {
        $attente = new \Parking\Attente();
        $attente->setId($row['id_attente'])
                ->setOrdre($row['ordre']);

        if (isset($row['id_personne']))
        {
            $personne = new \Parking\Personne();
            $personne->setId($row['id_personne'])
                     ->setNom($row['nom'])
                     ->setPrenom($row['prenom'])
                     ->setMail($row['mail'])
                     ->setPassword($row['password']);
            $attente->setPersonne($personne);
        }
        return $attente;
    }

    protected function getSqlAttente()
    {
        $sql = 'SELECT *,
                       attente.id as id_attente,
                       personne.id as id_personne
                FROM attente
                INNER JOIN personne
                ON attente.id_pe = personne.id';

        return $sql;
    }
}