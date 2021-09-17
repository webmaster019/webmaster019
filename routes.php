<?php

/**
*Root sans Controller classe
 * @example Routeur::get("/",function (){require "Views/index.php";});
 * @params sting root
 * @params function funtion
 */

Routeur::get("/",function (){
    require "Views/index.php";
});
/**
*Root sans Controller classe avec parametre
 * @example Routeur::get("/",function (){require "Views/index.php";});
 * @params sting root
 * @params function
 */
Routeur::get("/user/{id}",function ($id){
    require "Views/param.php";
});
?>
