<?php

class App {
    private $defaultMethod = 'index';
    private $defaultController = 'Pages';
    private $defaultParams = [];
    
    public function __construct() {
        $url = $this->getURL();
        
        if(isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->defaultController = $url[0];
//            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->defaultController . '.php';
        
        $this->defaultController = new $this->defaultController;
        
//if under $url[0] file was not found, that means that it is one of method of $defaultController = 'main'
        if(isset($url[0]) && is_callable($this->defaultController, $url[0])) {
            $this->defaultMethod = $url[0];
        };
        unset($url[0]);
    
        if(isset($url[1]) && method_exists($this->defaultController, $url[1])) {
            $this->defaultMethod = $url[1];
            unset($url[1]);
        };
        
        $this->defaultParams = $url ? array_values($url) : [];

        call_user_func_array([$this->defaultController, $this->defaultMethod], $this->defaultParams);
        
    }
    
    private function getURL() {
        if(isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return $url;
        }
    }
    
}