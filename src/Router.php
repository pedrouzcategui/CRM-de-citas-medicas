<?php

namespace MVC;

class Router {
    /**
     * 
     * $routes Structure
     * $routes = {
     *   "GET": [
     *     "/": {
     *          'controller': LoginController:class,
     *          'action': 'index'
     *      }
     *   ]
     * }
     * 
     */
    protected $routes = [];

    public function addRoute($route, $controller, $action, $method = 'GET') {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action){
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function put($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "PUT");
    }

    public function delete($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "DELETE");
    }

    public function dispatch() {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $controller = new $controller();
            $controller->$action();
        } else {
            Controller::NotFound();
        }
    }
}
    