<?php
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOMessage.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTODiscussion.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOMessage.php");
require_once(PROJECT_ROOT . "/includes/forms/PostMessageForm.php");

function getMessageHTML($message, $type, $action) {
    $page = $_GET["page"];

    $htmlResponded = null;
    if ($type == "normal" && $message->getResponding() > 0) {
        // El mensaje responde a otro mensaje
        $daoMessage = new DAOMessage();
        $responded = $daoMessage->getMessage($message->getResponding(), $message->getDiscussion());
        $htmlResponded = <<<EOS
            <br>
            <article class="message responded">
                <h4>{$responded->getUser()}</h4>
                <p>{$responded->getContent()}</p>
            </article>
        EOS;
    }

    // Enlace para responder el mensaje
    $respondLink = null;
    if ($type == "normal") {
        if (isset($_SESSION["loggedin"])) {
            $respondLink = <<<EOS
                <a href="$action&page=$page&responding={$message->getId()}">Respond</a><br><br>
            EOS;
        } else {
            $respondLink = <<<EOS
                <a href="/GameBox/login/login.php">Respond</a><br><br>
            EOS;
        }
    }

    return <<<EOS
        <article class="message $type">
            $htmlResponded
            <h4>{$message->getUser()}</h4>
            <p>{$message->getContent()}</p>
            $respondLink
        </article>
    EOS;
}

function getNavigatorHTML($id, $messagesPerPage, $action) {
    $page = $_GET["page"];
    $daoMessage = new DAOMessage();
    $nMessages = $daoMessage->getNumberOfMessages($id);
    $nPages = $nMessages == 0 ? 1 : intval(ceil($daoMessage->getNumberOfMessages($id) / $messagesPerPage));

    $previousPage = $page == 1 ? 1 : $page - 1;
    $nextPage = $page == $nPages ? $nPages : $page + 1;
    $htmlNavigator = <<<EOS
        <a href="$action&page=$previousPage">Previous</a>
    EOS;
    for ($i = 1; $i <= $nPages; $i++) {
        $htmlNavigator .= <<<EOS
            <a href="$action&page=$i">$i</a>
        EOS;
    }
    $htmlNavigator .= <<<EOS
        <a href="$action&page=$nextPage">Next</a>
    EOS;

    return $htmlNavigator;
}

function getDiscussionHTML($id, $messagesPerPage, $action) {
    $page = $_GET["page"];
    $responding = isset($_GET["responding"]) ? $_GET["responding"] : null;

    $daoDiscussion = new DAODiscussion();
    $daoMessage = new DAOMessage();
    $discussion = $daoDiscussion->getDiscussion($id);
    $firstMessage = ($page - 1) * $messagesPerPage + 1;
    $lastMessage = $firstMessage + $messagesPerPage - 1;
    $messages = $daoMessage->getMessages($id, $firstMessage, $lastMessage);

    $discussionHTML = "<section type=\"discussion\">";

    // Título
    $discussionHTML .= <<<EOS
        <h2>{$discussion->getName()}</h2>
    EOS;

    // Navegador de páginas
    $discussionHTML .= getNavigatorHTML($id, $messagesPerPage, $action);

    // Imprimir botón de publicar un mensaje
    if (isset($_SESSION["loggedin"])) {
        $discussionHTML .= <<<EOS
            <br><br><a href="$action&page=$page&responding=0">Post a message</a><br><br>
        EOS;
    } else {
        $discussionHTML .= <<<EOS
            <br><br><a href="/GameBox/login/login.php">Post a message</a><br><br>
        EOS;
    }

    if ($responding != null) {
        // Panel para publicar un mensaje
        // $responding = 0 si se va a publicar un mensaje que no responda a ningún otro
        // $responding > 0 si se va a responder a un mensaje (se corresponderá con el identificador del mensaje al que responde)

        $htmlResponded = null;
        if ($responding > "0") {
            // Se va a responder a un mensaje ($responding se corresponderá con el identificador del mensaje al que responde)

            $respondedMessage = $messages[($responding - 1) % $messagesPerPage];
            // Obtener HTML para el mensaje que se está respondiendo
            $htmlResponded = getMessageHTML($respondedMessage, "responded", $action) . "<br>";
        }

        // Imprimir el panel de publicación del mensaje
        $formPanelHTML = (new PostMessageForm($action . "&page={$_GET["page"]}", $id))->gestiona();
        $discussionHTML .= <<<EOS
        <article id="respondingPanel">
            <br>
            $htmlResponded
            $formPanelHTML
        </article>
        <br>
    EOS;
    }

    // Imprimir mensajes
    foreach ($messages as $message) {
        $discussionHTML .= getMessageHTML($message, "normal", $action) . "<br>";
    }

    // Imprimir navegador de páginas
    $discussionHTML .= getNavigatorHTML($id, $messagesPerPage, $action);

    $discussionHTML .= "</section>";

    return $discussionHTML;
}
