<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOGame.php");

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

$storeContent = "<section id=\"entries\">";

$daoGame = new DAOGame();
$games = null;

if (isset($filter)) {
    switch ($filter) {
        case "genre":
            $games = $daoGame->getByGenre($type);
            break;

        case "recent":
            $games = $daoGame->getRecent();
            break;

        case "popular":
            $games = $daoGame->getPopular();
            break;
    }
} else {
    $games = $daoGame->getAllGames();
}

if (!empty($games)) {
    foreach ($games as $game) {
        $storeContent .= <<<EOS
            <a href="gameView.php?id={$game->getId()}">
                <i>
                    <h2>{$game->getName()}</h2>
                </i>
            </a>
EOS;
    }
}

$storeContent .= "</section>";

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
?>