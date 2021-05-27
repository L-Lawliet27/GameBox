<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOStream.php");
require_once(PROJECT_ROOT . "/includes/forms/StartStreamForm.php");

function getStreamEntryHTML($stream) {
    $platform = "";
    if ($stream->getPlatform() == 0) {
        $platform = "Youtube";
    } else if ($stream->getPlatform() == 1) {
        $platform = "Facebook";
    } else {
        $platform = "Twitch";
    }
    return <<<EOS
        <a href="/GameBox/streams/stream.php?id={$stream->getId()}&page=1">
            <h4>{$stream->getName()}</h4>
        </a>
        <span>Streamer: {$stream->getUser()}</span>
        <span class="rightSpan">Platform: {$platform}</span>
    EOS;
}

$daoStream = new DAOStream();

// Atributos de la plantilla
$title = "Streams";
$sectionName = "entries";
$entriesPerPage = 5;
$leftPanelName = "Top streams";
$rightPanelName = "Recent streams";
$formPanelName = "Start a stream";
$totalEntries = $daoStream->getNumberOfStreams();
$leftPanelEntriesHTML = array();
$rightPanelEntriesHTML = array();
$formHTML = (new StartStreamForm())->gestiona();
$navigatorAction = "/GameBox/streams/cover.php";

// Streams mostrados en el panel de top streams
$firstStream = ($_GET["left"] - 1) * $entriesPerPage + 1;
$lastStream = $firstStream + $entriesPerPage - 1;
$streams = $daoStream->getTopStreams($firstStream, $lastStream);
foreach ($streams as $stream) {
    $leftPanelEntriesHTML[] = getStreamEntryHTML($stream);
}

// Streams mostrados en el panel de streams recientes
$firstStream = ($_GET["right"] - 1) * $entriesPerPage + 1;
$lastStream = $firstStream + $entriesPerPage - 1;
$streams = $daoStream->getRecentStreams($firstStream, $lastStream);
foreach ($streams as $stream) {
    $rightPanelEntriesHTML[] = getStreamEntryHTML($stream);
}

require_once(PROJECT_ROOT . "/includes/templates/entriesListTemplate.php");
