<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);

                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'User does not exist or is not confirmed');
                } else {
                    if (password_verify($_POST['password'], $usuario->password)) {
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['username'] = $usuario->username;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        header('Location: /');
                    } else {
                        Usuario::setAlerta('error', 'Incorrecr password');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'titulo' => 'Login',
            'message' => 'Welcome back',
            'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function forgot(Router $router)
    {
        $alertas = [];
        $mostrar = true;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);

                if ($usuario && $usuario->confirmado) {
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email = new Email($usuario->email, $usuario->name, $usuario->token);
                    $email->enviarInstrucciones();
                    $mostrar = false;

                    Usuario::setAlerta('success', 'We have sent the instructions to your email');
                } else {
                    Usuario::setAlerta('error', 'The user does not exist or is not confirmed');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/forgot', [
            'titulo' => 'forgot your password?',
            'message' => 'Enter the email address associated with your account and we’ll send you a link to reset your password.',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function reset(Router $router)
    {
        $token = s($_GET['token']);
        if (!$token) header('Location: /');
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Invalid Token');
        }

        $alertas = Usuario::getAlertas();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                $usuario->hashPassword();

                $usuario->token = null;
                // GUARDAR EL USUARIO
                $resultado = $usuario->guardar();

                // REDIRECCIONAR
                if ($resultado) {
                    header('Location:/login');
                }
            }
        }

        $router->render('auth/reset', [
            'titulo' => 'Change your password',
            'alertas' => $alertas
        ]);
        // oJ1#%$tU1y%&
    }

    public static function join(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            $userExist = Usuario::where('email', $usuario->email);

            if (empty($alertas)) {
                if ($userExist) {
                    Usuario::setAlerta('error', 'The user is already registered');
                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashPassword();

                    $usuario->crearToken();

                    $resultado = $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->name, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        if ($resultado) {
                            header('Location: /mensaje');
                        }
                    }
                }
            }
        }
        $router->render('auth/join', [
            'titulo' => 'Join Unsplash',
            'message' => 'Already have an account? <a href="/login">Login</a>',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', [
            'titulo' => 'Account created successfully'
        ]);
    }

    public static function confirmar(Router $router)
    {
        $token = $_GET['token'];
        if (!$token) {
            header('Location: /');
        }
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'account verified successfully');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirm',
            'alertas' => $alertas
        ]);
    }
}
