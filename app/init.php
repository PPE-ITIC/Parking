<?php
ob_start();
session_start();
require_once 'config/global.php';

set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            LIB_PATH,
            SRC_PATH,
            TPL_PATH,
            CTRL_PATH,
            VIEWS_PATH,
        )
    )
);
require_once 'Ipf/Loader/ClassLoader.php';
$loader = new \Ipf\Loader\ClassLoader('Ipf', LIB_PATH);
//$conexion = new \Ipf\Db\Connection\Pdo(DB_DSN, DB_USERNAME, DB_PASSWORD);

require_once 'config/rules.php';

