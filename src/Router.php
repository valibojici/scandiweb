<?php

namespace App;

class Router
{
    private array $handlers;

    public function get($path, $action){
        $this->add('GET', $path, $action);
    }

    public function post($path, $action){
        $this->add('POST', $path, $action);
    }

    private function add(string $method, string $path, $action)
    {
        $this->handlers[$path][$method] = $action;
    }

    public function run(Request $request)
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        $params = $request->getParams();
 
        foreach($this->handlers as $handle_path => $handle_methods){
            if($handle_path === $path){
                foreach($handle_methods as $handle_method => $handle){
                    if($method === $handle_method){
                        call_user_func($handle, $params);
                        return;
                    }
                }
            }
        }
        echo 'Not Found';
    }
}