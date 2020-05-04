<?php


class App
{
    protected $_controller = 'mycoins';
    protected $_method = 'index';
    protected $_params = [];

    public function __construct()
    {
        $this->parseUrl();
        try {
            $this->_getController();
            $this->_getMethod();
            $this->_getParams();
            $this->run();
        } catch (Exception $ex) {
            include VIEW_PATH . DEFAULT_404_PATH;
        }

    }

    private function _getController()
    {
        if (isset($this->_params[0]) and !empty($this->_params[0])) {
            $this->_controller = ucfirst($this->_params[0]);
            unset($this->_params[0]);
        }
        if (!file_exists('../app/controllers/' . $this->_controller . '.php')) {
            throw new Exception("The controller {$this->_controller} does not exist!");
        }
        // print_r($this->_controller); 
        require_once '../app/controllers/' . $this->_controller . '.php';
        $controller_name = $this->_controller;
        $this->_controller = new $this->_controller;
        $this->_controller->loadModel($controller_name);
    }

    private function _getMethod()
    {
        if (isset($this->_params[1]) and !empty($this->_params[1])) {
            $this->_method = $this->_params[1];
            unset($this->_params[1]);
        }

        // Check to ensure the requested controller method exists.
        if (!method_exists($this->_controller, $this->_method)) {
            throw new Exception("The controller method {$this->_method} does not exist!");
        }

    }

    private function _getParams()
    {
        $this->_params = $this->_params ? array_values($this->_params) : [];
    }

    public function parseUrl()
    {
        if ($url = isset($_GET['url']) ? $_GET['url'] : '') {

            $this->_params = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
        }
    }

    public function run()
    {
        if(count($this->_params)>0) {
            $this->_controller->{$this->_method}($this->_params);
        } else {
            $this->_controller->{$this->_method}();
        }
        // call_user_func_array([$this->_controller, $this->_method], $this->_params);
    }

}
