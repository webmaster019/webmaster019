
<?php
require( dirname( __FILE__ ) . '/Routeur/Routeur.php' );
require( 'App/Config/vendor/autoload.php' );
require ("Autoloader.php");
$overwriteENV = true;
$Loader = (new josegonzalez\Dotenv\Loader('App/Config/.env'))
    ->parse()
    ->toEnv($overwriteENV);
require(dirname(__FILE__) . '/routes.php');

Routeur::run();

?>
