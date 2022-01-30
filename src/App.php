<?php

namespace App;

use App\Router;
use App\Request;
use App\Controllers\HomeController;


class App{
    private $router;
    private $request;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router();

        $this->router->get('/scandiweb', [new HomeController(), 'defaultAction']);

        $this->router->get('/scandiweb/add-product', function($params) {
            echo 'caca </br>';
            var_dump($params);
        });

        $this->router->run($this->request);
    }
}