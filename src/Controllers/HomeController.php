<?php

namespace App\Controllers;

use App\App;
use App\Views\View;

class HomeController extends Controller
{
    public function defaultAction(array $params = [])
    {
        $db = $this->getDB();
        $stmt = $db->query('SELECT name FROM products');
        while ($row = $stmt->fetch())
        {
            echo $row['name'] . "</br>";
        } 
        
        $view = new View();
        $view->render('productlist','home');
    }
}