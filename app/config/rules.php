<?php
if (!isset($_SESSION['router']))
{
    $router = \Ipf\Router\ClassRouter::getInstance();
    $router->setPath(CTRL_PATH);
    $router->addRule('login', array('controller' => 'personne', 'action' => 'login'));
    $router->addRule('register', array('controller' => 'personne', 'action' => 'register'));
    $router->addRule('inscription', array('controller' => 'personne', 'action' => 'inscription'));
    $router->addRule('connexion', array('controller' => 'personne', 'action' => 'connexion'));
    $router->addRule('deconnexion', array('controller' => 'personne', 'action' => 'deconnexion'));
    $router->addRule('admin', array('controller' => 'admin', 'action' => 'index'));
    $router->addRule('user', array('controller' => 'personne', 'action' => 'index'));
    $router->addRule('valider/:id', array('controller' => 'admin', 'action' => 'valider'));
    $router->addRule('refuser/:id', array('controller' => 'admin', 'action' => 'refuser'));
    $router->addRule('monter/:id', array('controller' => 'admin', 'action' => 'monter'));
    $router->addRule('descendre/:id', array('controller' => 'admin', 'action' => 'descendre'));
    $router->addRule('attribuer/:id', array('controller' => 'admin', 'action' => 'attribuer'));
}
else
{
    $router = unserialize($_SESSION['router']);
}