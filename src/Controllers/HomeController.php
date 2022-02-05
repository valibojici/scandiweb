<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\ProductService;

class HomeController extends Controller
{
    public function defaultAction(array $params = [])
    {
        $productService = new ProductService();
        $products = $productService->getProducts();
        $products = array_map(function($product) { return ['info' => $product->getInfo(), 'properties' => $product->getProperties()]; }, $products);
        $view = new View();

        $view->set('products', $products);
        $view->set('title', 'Product List');
        $view->render('products', 'home');
    }
}