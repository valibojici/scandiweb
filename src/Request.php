<?php

namespace App;

class Request
{
    private $method;
    private $path;
    private $params;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $this->parseURL($_SERVER['REQUEST_URI']);
        $this->params = $this->method === 'GET' ? $_GET : $_POST;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParams()
    {
        return $this->params;
    }

    private function parseURL($url)
    {
        $url = rtrim(parse_url($url, PHP_URL_PATH), '/');
        return $url == '' ? '/' : $url;
    }
}