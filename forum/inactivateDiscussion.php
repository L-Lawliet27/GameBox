<?php

require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");

$daoDiscussion = new DAODiscussion();
$discussion = $daoDiscussion->getDiscussion($_GET["id"]);

$daoDiscussion->inactivateDiscussion($discussion->getId());

header("Location: cover.php?left=1&right=1");
exit();

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");