<?php

namespace Ipf\Db\Connection;

class Pdo
{
    private $instance;

    public function __construct($dsn, $username, $password, array $options = array())
    {
        $this->instance = new \PDO($dsn, $username, $password, $options);
    }

    /**
     * @return \Pdo
     */
    public function getDb()
    {
        return $this->instance;
    }
}
