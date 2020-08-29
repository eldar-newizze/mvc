<?php

namespace Controllers;

use Core\Controller;
use Models\User;

class HomeController extends Controller
{
    public function index($name = '')
    {
        $userName = User::first();
        $this->view('home/index', ['name' => $userName]);
    }

    public function test()
    {
        echo 'test method by Home Controller';
    }
}
