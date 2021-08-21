
<?php
require( dirname( __FILE__ ) . '/Routeur/Routeur.php' );
require 'App/src/JWT.php';
require 'App/src/ExpiredException.php';
require 'App/src/SignatureInvalidException.php';
require 'App/src/BeforeValidException.php';
require( 'App/Config/vendor/autoload.php' );
require( 'App/vendor/autoload.php' );
require ("App/Autoloader.php");

$overwriteENV = true;
$Loader = (new josegonzalez\Dotenv\Loader('App/Config/.env'))
    ->parse()
    ->toEnv($overwriteENV);
require(dirname(__FILE__) . '/routes.php');

?>
