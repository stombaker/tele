<?php
namespace Controller;

use Exception;

class Router {
    /** @var RouterConfig[] */
    private $config;

    public function __construct() {
        // Define all your routes here.
        // /!\ The order is **very** important
        $this->config = [
            new RouterConfig('/chaines', 'Chaine', 'list'),
            new RouterConfig('/chaine/create', 'Chaine', 'create'),
            new RouterConfig('/chaine/update', 'Chaine', 'update', ['id']),
            new RouterConfig('/chaine/delete', 'Chaine', 'delete', ['id']),
            new RouterConfig('/chaine', 'Chaine', 'read', ['id']),
            new RouterConfig('/programmes', 'Programme', 'list'),
            new RouterConfig('/programme/create', 'Programme', 'create'),
            new RouterConfig('/programme/update', 'Programme', 'update', ['id']),
            new RouterConfig('/programme/delete', 'Programme', 'delete', ['id']),
            new RouterConfig('/programme', 'Programme', 'read', ['id']),
            new RouterConfig('/programmation/create', 'Programmation', 'create', [], ['by', 'id']),
            new RouterConfig('/programmation/delete', 'Programmation', 'delete', ['chaineId', 'programmeId', 'dateDiffusion'], ['by']),
            new RouterConfig('/', 'Chaine', 'list'),
        ];
    }

    public function routeRequest() {
        // The path info (to have url as /path/to/url)
        $pathInfo = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        foreach ($this->config as $config) {
            if ($config->path === '/' && $pathInfo !== '/' && $pathInfo !== '') {
                // Default controller => do not consider as default controller but as 404.
                (new ErrorController())->notFoundAction($_SERVER['PATH_INFO']);
            } else {
                // We check each config to know which one correspond to current URL
                $strpos = strpos($pathInfo, $config->path);
                if ($strpos === 0) {
                    $params = $this->extractParameters($pathInfo, $config);
                    $paramCount = count($params);
                    $requiredCount = count($config->required);
                    $optionalCount = count($config->optional);
                    if ($requiredCount <= $paramCount && $paramCount <= $requiredCount + $optionalCount) {
                        $parameters = $this->generateControllerParameters($paramCount, $params, $config);
                        $this->launchController($config, $parameters);
                        break;
                    } else {
                        throw new Exception('The number of argument for controller ' . $config->path . ' ' .
                            '(=> ' . $config->controller . '.' . $config->action . ') is invalid.');
                    }
                }
            }
        }
    }

    /**
     * Extract parameters as indexed list from url
     *
     * @param $pathInfo
     * @param $config
     * @return array
     */
    public function extractParameters($pathInfo, $config) {
        if ($pathInfo === $config->path || $pathInfo === $config->path . '/') {
            return [];
        } else {
            $params = explode('/', substr($pathInfo, strlen($config->path)));
            array_shift($params);
            return $params;
        }
    }

    /**
     * Generated associative array of parameters in terms of required
     * @param $paramCount
     * @param $params
     * @param $config
     * @return array
     */
    public function generateControllerParameters($paramCount, $params, $config) {
        $requiredCount = count($config->required);
        $parameters = [];
        for ($i = 0; $i < $paramCount; $i++) {
            $param = $params[$i];
            if ($i < $requiredCount) {
                $parameters[$config->required[$i]] = $param;
            } else {
                $parameters[$config->optional[$i - $requiredCount]] = $param;
            }
        }
        return $parameters;
    }

    /**
     * Launch the controller in terms of given config.
     *
     * @param $config
     * @param $parameters
     * @throws Exception
     */
    public function launchController($config, $parameters) {
        $controllerName = '\\Controller\\' . $config->controller . 'Controller';
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $actionName = $config->action . 'Action';
            if (method_exists($controller, $actionName)) {
                $controller->$actionName($parameters);
            } else {
                throw new Exception('The method ' . $controllerName . '.' . $actionName . ' does not exists.');
            }
        } else {
            throw new Exception('The controller ' . $controllerName . ' does not exists.');
        }
    }
}

/**
 * Usage:<br/>
 * `new RouterConfig('/programme', 'Programme', 'read', ['id'])`<br/>
 * Will fetch all url starting by /programme, requiring one attribute
 * and send to `\\Controller\\ProgrammeController::readAction` with given attributes
 *
 * Examples of catch url: <br/>
 * `/programme/1`      => valid, sent to controller
 * `/programme/create` => valid, sent to controller (even though the id type is wrong)
 * `/programme`        => invalid because not enough parameters, throw an exception
 * `/programme/1/2`    => invalid because too much parameters, throw an exception
 *
 * @package Controller
 */
class RouterConfig {
    /**
     * The path prefix
     *
     * @var string
     */
    public $path;

    /**
     * The controller name
     * @var string
     */
    public $controller;

    /**
     * The method name of the controller
     * @var string
     */
    public $action;

    /**
     * The list of required attributes
     * @var string[]
     */
    public $required;

    /**
     * The list of optional attributes
     * @var string[]
     */
    public $optional;

    public function __construct($path, $controller, $action, $required = [], $optional = []) {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->required = $required;
        $this->optional = $optional;
    }
}