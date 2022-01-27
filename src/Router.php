<?php

namespace App;

class Router
{
    private array $handlers;
    private Request $request;

    public function get($path, $action, $params = []){
        $this->add('GET', $path, $action, $params);
    }

    public function post($path, $action, $params = []){
        $this->add('POST', $path, $action, $params);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function add(string $method, string $path, $action, array $params = [])
    {
        $this->handlers[$path]= [
            'method' => $method,
            'action' => $action,
            'params' => $params];
    }

    public function run()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $params = $this->request->getParams();

        foreach($this->handlers as $handle_path => $handle){
            if($handle_path === $path && $method === $handle['method']){
                call_user_func($handle['action'], $params);
                return;
            }
        }

        echo $path . ' not found';
    }
}