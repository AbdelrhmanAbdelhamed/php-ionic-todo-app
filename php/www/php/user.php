<?php

require_once 'database-manager.php';

class User extends DBManager {

    private $tableName;
    private $foreignTableName;
    private static $_instance = null;

    final protected function __construct() {

        parent::__construct();
        $this->tableName = 'users';
        $this->foreignTableName = 'todos';
    }

    public function addUser($user) {
        if (!($this->check($this->tableName, "WHERE email = '$user[Email]'", 'EXIST')) && ($this->DatabaseInsert($user, $this->tableName))) {
            return mysqli_insert_id($this->getConnection());
        } else {
            return FALSE;
        }
    }

    public function getUser($email, $password) {
        $result = $this->databaseSelect("`Id`, `Name`, `Email`, `password`", 'users', "WHERE email = '$email' and password = '$password'");

        if ($this->check($this->tableName, "WHERE email = '$email' and password = '$password'", 'EXIST')) {
            return (json_encode(mysqli_fetch_assoc($result)));
        } else {
            return FALSE;
        }
    }

    public function getAllToDos($userId) {

        if ($this->check($this->foreignTableName, "WHERE userId = $userId", 'EXIST')) {
            $result = $this->databaseSelect('*', $this->foreignTableName, "WHERE userId = $userId");
            $toDos = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $toDo = new ToDo($row['Id'], $row['Description'], $row['Remainder'], $row['isDone'], $row['userId']);
                if ($toDo->getStatus() === FALSE) {
                    return "bad arguments";
                }
                array_push($toDo, $toDo);
            }
            return json_encode($toDos);
        } else {
            return FALSE;
        }
    }
    
    public static function getInstance() {

        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

}

?>