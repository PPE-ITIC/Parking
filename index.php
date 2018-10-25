<?php
require_once 'app/init.php';
$router->load();
$_SESSION['router'] = serialize($router);