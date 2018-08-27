<?php

require_once 'database-config.php';

class DBManager extends DBConfig {

    protected function __construct() {

        parent::__construct();
        $this->connect();
    }

    protected function DatabaseInsert($array, $tableName) {
        $fields = implode(", ", array_keys($array));
        $values = "'" . implode("','", $array) . "'";
        $query = "INSERT INTO $tableName ($fields) VALUES ($values)";

        if (mysqli_query($this->getConnection(), $query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function databaseSelect($select, $tableName, $filter = "") {

        $query = "SELECT $select FROM $tableName $filter";
        $result = mysqli_query($this->getConnection(), $query);
        return $result;
    }

    protected function databaseUpdate($array, $tableName, $where) {

        $keys = array_keys($array);
        $set = array();

        foreach ($keys as $key) {
            $set[] = "$key = '$array[$key]' ";
        }

        $set = implode(", ", $set);
        $query = "UPDATE $tableName SET $set $where";

        if (mysqli_query($this->getConnection(), $query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function databaseDelete($tableName, $where) {

        $query = "DELETE FROM $tableName $where";

        if (mysqli_query($this->getConnection(), $query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function check($tableName, $where, $check) {

        $query = "SELECT * FROM $tableName $where";

        $query_result = mysqli_query($this->getConnection(), $query);
        $status = FALSE;

        switch ($check) {
            case "EXIST":
                if (mysqli_num_rows($query_result) > 0) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
                break;
            case "UNIQUE":
                if (mysqli_num_rows($query_result) == 1) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
                break;
            default:
                echo "check invalid, make sure you are spelling it right (EXIST, UNIQUE)";
        }

        return $status;
    }

}
