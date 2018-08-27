<?php

require_once 'database-manager.php';

class ToDo extends DBManager {

    static $tableName = 'todos';
    public $Id;
    public $Description;
    public $Remainder;
    public $isDone;
    public $userId;

    function __construct($Id, $description, $remainder, $isDone, $userId) {

        parent::__construct();

        if ($Id !== NULL) {
            $this->Id = $Id;
        }
        $this->Description = $description;
        $this->Remainder = $remainder;
        $this->isDone = $isDone;
        $this->userId = $userId;
    }

    function save() {
        if ((!($this->check(self::$tableName, "WHERE Description = '$this->Description' and userId = '$this->userId'", 'EXIST')) && (($this->DatabaseInsert(get_object_vars($this), self::$tableName)) == TRUE))) {
            return mysqli_insert_id($this->getConnection());
        } else {
            return FALSE;
        }
    }

    function remove() {

        if (($this->check(self::$tableName, "WHERE Id = $this->Id", 'EXIST')) && ($this->DatabaseDelete(self::$tableName, "WHERE Id = $this->Id"))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update() {
        if (!(($this->check(self::$tableName, "WHERE Description = '$this->Description'", 'EXIST')) && ($this->DatabaseUpdate(array("isDone" => $this->isDone), self::$tableName, "WHERE Id = $this->Id")))) {
            return FALSE;
        }
    }

}

?>