<?php

require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOGame.php");

$daoGame = new DAOGame();
$game = $daoGame->getById($_GET["id"]);

$daoGame->inactivateGame($game->getId());

header("Location: cover.php");
exit();

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
