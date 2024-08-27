<?php

require '../vendor/autoload.php';

use App\Model\Role;

$roleModel = new Role();

echo "Todos los roles:\n";
$allRoles = $roleModel->getAllRoles();
print_r($allRoles);

echo "\nRoleID 3:\n";
$roleById = $roleModel->getRoleById(3);
print_r($roleById);
