<?php

require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOUser.php");

/*echo $_GET["id"];
echo '<br/>';
echo $_GET["id_friend"];
die();*/

$daoUser = new DAOUser();

$daoUser->removeAsFriend($_GET["id"], $_GET["id_friend"]);

header("Location: profile.php");
exit();

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");