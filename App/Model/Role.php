<?php

namespace App\Model;

use Core\Database;

class Role
{
    protected $table = 'roles';
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getORM();
    }

    public function getAllRoles(): array
    {
        return $this->db->select($this->table, ['*']);
    }

    public function getRoleById(int $id): array
    {
        return $this->db->select($this->table, ['*'], ['id' => $id]);
    }
}
