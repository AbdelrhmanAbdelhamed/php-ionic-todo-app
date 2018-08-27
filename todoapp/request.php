<?php

/********Load the received data (Controller, function and parameters)*********/
require_once 'routing.php';
$routingData = getRoutingData();
/*****************************************************************************/

$controller = "$routingData[CONTROLLER]-controller.php";

/**********Check if the received controller exist in the controllers folder or not then require it *********/
if (is_file("controllers/$controller") && is_readable("controllers/$controller")) {

    require_once "controllers/$controller";

    $controller = "$routingData[CONTROLLER]Controller";
    
/**********Load all the received controller's methods into an array in order to compare it with the received one***********/
    $f = new ReflectionClass($controller);
    $methods = array();
    foreach ($f->getMethods() as $m) {
        $methods[] = $m->name;
    }
/*************************************************************************************************************/

    $action = $routingData['FUNCTION'];
    
/***********Check if the received function located in the controller then call it*********/
    if (in_array($action, $methods)) {
        
        $function = "$controller::$action";
        $data = $routingData['PARAMETERS'];
        $function($data);
        
    } else {
        die('Access denied! No such a function');
    }
 /******************************************************************************/
 
} else {
    die('Access denied! No such a controller');
}
/****************************************************************************************************/

?>