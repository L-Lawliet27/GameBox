<?php
require_once("Database.php");

define("PROJECT_ROOT", __DIR__ . "/..");

session_start();

ini_set("default_charset", "UTF-8");
setLocale(LC_ALL, "es_ES.UTF.8");

date_default_timezone_set("Europe/Madrid");

Database::init(array("hostname" => "localhost", "username" => "root", "password" => "", "database" => "gamebox"));
?>