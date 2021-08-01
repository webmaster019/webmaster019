<?php
function autoloadModel($className) {
    $filename =__DIR__.DIRECTORY_SEPARATOR.  "Model/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

function autoloadDatabase($className) {
    $filename =__DIR__.DIRECTORY_SEPARATOR. "Config/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadDatabase");

?>