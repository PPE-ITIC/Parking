<?php

abstract class BaseController
{

    protected $router;
    protected $view;
    protected $connection;


    function __construct($router)
    {
        $this->router     = $router;
        $this->connection = new \Ipf\Db\Connection\Pdo(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function render($data = array())
    {
        include_once $this->view.'.php';
    }
}