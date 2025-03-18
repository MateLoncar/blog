<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function register($username, $password) {
        return $this->user->register($username, $password);
    }

    public function login($username, $password) {
        $user = $this->user->login($username, $password);
        if ($user) {
            return $user; // Vraćamo korisnika
        }
        return false; // Ako je lozinka netačna
    }
}
