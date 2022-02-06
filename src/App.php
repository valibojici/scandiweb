<?php

namespace App;

use App\Router;
use App\Request;
use App\Controllers\ProductController;

class App{
    private $router;
    private $request;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router();

        $this->router->get('/scandiweb', [new ProductController(), 'index']);
        $this->router->get('/scandiweb/add-product', [new ProductController(), 'add']);
        $this->router->post('/scandiweb/delete-products', [new ProductController(), 'deleteProducts']);
        $this->router->post('/scandiweb/add-product', [new ProductController(), 'addProduct']);

        $this->router->run($this->request);
    }
}