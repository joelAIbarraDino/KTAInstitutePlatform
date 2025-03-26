<?php

namespace App\Clases;

class Auth{

    public static function encriptPassword(string $password):string{
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function generateToken():string{
        return uniqid(mt_rand(), true);
    }

    public static function generateClave():string{
        return str_pad(strval(random_int(1, 999999)), 6, '0', STR_PAD_LEFT);
    }

    public static function comparePassword(string $passwordDB, string $passwordInput):bool {
        return password_verify($passwordInput, $passwordDB);
    }

    public static function compareClave(string $claveDB, string $claveInput):bool{
        return strcmp($claveDB, $claveInput) == 0;
    }

}