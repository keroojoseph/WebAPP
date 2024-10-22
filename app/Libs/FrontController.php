<?php

namespace App\Libs;

class FrontController
{
    const NOT_FOUND_ACTION = 'notFoundAction';

    private $_controller = 'index';
    private $_action = 'default';
    private $_params = [];
    private $_template;
    private $_language;

    public function __construct(Template $template, Language $language)
    {
        $this->_language = $language;
        $this->_template = $template;
        $this->_parseUrl();
    }

    private function _parseUrl()
    {
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH), '/'), 3);

        if (isset($url[0]) && $url[0] != '')
        {
            $this->_controller = $url[0];
        }

        if (isset($url[1]) && $url[1] != '')
        {
            $this->_action = $url[1];
        }

        if (isset($url[2]) && $url[2] != '')
        {
            $this->_params = explode('/', $url[2]);
        }
    }

    public function dispatch()
    {
        $controllerClassName = 'App\\Controllers\\' . ucfirst($this->_controller) . 'Controller';
        $actionName = $this->_action . 'Action';

        if (!class_exists($controllerClassName))
        {
            $controllerClassName = 'App\\Controllers\\' . "NotFoundController";
        }

        $controller = new $controllerClassName();

        if (!method_exists($controller, $actionName))
        {
           $this->_action =  $actionName = self::NOT_FOUND_ACTION;
        }

        $controller->setParams($this->_params);
        $controller->setAction($this->_action);
        $controller->setController($this->_controller);
        $controller->setTemplate($this->_template);
        $controller->setLanguage($this->_language);
        $controller->$actionName();
    }
}