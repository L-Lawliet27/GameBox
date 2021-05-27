<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOGame.php");

$daoGame = new DAOGame();
$game = $daoGame->getById($_GET["id"]);

$daoGame->updateVisits($game->getId());

$buttons = "";
if ($game->getPhysical()) {
    $buttons .= "<button type=\"button\">Physical</button>";
}
if ($game->getDigital()) {
    $buttons .= "<button type=\"button\">Digital</button>";
}

$storeContent = <<<EOS
    <section id="itemsView">
        <h1 id="name">{$game->getName()}</h1>

        <h2 id="user">Developed by {$game->getUser()}</h2>

        <h3 id="description">{$game->getDescription()}</h3>

        <h2 id="price">{$game->getPrice()}</h2>

        <div id="buttons">
            $buttons
        </div>

        <h3 id="genre">{$game->getGenre()}</h3>

        <h3 id="releaseDate">{$game->getReleaseDate()}</h3>
    </section>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
?>