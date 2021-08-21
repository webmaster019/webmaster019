<?php
Routeur::get("/{id}",function ($id){
    require "Views/index.php";
});

Routeur::run();
?>
