<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/templates/discussionTemplate.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");

$daoDiscussion = new DAODiscussion();
$title = $daoDiscussion->getDiscussion($_GET["id"])->getName();
$sectionName = "discussion";
$messagesPerPage = 10;
$action = "/GameBox/forum/discussion.php?id=" . $_GET["id"];
$content = getDiscussionHTML($_GET["id"], $messagesPerPage, $action);

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
?>