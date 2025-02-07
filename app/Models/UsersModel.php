<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {

    protected $table = "users";

    protected $primaryKey = "id";

    protected $allowedFields = ["username","password", "email", "rol"];     


    public function checkUser($user, $pass) {

        // Busca solo por username
        $user = $this->where('username', $user)->first();

        if ($user) {
            // Verifica la contraseña hasheada
            if (password_verify($pass, $user['password'])) {
                return $user; // Devuelve el usuario si la contraseña es correcta
            }
        }
        
        return false; // Si no hay usuario o la contraseña no coincide, devuelve false

    }


}