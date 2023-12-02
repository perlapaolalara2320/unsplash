<?php

namespace Controllers;

use Model\Photo;
use Model\Usuario;

class PhotoController
{
    public static function index()
    {
        session_start();
        $photo = Photo::all();
        $respuesta = [
            'login' => isset($_SESSION['login']) ? $_SESSION['login'] : null,
            'userId' => isset($_SESSION['id']) ? $_SESSION['id'] : null,
            'photo' => $photo
        ];
        echo json_encode($respuesta);
    }

    public static function search()
    {
        $label = s($_GET['label']);
        $query = "SELECT * FROM photos WHERE label LIKE '%$label%'";
        $search = Photo::SQL($query);

        echo json_encode(['search' => $search]);
    }

    public static function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $photo = new Photo($_POST);
            $photo->userId = $_SESSION['id'];
            $resultado = $photo->guardar();
            $respuesta = [
                'type' => 'success',
                'id' => $resultado['id'],
                'message' => 'Photo added successfully',
                'userId' => $photo->userId,
                'url' => $photo->url
            ];
            echo json_encode($respuesta);
        }
    }

    public static function delete()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $usuario = Usuario::where('id', $_SESSION['id']);

            if (password_verify($_POST['password'], $usuario->password)) {
                $photo = Photo::where('id', $_POST['id']);
                if ($usuario->id !== $photo->userId) {
                    $respuesta = [
                        'type' => 'error',
                        'message' => 'Could not delete image'
                    ];
                    echo json_encode($respuesta);
                    return;
                }

                $resultado = $photo->eliminar();

                $resultado = [
                    'resultado' => $resultado,
                    'message' => 'Photo deleted Successfully',
                    'type' => 'success'
                ];

                echo json_encode($resultado);
            }
        }
    }
}
