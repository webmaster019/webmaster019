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
 *Root avec Controller classe
 * @example Routeur::get("/controller",$control->index());
 * @params sting root
 * @params function funtion
 */
$control=new UserControl();
Routeur::get("/controller",$control->index());
?>
