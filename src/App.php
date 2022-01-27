<?php

namespace App;

use App\Router;

class App{
    private $router;
    public function __construct(){
        $this->router = new Router();
        $this->router->get('/scandiweb/', function() {
            echo 'root';
        });

        $this->router->get('/scandiweb/caca', function() {
            echo 'caca';
        });

        $this->router->run();
    }
}