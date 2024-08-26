<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
    }
}

?>