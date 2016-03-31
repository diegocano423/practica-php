<?php

namespace App\Services;

class UserService {

    private $storage;
    private $isDBReady = true;
    public function __construct() {
        if ($this->isDBReady) {
            $this->storage = new StorageService();
        }
    }
    public function login($email, $password) {
        $result = [];

        if (strlen(trim($email)) > 0) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen(trim($password)) > 0) {
                    $query = "SELECT id, email, full_name FROM usuarios WHERE email = :email AND password = :password LIMIT 1";

                    $params = [":email" => $email, ":password" => $password];

                    if ($this->isDBReady) {
                        $result = $this->storage->query($query, $params);

                        if (count($result['data']) > 0) {
                            $user = $result['data'][0];
                            $result["message"] = "User found.";
                            $result["user"] = [
                                "id" => $user["id"],
                                "email" => $user["email"],
                                "fullName" => $user["full_name"]
                            ];
                        } else {
                            $result["message"] = "Invalid credentials.";
                            $result["error"] = true;
                        }
                    } else {
                        $result["message"] = "Database has not been setup yet.";
                        $result["error"] = true;
                    }
                } else {
                    $result["message"] = "Password is required.";
                    $result["error"] = true;
                }
            } else {
                $result["message"] = "Email is invalid.";
                $result["error"] = true;
            }
        } else {
            $result["message"] = "Email is required.";
            $result["error"] = true;
        }

        return $result;
    }

    public function register($email, $password, $passwordConfirm, $fullName) {
        $result = [];

        if (strlen(trim($email)) > 0) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen(trim($password)) > 0) {
                    if strlen(trim($fullName)) > 0) {
                        if (strlen(trim($passwordConfirm)) > 0) {
                            if ($password === $passwordConfirm && $fullName) {
                                $email_query = "SELECT email FROM users WHERE email = :email LIMIT 1";
                                $query = "INSERT into usuarios (email, password, fullName) VALUES (:email, :password, :fullName)";
                                $email_params = [":email" => $email];
                                $params = [
                                    ":email" => $email,
                                    ":password" => $password,
                                    ":fullName" => $fullName,
                                ]
                                if ($this->isDBReady) {
                                    $email_exist = $this->storage->query($email_query $email_params);
                                }
                            
                                if($email_exist['data'][0]) {
                                    $result["messages"] = "This email has already been registered";
                                    $result["error"] = true;
                                } else {
                                    $result = $this->storage->query($query, $params);
                                    $result["messages"] = "User was registered correctly.";
                                    return $result;
                                }
                            } else {
                                $result["message"] = "Passwords do not match.";
                                $result["error"] = true;
                            }
                        } else {
                            $result["message"] = "Password confirm can not be empty.";
                            $result["error"] = true;
                        }
                    } else {
                        $result["message"] = "The full name can not be empty.";
                        $result["error"] = true;
                    }     
                } else {
                    $result["message"] = "The password can not be empty.";
                    $result["error"] = true;
                }
            } else {
                $result["message"] = "Please enter a valid email format.";
                $result["error"] = true;
            }
        } else {
            $result["message"] = "The email can not be empty.";
            $result["error"] = true;
        }
        return $result;
    }
}
