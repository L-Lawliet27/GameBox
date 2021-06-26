<?php

require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOStream.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOStream.php");

$daoStream = new DAOStream();
$stream = $daoStream->getStream($_GET["id"]);

$daoStream->inactivateStream($stream->getId());

header("Location: cover.php?left=1&right=1");
exit();

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");