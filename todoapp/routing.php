<?php

function getRoutingData() {
    
    /**********************Replace the unwanted stuff from the URL and split it into (controller, function, parameters)*****************/
            /*****************************http://domain/app/controller/function/parameters******************************/
    
    $url = str_replace("/todoapp/", "", $_SERVER['REQUEST_URI']);
    $splittedURL = explode("/", $url);
    
    $controller = array_shift($splittedURL);
    $function = array_shift($splittedURL);
    $data = json_decode(file_get_contents("php://input"), true);
    
    /******************************Mege the post data if any with the current parameters list if any**********************************/
    if ($data) {
        $parameters = array_merge($splittedURL, $data);
    } else {
        $parameters = $splittedURL;
    }
    /*********************************************************************************************************************************/
    
    return array('CONTROLLER' => $controller, 'FUNCTION' => $function, 'PARAMETERS' => $parameters);
}

?>