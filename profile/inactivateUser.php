<?php

require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOUser.php");

$daoUser = new DAOUser();
//$user = $daoUser->getUser($_GET["id"]);

$daoUser->inactivateUser($_GET["id"]);

header("Location: profile.php");
exit();

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");