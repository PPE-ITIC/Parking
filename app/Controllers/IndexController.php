<?php

class IndexController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function indexAction()
    {
        $this->setView('index');
        $this->render();
    }

}