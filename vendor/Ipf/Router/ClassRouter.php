<?php

namespace Ipf\Router;

class ClassRouter
{
    private static $instance = null;
    /**
     * Controller à utiliser. Par défaut index
     * @var string
     */
    private $controller;

    /**
     * Action du controller. Par défaut index
     * @var string
     */
    private $action;

    /**
     * Liste des derniers controllers.
     * @var string
     */
    private $lastController = 'IndexController';

    /**
     * Liste des dernières actions.
     * @var string
     */
    private $lastAction = 'indexAction';

    /**
     * Tableau des paramètres
     * @var array
     */
    private $params;

    /**
     * Liste des règles de routage
     * @var array
     */
    private $rules;

    /**
     * Chemin vers le dossier contenant les controllers
     * @var string
     */
    private $path;

    /**
     * Fichier à inclure
     * @var string
     */
    private $file;

    /**
     * Controller par défaut (index)
     * @var string
     */
    private $defaultController = 'IndexController';

    /**
     * Action par défaut (index)
     * @var string
     */
    private $defaultAction = 'indexAction';

    /**
     * Controller à appeler en cas d'erreur. Par défaut error
     * @var string
     */
    private $errorController = 'ErrorController';

    /**
     * Action à appeler en cas d'erreur. Par défaut index
     * @var string
     */
    private $errorAction = 'indexAction';

    /**
     * Liste des deux derniers url
     * @var array
     */
    private $lastUri;

    /**
     * Liste des action dont l'URI n'est pas à sauvegarder
     * @var array
     */
    private $actionNoSave;

    private function __construct()
    {
        $this->rules          = array();
        $this->lastUri        = array();
        array_unshift($this->lastUri, BASE_URL);
        $this->actionNoSave   = array('updateAction', 'deleteAction', 'connexionAction', 'deconnexionAction', 'errorAction');
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new \Ipf\Router\ClassRouter();

        return self::$instance;
    }

    public function load()
    {
        if ($_SERVER['REQUEST_URI'] == BASE_URL)
        {
            $this->controller = $this->defaultController;
            $this->action     = $this->defaultAction;
        }
        else
        {
            $script = $_SERVER['SCRIPT_NAME'];
            $url    = $_SERVER['REQUEST_URI'];
            $tabUrl = $this->formatUrl($url, $script);
            $isCustom = false;

            $this->clearEmptyValue($tabUrl);

            if (!empty($this->rules))
            {
                foreach ($this->rules as $key => $data)
                {
                    $params = $this->matchRules($key, $tabUrl);

                    if ($params !== false)
                    {
                        $this->controller = $data['controller'];
                        $this->action     = $data['action'];
                        $this->params     = $params;
                        $isCustom         = true;
                        break;
                    }
                }
            }
            if (!$isCustom)
                $this->getRoute($tabUrl);

            $this->controller   = (!empty($this->controller)) ? ucfirst($this->controller . 'Controller') : $this->defaultController;
            $this->action       = (!empty($this->action)) ? $this->action . 'Action' : $this->defaultAction;
        }

        $ctrlPath           = str_replace('_', DS, $this->controller);
        $this->file         = realpath($this->path) . DS . $ctrlPath . '.php';

        if (!is_file($this->file))
        {
            header('HTTP/1.0 404 Not Found');
            $this->controller = $this->errorController;
            $this->action     = $this->errorAction;
            $this->file       = realpath($this->path) . DS . $this->controller . '.php';
        }

        include $this->file;

        $controller = new $this->controller($this);

        if (!is_callable(array($controller, $this->action)))
        {
            $action = $this->defaultAction;
        }
        else
        {
            $action = $this->action;
        }
        $controller->$action($this->params);
        $this->setLastUri();
    }

    private function setLastUri()
    {
        if ($this->getLastUri(0) != $_SERVER['REQUEST_URI'] &&
            !in_array($this->action, $this->actionNoSave))
        {
            if (count($this->lastUri) === 2)
            {
                array_pop($this->lastUri);
            }
            array_unshift($this->lastUri, $_SERVER['REQUEST_URI']);
        }

        return $this;
    }

    public function getLastUri($i)
    {
        if (isset($this->lastUri[$i]))
            return $this->lastUri[$i];

        return null;
    }

    public function getLastController()
    {
        return $this->lastController;
    }

    public function getLastAction()
    {
        return $this->lastAction;
    }

    public function getNoSave()
    {
        return $this->noSave;
    }

    private function formatUrl($url, $script)
    {
        $tabUrl    = explode('/', $url);
        $tabScript = explode('/', $script);
        $size      = count($tabScript);
        for ($i = 0; $i < $size; $i++)
            if ($tabScript[$i] == $tabUrl[$i])
                unset($tabUrl[$i]);

        return array_values($tabUrl);
    }

    private function clearEmptyValue(&$array)
    {
        foreach ($array as $key => $value)
            if (empty($value))
                unset($array[$key]);

        $array = array_values($array);
    }

    public function matchRules($rule, $dataItems)
    {
        $ruleItems = explode('/', $rule);
        $this->clearEmptyValue($ruleItems);

        if (count($ruleItems) == count($dataItems))
        {
            $result = array();
            foreach ($ruleItems as $rKey => $rValue)
            {
                if ($rValue[0] == ':')
                {
                    $rValue = substr($rValue, 1);
                    if (!is_numeric($dataItems[$rKey]))
                        return false;

                    $result[$rValue] = $dataItems[$rKey];
                }
                else
                {
                    if ($rValue != $dataItems[$rKey])
                        return false;
                }
            }
            return $result;
        }
        return false;
    }

    private function getRoute($url)
    {
        $items = $url;
        if (!empty($items))
        {

            $this->controller = array_shift($items);
            $this->action     = array_shift($items);
            $size = count($items);
            if($size >= 2)
                for($i=0; $i< $size; $i += 2)
                {
                    $key	= (isset($items[$i])) ? $items[$i] : $i;
                    $value	= (isset($items[$i+1])) ? $items[$i+1] : null;
                    $this->params[$key] = $value;
                }
            else
                $this->params = $items;
        }
    }

    public function addRule($rule, $target)
    {
        if ($rule[0] != '/')
            $rule = '/' . $rule;
        $this->rules[$rule] = $target;
    }

    /**
     * Retourne l'action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Retourne le controller
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Défini le chemin des controllers
     * @param string $path
     */
    public function setPath($path)
    {
        if (is_dir($path) === false)
        {
            throw new \InvalidArgumentException('Controller invalide : ' . $path);
        }
        $this->path = $path;
    }

    /**
     * Renvoi les paramètres disponibles
     * @return array
     */
    public function getParameters()
    {
        return $this->params;
    }
}