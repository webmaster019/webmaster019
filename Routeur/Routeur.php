<?php

/**
 *
 */
class Routeur
{
    private static $_routes=[];
    private static $_matches;
    public static function get($route,$controller)
    {
      $route=trim($route,'/');
      self::$_routes[$route]=$controller;

    }
    public static function run()
    {
      foreach (self::$_routes as $route => $controller) {
        if (self::match($_GET['url'],$route)) {
          return self::call($controller);
        }
      }
      return self::erreur();
    }
    public static function match($url,$route)
    {
      $path=preg_replace('#{[a-z]+}#','([a-z0-9\-]+)\/?',$route);
      if(!preg_match("#^$path$#",$url,$matches)){
        return false;
      }
      array_shift($matches);
      self::$_matches=$matches;
      return true;
    }
    public static function call($controller)
    {
/*        $params = explode('@', $controller);
        $controller = $params[0];
        require("Controllers/" . $controller . ".php");
        $controller = new $controller();
        return call_user_func_array([$controller, $params[1]], self::$_matches);*/
        return call_user_func_array($controller, self::$_matches);

    }
    public static  function erreur()
    {
    require 'Views/404.php';
    }

}

?>
