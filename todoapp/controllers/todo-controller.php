<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/todoapp/models/todo.php';

class todoController {

    static function addToDo($data) {
        try {
            $toDo = new ToDo($data["Description"], $data["Remainder"], $data["isDone"], $data["userId"]);
            $status = $toDo->save();

            if ($status === FALSE) {
                echo "false";
            } else {
                echo $status;
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

    static function removeToDo($data) {
        try {
            $toDo = new ToDo($data["Id"]);
            echo $toDo->remove();
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

    static function updateToDo($data) {
        try {
            $toDo = new ToDo($data["Id"], $data["Description"], $data["Remainder"], $data["isDone"], $data["userId"]);

            if ($toDo->update() === FALSE) {
                echo "cannot update: false";
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

}

?>