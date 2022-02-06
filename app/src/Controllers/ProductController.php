<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\ProductService;

class ProductController
{
    public function index(array $params = []) : void
    {
        $productService = new ProductService();
        $products = $productService->getProducts();
        $products = array_map(function($product) { return ['info' => $product->getInfo(), 'properties' => $product->getDisplayProperties()]; }, $products);
        $view = new View();

        $view->set('products', $products);
        $view->set('title', 'Product List');
        $view->render('products', 'home');
    }

    public function add(array $params = []) : void
    {
        session_start();
        
        $productService = new ProductService();
        $productFields = $productService->getProductFields();
        $productMessages = [];
        foreach($productFields as $type => $fields){
            $productMessages[$type] = 'Please, provide ' . implode(', ', array_map(function($arr){
                return $arr['name'];
            }, $fields));
        }
        $view = new View();
        $view->set('title', 'Add products');
        $view->set('productNames', array_keys($productFields));
        $view->set('productFields', $productFields);
        $view->set('productMessages', $productMessages);
        if(isset($_SESSION['addproduct'])){
            $view->set('session', $_SESSION['addproduct']);
            unset($_SESSION['addproduct']);
        }
        $view->render('addproduct', 'home');
    }

    public function addProduct(array $params = []) : void
    {   
        session_start();

        foreach($params as $key => $val){
            $_SESSION['addproduct']['user_'.$key] = $val;
        }

        if(!isset($params['type'])){
            $_SESSION['addproduct']['errors']['type'] = 'Please select a type.';
            header('Location: add-product');
            exit;
        }
        
        $productService = new ProductService();
        $productFields = $productService->getProductFields()[$params['type']] ?? [];
        $productFields = array_map(function($field){ return $field['name']; }, $productFields);
        $productFields = array_merge($productFields, ['price', 'name', 'sku']);

        $insertInfo = ['type' => $params['type']];
        $errors = [];
        foreach($productFields as $field){
            $insertInfo[$field] = $params[$field] ?? '';
            if(strlen($insertInfo[$field]) === 0){
                $errors[$field] = 'Field is mandatory.';
            }
        }
        if($errors !== []){
            $_SESSION['addproduct']['errors'] = $errors;
            header('Location: add-product');
            exit;
        }
        $errors = $productService->addProduct($insertInfo);
        if($errors !== []){
            $_SESSION['addproduct']['errors'] = $errors;
            header('Location: add-product');
            exit;
        } else {
            unset($_SESSION['addproduct']);
            header('Location: ./');
            exit;
        }
    }

    public function deleteProducts($params = []) : void
    {
        $skus = json_decode($params['sku'] ?? null);
        if($skus === null){
            header('Location: ./');
            exit;
        }

        $productService = new ProductService();
        $productService->deleteProducts($skus);

        header('Location: ./');
        exit;
    }
}