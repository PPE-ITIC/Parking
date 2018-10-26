<?php

// Chemin d'application
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(dirname(__DIR__)) . DS);
define('LIB_PATH', ROOT_PATH . 'vendor' . DS);
define('APP_PATH', ROOT_PATH . 'app' . DS);
define('SRC_PATH', APP_PATH . 'src' . DS);
define('TPL_PATH', APP_PATH . 'tpl' . DS);
define('CTRL_PATH', APP_PATH . 'controllers' . DS);
define('VIEWS_PATH', APP_PATH . 'views' . DS);

// Base urls
define('BASE_URL', '/Parking/');
define('CSS_PATH', BASE_URL . 'css/');
define('JS_PATH', BASE_URL . 'js/');
define('IMG_PATH', BASE_URL . 'images/');
define('DOC_PATH', BASE_URL . 'files/');

// Accès de connection à la base de données
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'parking');
define('DB_ENCODING', 'UTF8');
define('DB_DSN', sprintf('mysql:host=%s;dbname=%s;', 
    DB_HOST,
    DB_NAME
));


define('NI_ID', 1);
define('INV_ID', 2);
define('IV_ID', 3);
define('IA_ID', 4);
define('IOK_ID', 5);
define('IKO_ID', 6);