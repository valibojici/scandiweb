<?php

namespace App;

use App\Router\Router;

class App{
    private $router;
    public function __construct(){
        $router = new Router();
        $router->get('/scandiweb/', function() {
            echo 'root';
        });

        $router->get('/scandiweb/caca', function() {
            echo 'caca';
        });

        $router->run();
    }
}