<?php

namespace App\Models;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = include(ROOT . '/Core/Database.php');
    }

    public function getAllUsers()
    {
        return $this->db->select('users', '*');
    }

}



?>