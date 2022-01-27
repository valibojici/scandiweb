<?php

namespace App\Router;

class Router{
    private $handlers;

    public function get($path, $action, $params = []){
        $this->addRoute('GET', $path, $action, $params);
    }

    public function post($path, $action, $params = []){
        $this->addRoute('POST', $path, $action, $params);
    }

    private function addRoute($method, $path, $action, $params = []){
        $this->handlers[$path]= [
            'method' => $method,
            'action' => $action,
            'params' => $params];
    }

    public function run(){
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach($this->handlers as $handle_path => $handle){
            if($handle_path === $path && $method === $handle['method']){
                call_user_func($handle['action']);
                return;
            }
        }

        echo $path . ' not found';
    }
}