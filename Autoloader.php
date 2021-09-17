<?php
function autoloadModel($className) {
    $filename =__DIR__.DIRECTORY_SEPARATOR.  "App/Model/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

function autoloadDatabase($className) {
    $filename =__DIR__.DIRECTORY_SEPARATOR. "App/Config/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

function autoloadContollers($className) {
    $filename =__DIR__.DIRECTORY_SEPARATOR. "Controllers/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadDatabase");
spl_autoload_register("autoloadContollers");

?>