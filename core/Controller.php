<?php

namespace Core;

class Controller
{
    public function model($model)
    {
        $modelName = 'Controllers\\'.ucfirst($model);
        if (class_exists($modelName)) {
            return new $modelName();
        }
    }

    public function view($view, $data = [])
    {
        $path = __DIR__.'/../views/'.$view.'.php';
        if (file_exists($path)) {
            ob_start();
            extract($data);
            require $path;
            echo ob_get_clean();
        }
    }
}
