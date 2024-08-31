<?php

namespace App\Controllers;

use Core\View;

class Home
{
    public function index()
    {
        View::render(['home/index'], ['title' => 'Home']);
    }

    public function example()
    {
        View::render(['home/example'], ['title' => 'Home | Example']);
    }

    public function exampleWithArgs($id = null)
    {
        View::render(['home/example_with_args'], [
            'title' => 'Home | Example',
            'id' => $id ?? 'No se envió ID'
        ]);
    }
}
