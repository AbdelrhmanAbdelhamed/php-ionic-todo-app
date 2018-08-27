<?php

function load_files($dir) {
$dir_open = opendir($dir);
$files = array();
while(false !== ($filename = readdir($dir_open))){
    if($filename != "." && $filename != ".."){
        array_push($files, $filename);
    }
}
return $files;

closedir($dir_open);
}
?>