<?php

namespace App;

use App\Router;
use App\Request;

class App{
    private $router;
    private $request;
    public function __construct(){
        $this->request = new Request();
        $this->router = new Router($this->request);

        $this->router->get('/scandiweb', function() {
            echo 'root';
        });

        $this->router->get('/scandiweb/add-product', function($params) {
            echo 'caca </br>';
            var_dump($params);
        });

        $this->router->run();
    }
}