<?php

namespace App\Views;

class View
{
    private $data;
    const TEMPLATE_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    const PARTIAL_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function set(string $key, mixed $val) : void
    {
        $data[$key] = self::htmlEncode($val);
    }

    public function render(string $partial, string $template)
    {
        extract($this->data);

        ob_start();
        require View::TEMPLATE_DIR . $template . '.php';
        $tpl = ob_get_clean();

        ob_start();
        require View::PARTIAL_DIR . $partial . '.php';
        $content = ob_get_clean();

        $output = str_replace('{{content}}', $content, $tpl);
        echo $output;
    }

    public static function htmlEncode(mixed &$data) : void
    {
        if(is_array($data)){
            foreach($data as $key => &$value){
                self::htmlEncode($value);
            }
        } 
        else {
            $data = htmlspecialchars($data);
        }
    }
}