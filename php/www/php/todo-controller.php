<?php

require_once 'todo.php';

class todoController {

    static function addToDO($data) {

        $toDo = new ToDo(NULL, $description = $data["Description"], $remainder = $data["Remainder"], $isDone = $data["isDone"], $userId = $data["userId"]);
        $status = $toDo->save();

        if ($status == FALSE) {
            echo "false";
        } else {
            echo $status;
        }
    }

    static function removeToDo($Id) {
        $toDo = new ToDO($Id = $Id);

        echo $toDo->remove();
    }

    static function updateTodo($data) {
        $toDo = new ToDo($data["Id"], $data["Description"], $data["Remainder"], $data["isDone"], $data["userId"]);

        if ($toDo->update() == FALSE) {
            echo "cannot update: false";
        }
    }

}

?>