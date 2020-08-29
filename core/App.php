<?php

namespace Core;

class App
{
    protected $controllerName = "home";
    protected $controller;
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $controllerName = 'Controllers\\'.ucfirst($url[0]).'Controller';

        if (class_exists($controllerName)) {
            $this->controller = new $controllerName;
        }

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
        return [$this->controllerName];
    }
}
