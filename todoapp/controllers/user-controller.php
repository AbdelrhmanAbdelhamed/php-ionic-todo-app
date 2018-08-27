<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/todoapp/models/user.php';

class userController {

    static function addUser($user) {
        $status = User::getInstance()->addUser($user);

        if ($status == FALSE) {
            echo "false";
        } else {
            echo $status;
        }
    }

    static function getUser($data) {
        $user = User::getInstance()->getUser($data['Email'], $data['Password']);

        if ($user == FALSE) {
            echo "false";
        } else {
            echo $user;
        }
    }

    static function getAllToDos($data) {
        try {
            $status = User::getInstance()->getAllToDos($data[0]);

            if ($status == FALSE) {
                echo "null";
            } else {
                echo $status;
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

}

?>