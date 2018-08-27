<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/todoapp/databases/database-manager.php';

class ToDo extends DBManager {

    static $tableName = 'todos';
    public $Id;
    public $Description;
    public $Remainder;
    public $isDone;
    public $userId;
    
    /**
     * In attempt to implement a constructor overloading like the c++/java I had to do it like this way
     * Grab the number of the parameters being passed to the constructor
     * Check for how many parameters
     *
     * 
     * @throws Exception if the arguments list isn't match (1,4,5);
     */
    function __construct() {

        parent::__construct();
        
        // Grab the number of the parameters being passed to the constructor
        $numargs = func_num_args();
        
        // Check for how many parameters being passed
        if ($numargs !== 4 && $numargs !== 1 && $numargs !== 5) {
            throw new Exception("bad arguments for ToDo constructor");
        } else {
            
            // Grab the properties name of the current class an put it into array
            $properties = array_keys(get_object_vars($this));
            
            // A Counter/Pointer to indicate the start of the parameters
            $paramsCounter = 0;
            
            /*********** A Counter/Pointer to indicate the start of the properties (to be able to ignore the Id property as all my calling is in order **************
            ************ I could just passing an array that its keys name is the same as the properties name so it can be more flexible but it dosen't matter is this situation ************
                
            $propsPointer = 0;
            if ($numargs === 4) {
                $propsPointer = 1;
            }
            *********************************************************************************************************************************************************/
            
            // Fill the $properties with the arguments values (In order)
            while ($paramsCounter < $numargs) {
                $prop = $properties[$propsPointer++];
                $this->$prop = func_get_arg($paramsCounter++);
            }
        }
    }
    
    /**
     * If the desired todo's description isn't exist and not problems with the query, then save it 
     * @return last inserted Id on sucess and FALST on faliure
     */
    function save() {
        if ((!($this->check(self::$tableName, "WHERE Description = '$this->Description' and userId = '$this->userId'", 'EXIST'))
            && (($this->DatabaseInsert(get_object_vars($this), self::$tableName)) == TRUE))) {
            
            return mysqli_insert_id($this->getConnection());
            
        } else {
            return FALSE;
        }
    }
        /**
     * If the desired todo's description isn't exist and not problems with the query, then save it 
     * @return last inserted Id on sucess and FALST on faliure
     */
    function remove() {

        if (($this->check(self::$tableName, "WHERE Id = $this->Id", 'EXIST'))
            && ($this->DatabaseDelete(self::$tableName, "WHERE Id = $this->Id"))) {
            return TRUE;
            
        } else {
            return FALSE;
        }
    }

    function update() {
        if (!($this->check(self::$tableName, "WHERE Description = '$this->Description'", 'EXIST'))
            || !($this->DatabaseUpdate(array("isDone" => $this->isDone), self::$tableName, "WHERE Id = $this->Id"))) {
            return FALSE;
        }
    }
}

?>