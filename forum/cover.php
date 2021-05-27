<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOMessage.php");
require_once(PROJECT_ROOT . "/includes/forms/CreateDiscussionForm.php");

function getDiscussionEntryHTML($discussion) {
    $daoMessage = new DAOMessage();
    $numberOfMessages = $daoMessage->getNumberOfMessages($discussion->getId());
    return <<<EOS
        <a href="/GameBox/forum/discussion.php?id={$discussion->getId()}&page=1">
            <h4>{$discussion->getName()}</h4>
        </a>
        <span>Author: {$discussion->getUser()}</span>
        <span class="rightSpan">Messages: {$numberOfMessages}</span>
EOS;
}

$daoDiscussion = new DAODiscussion();
$daoMessage = new DAOMessage();

// Atributos de la plantilla
$title = "Forum";
$sectionName = "entries";
$entriesPerPage = 5;
$leftPanelName = "Top discussions";
$rightPanelName = "Recent discussions";
$formPanelName = "Create a discussion";
$totalEntries = $daoDiscussion->getNumberOfDiscussions(0);
$leftPanelEntriesHTML = array();
$rightPanelEntriesHTML = array();
$formHTML = (new CreateDiscussionForm())->gestiona();
$navigatorAction = "/GameBox/forum/cover.php";

// Discusiones mostradas en el panel de top discusiones
$firstDiscussion = ($_GET["left"] - 1) * $entriesPerPage + 1;
$lastDiscussion = $firstDiscussion + $entriesPerPage - 1;
$discussions = $daoDiscussion->getTopDiscussions($firstDiscussion, $lastDiscussion);
foreach ($discussions as $discussion) {
    $leftPanelEntriesHTML[] = getDiscussionEntryHTML($discussion);
}

// Discusiones mostradas en el panel de discusiones recientes
$firstDiscussion = ($_GET["right"] - 1) * $entriesPerPage + 1;
$lastDiscussion = $firstDiscussion + $entriesPerPage - 1;
$discussions = $daoDiscussion->getRecentDiscussions($firstDiscussion, $lastDiscussion);
foreach ($discussions as $discussion) {
    $rightPanelEntriesHTML[] = getDiscussionEntryHTML($discussion);
}

require_once(PROJECT_ROOT . "/includes/templates/entriesListTemplate.php");

?>