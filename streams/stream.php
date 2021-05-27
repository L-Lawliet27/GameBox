<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOStream.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOStream.php");
require_once(PROJECT_ROOT . "/includes/templates/discussionTemplate.php");

$daoStream = new DAOStream();
$stream = $daoStream->getStream($_GET["id"]);
$title = $stream->getName();
$sectionName = "discussion";
$messagesPerPage = 5;
$action = "stream.php?id=" . $_GET["id"];
$content = "";

// Título
$content .= <<<EOS
    <h2>{$stream->getName()}</h2>
    <br>
EOS;

// Vídeo
if ($stream->getPlatform() == 0) { // Youtube
    $content .= <<<EOS
        <iframe class="video"
            width="560"
            height="315"
            src="https://www.youtube.com/embed/{$stream->getLink()}"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen="true">
        </iframe>
    EOS;
} else if ($stream->getPlatform() == 1) { // Facebook
    $content .= <<<EOS
        <iframe class="video"
            src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F{$stream->getLink()}%2F&width=500&show_text=false&height=280&appId"
            width="560"
            height="315"
            scrolling="no" frameborder="0"
            allowfullscreen="true"
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
            allowFullScreen="true">
        </iframe>
    EOS;
} else { // Twitch
    $content .= <<<EOS
        <iframe class="video"
            src="https://player.twitch.tv/?channel={$stream->getLink()}&parent=localhost"
            width="560"
            height="315"
            allowfullscreen="true">
        </iframe>
    EOS;
}

// Comentarios
$content .= getDiscussionHTML($stream->getDiscussion(), $messagesPerPage, $action);

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
