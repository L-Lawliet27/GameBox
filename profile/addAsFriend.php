<?php

require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOUser.php");

$daoUser = new DAOUser();

$daoUser->addAsFriend($_GET["id"], $_GET["id_friend"]);

header("Location: profile.php");
exit();

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");