<?php

/**
 *
 */
class Routeur
{

    private static $_routes=[];
    private static $_matches;

    /**
     * @param string $route
     * @param object $controller
     */
    public static function get(string $route,object $controller)
    {
      $route=trim($route,'/');
      self::$_routes[$route]=$controller;

    }

    /**
     * @return false|mixed|void
     */
    public static function run()
    {
      foreach (self::$_routes as $route => $controller) {
        if (self::match($_GET['url'],$route)) {
          return self::call($controller);
        }
      }
      return self::erreur();
    }

    /**
     * @param string $url
     * @param string $route
     * @return bool
     */
    public static function match(string $url,string $route)
    {
      $path=preg_replace('#{[a-z]+}#','([a-z0-9\-]+)\/?',$route);
      if(!preg_match("#^$path$#",$url,$matches)){
        return false;
      }
      array_shift($matches);
      self::$_matches=$matches;
      return true;
    }

    /**
     * @param object $controller
     * @return false|mixed
     */
    public static function call(object  $controller)
    {
        return call_user_func_array($controller, self::$_matches);

    }

    /**
     * @return view404
     */
    public static  function erreur()
    {
    require 'Views/404.php';
    }

}

?>
