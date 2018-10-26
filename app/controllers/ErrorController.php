<?php

class ErrorController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function indexAction()
    {
        $this->setView('404');
        $this->render();
    }
}