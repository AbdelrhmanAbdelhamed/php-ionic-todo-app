<?php
/**
 * A base class to handle the database configs
 */
class DBConfig {

    private $serverName;
    private $userName;
    private $password;
    private $database;
    private $con;

    protected function __construct() {

        $this->serverName = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->database = "TODOAPP";

        $this->con = NULL;
    }

    protected function getConnection() {
        return $this->con;
    }

    private function sqlconnection() {

        $con = mysqli_connect($this->serverName, $this->userName, $this->password, $this->database);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return FALSE;
        }

        return $con;
    }
    /**
     *  return a connection to the database if exist || new one if not
     */
    protected function connect() {

        if (is_null($this->con)) {
            if ($this->sqlconnection() != FALSE) {
                $this->con = $this->sqlconnection();
            }
        }
    }
}

?>