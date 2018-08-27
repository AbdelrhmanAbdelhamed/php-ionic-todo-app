<?php

require_once 'user-controller.php';
require_once 'todo-controller.php';

if (isset($_GET['action'])) {

    $action = $_GET['action'];

    $data = json_decode(file_get_contents("php://input"), true);

    switch ($action) {
        case 'setUser': userController::addUser($data);
            break;
        case 'getUser': userController::getUser($data["Email"], $data["Password"]);
            break;
        case 'listAllTodos': userController::getAllToDos($_GET['userId']);
            break;
        case 'addToDo': todoController::addToDo($data);
            break;
        case 'removeToDo': todoController::removeToDo($data["Id"]);
            break;
        case 'updateToDo': todoController::updateTodo($data);
            break;
        default:
            die('Access denied!');
    }
}
?>