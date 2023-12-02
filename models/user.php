<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'name', 'lastname', 'email', 'username', 'password', 'token', 'confirmado'];

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? "";
        $this->lastname = $args['lastname'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->username = $args['username'] ?? "";
        $this->password = $args['password'] ?? "";
        $this->password_actual = $args['password_actual'] ?? "";
        $this->password_nuevo = $args['password_nuevo'] ?? "";
        $this->token = $args['token'] ?? "";
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarNuevaCuenta(): array
    {
        if (!$this->name) {
            self::$alertas['error'][] = 'First name is required';
        }

        if (!$this->lastname) {
            self::$alertas['error'][] = 'Last name is required';
        }


        if (trim($this->name) === "") {
            self::$alertas['error'][] = "First name can´t be blank";
        }

        if (trim($this->lastname) === "") {
            self::$alertas['error'][] = "Last name can´t be blank";
        }

        if (!$this->email) {
            self::$alertas['error'][] = "Email is required";
        }

        if (!$this->password) {
            self::$alertas['error'][] = "Password is required";
        }

        if (strlen($this->password) < 8) {
            self::$alertas['error'][] = "Password must contain at least 8 characters";
        }

        if (!$this->username) {
            self::$alertas['error'][] = "Username is required";
        }

        return self::$alertas;
    }
    public function validarLogin(): array
    {
        if (!$this->email) {
            self::$alertas['error'][] = "Email is required";
        }

        if (!$this->password) {
            self::$alertas['error'][] = "Password is required";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Invalid email";
        }

        return self::$alertas;
    }

    public function validarEmail(): array
    {
        if (!$this->email) {
            self::$alertas['error'][] = "Email is required";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Invalid email";
        }
        return self::$alertas;
    }

    public function validarPassword(): array
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'Password is required';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'Password must contain at least 8 characters';
        }

        return self::$alertas;
    }

    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
