<?php
require_once(__DIR__ . "/includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOStream.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOGame.php");


/**
 * Panel con una lista numerada de entradas
 */
function getPanelHTML($title, $entriesHTML) {
    $html = "";
    for ($i = 0; $i < 5; $i++) {
        if ($i < count($entriesHTML)) {
            $html .= <<<EOS
                <li>{$entriesHTML[$i]}</li>
            EOS;
        } else {
            $html .= <<<EOS
                <li></li>
EOS;
        }
    }

    return <<<EOS
        <section class="panel">
            <h1>$title</h1>
            <ol>
                $html
            </ol>
        </section>
EOS;
}

$title = "GameBox";
$sectionName = "index";

$topGamesEntriesHTML = array();
$daoGames = new DAOGame();
$topGames = $daoGames->getTopGames(1,5);
foreach($topGames as $game){
    $topGamesEntriesHTML[] = <<<EOS
        <a href="/GameBox/store/game/gameView.php?id={$game->getId()}">{$game->getName()}</a>
EOS;
}

$topGamesPanelHTML = getPanelHTML("Top Games", $topGamesEntriesHTML);

$topDiscussionsEntriesHTML = array();
$daoDiscussion = new DAODiscussion();
$topDiscussions = $daoDiscussion->getTopDiscussions(1, 5);
foreach ($topDiscussions as $discussion) {
    $topDiscussionsEntriesHTML[] = <<<EOS
        <a href="/GameBox/forum/discussion.php?id={$discussion->getId()}&page=1">{$discussion->getName()}</a>
EOS;
}
$topDiscussionsPanelHTML = getPanelHTML("Top Discussions", $topDiscussionsEntriesHTML);

$topStreamsEntriesHTML = array();
$daoStream = new DAOStream();
$topStreams = $daoStream->getTopStreams(1, 5);
foreach ($topStreams as $stream) {
    $topStreamsEntriesHTML[] = <<<EOS
        <a href="/GameBox/streams/stream.php?id={$stream->getId()}&page=1">{$stream->getName()}</a>
EOS;
}
$topStreamsPanelHTML = getPanelHTML("Top Streams", $topStreamsEntriesHTML);

$content = <<<EOS
    $topGamesPanelHTML
    $topStreamsPanelHTML
    $topDiscussionsPanelHTML
EOS;

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
