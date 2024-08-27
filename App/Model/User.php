<?php

namespace App\Model;

use Core\Database;

class User
{
    protected $table = 'users';
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getORM();
    }

    public function getAllUsers(): array
    {
        return $this->db->select($this->table, '*');
    }

    public function getUserById(int $id): array
    {
        return $this->db->select($this->table, '*', ['id' => $id]);
    }
}
