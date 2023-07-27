<?php
require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=api', 'root', ''));

Flight::route('/', function () {
    echo 'Usa la tura tasks';
});

//Pedir lista
Flight::route('GET /tasks', function () {
    try {
        $sentence = Flight::db()->prepare("SELECT * FROM `tasks`");
        $sentence->execute();
        $data = $sentence->fetchAll();
        $response = [
            "success" => true,
            "tasks" => $data
        ];
    } catch (\Throwable $th) {
        $response = [
            "success" => false,
            "message" => $th
        ];
    }

    Flight::json($response);
});

//Pedir uno
Flight::route('GET /tasks/@id', function ($id) {
    try {
        $sentence = Flight::db()->prepare("SELECT * FROM `tasks` WHERE id = $id");
        $sentence->execute();
        $data = $sentence->fetchAll();
        $response = [
            "success" => true,
            "tasks" => $data
        ];
    } catch (\Throwable $th) {
        $response = [
            "success" => false,
            "message" => $th
        ];
    }

    Flight::json($response);
});

//Agregar a la lista
Flight::route('POST /tasks', function () {
    try {
        $description = (Flight::request()->data->description);
        echo ($description);

        $sql = "INSERT INTO `tasks` (description) VALUES (?)";
        $sentence = Flight::db()->prepare($sql);
        $sentence->bindParam(1, $description);
        $sentence->execute();

        $response = [
            "success" => true,
            "message" => "Tarea agregada correctamente"
        ];
    } catch (\Throwable $th) {
        $response = [
            "success" => false,
            "message" => $th
        ];
    }


    Flight::json($response);
});


//Eliminar de lista
Flight::route('DELETE /tasks/@id', function ($id) {
    try {
        $sql = "DELETE FROM `tasks` WHERE id = ?";
        $sentence = Flight::db()->prepare($sql);
        $sentence->bindParam(1, $id);
        $sentence->execute();

        $response = [
            "success" => true,
            "message" => "Tarea eliminada correctamente"
        ];
    } catch (\Throwable $th) {
        $response = [
            "success" => false,
            "message" => $th
        ];
    }


    Flight::json($response);
});

//Marcar uno de lista
Flight::route('PUT /tasks/@id', function ($id) {
    try {
        $sentence1 = Flight::db()->prepare("SELECT completed FROM `tasks` WHERE id = ?");
        $sentence1->bindParam(1, $id);
        $sentence1->execute();
        $data = $sentence1->fetch();
        if ($data["completed"] == 1) {
            $completed = 0;
            $message = "Tarea desmarcada como completada";
        }else {
             $completed = 1;
             $message = "Tarea marcada como completada";
        }
           
        $sql = "UPDATE `tasks` SET completed = $completed  WHERE id = ?";
        $sentence = Flight::db()->prepare($sql);
        $sentence->bindParam(1, $id);
        $sentence->execute();

        $response = [
            "success" => true,
            "message" => $message
        ];
    } catch (\Throwable $th) {
        $response = [
            "success" => false,
            "message" => $th
        ];
    }


    Flight::json($response);
});

Flight::start();
