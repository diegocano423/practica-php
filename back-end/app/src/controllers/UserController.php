<?php

namespace App\Controllers;

use App\Services\UserService;
use Slim\Http\Request;

class UserController {

    private $userService;
    private $nombreCookie = "loggedIn";
    public function __construct() {
        $this->userService = new UserService();
    }
    public function login($request) {
        $result = [];
        $formData = $request->getParsedBody();
        $email = null;
        $password = null;

        if (array_key_exists("email", $formData)) {
            $email = $formData["email"];
        }

        if (array_key_exists("password", $formData)) {
            $password = $formData["password"];
        }

        if (isset($email, $password)) {
            $loginResult = $this->userService->login($email, $password);

            if (array_key_exists("error", $loginResult)) {
                $result["error"] = true;
            } else {
                setcookie($this->nombreCookie, true, time()+3600);
            }

            $result["message"] = $loginResult["message"];
        } else {
            $result["error"] = true;
            $result["message"] = "Email and password can not be empty.";
        }

        return $result;
    }

    public function logout($request) {
        $result = [];    
        if (isset($_COOKIE["loggedIn"])) {
            unset($_COOKIE["loggedIn"]);
            $result["valid"] = true;
            return $result;
        } else {
            $result["valid"] = false;
            return $result;
        }

        return $result;
    }

    public function register($request) {
        $result = [];
        $formData = $request => getParsedBody();
        $email = null;
        $password = null;
        $passwordConfirm = null;
        $fullName = null;

        if (array_key_exists("email", $formData)) {
            $email = $formData["email"];
        }

        if (array_key_exists("password", $formData)) {
            $password = $formData["password"];
        }

        if (array_key_exists("passwordConfirm", $formData)) {
            $passwordConfirm = $formData["passwordConfirm"];
        }

        if (array_key_exists("fullName", $formData)) {
            $fullName = $formData["fullName"];
        }

        if (isset($email, $password)) {
            $register = $this->userService->register($email, $password, $passwordConfirm, $fullName, $phone);

            if (array_key_exists("error", $register)) {
                $result["error"] = true;
            } else {
                setcookie($this->nombreCookie, true, time()+3600);
            }

            $result = $register;
        } else {
            $result["error"] = true;
            $result["message"] = "Email and password can not be empty.";
        }

        return $result;
    }

}
