<?php

namespace App\Controllers;

use App\Libs\FrontController;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params = [];
    protected $_data = [];
    protected $_template;
    protected $_language;

    public function notFoundAction()
    {
        $this->_view();
    }

    public function setController($controller)
    {
        $this->_controller = $controller;
    }

    public function setAction($action)
    {
        $this->_action = $action;
    }

    public function setParams(array $params)
    {
        $this->_params = $params;
    }

    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    public function _view()
    {
        $view = VIEWS_APP . $this->_controller . '/' . $this->_action . '.view.php';

        if ($this->_action == FrontController::NOT_FOUND_ACTION) {
            require_once VIEWS_APP . 'notfound/' . "notfound" . '.view.php';
        } else {
            if (file_exists($view))
            {
                $this->_data = array_merge($this->_data, $this->_language->getDictionary());
                $this->_template->setActionView($view);
                $this->_template->setData($this->_data);
                $this->_template->renderApp();
            } else {
                require_once VIEWS_APP . 'notfound/' . "noview" . '.view.php';
            }
        }
    }
}