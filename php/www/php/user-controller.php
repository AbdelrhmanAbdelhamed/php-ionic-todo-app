<?php

require_once 'user.php';

class userController {

    static function addUser($user) {
        $status = User::getInstance()->addUser($user);

        if ($status == FALSE) {
            echo "false";
        } else {
            echo $status;
        }
    }

    static function getUser($email, $password) {

        $user = User::getInstance()->getUser($email, $password);

        if ($user == FALSE) {
            echo "false";
        } else {
            echo $user;
        }
    }

    static function getAllToDos($userId) {
        $status = User::getInstance()->getAllToDos($userId);

        if ($status == FALSE) {
            echo "null";
        } else {
            echo $status;
        }
    }

}

?>