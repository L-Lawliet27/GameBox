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

        $delete="";
        if(isset($_SESSION["rol"])){
            
            if($_SESSION["rol"] =='admin'){
                $delete='<a class="btnInactivate" href="javascript:void(0);" 
                        onclick="javascript:confirmAction('."'inactivateGame.php?id=".$game->getId()."'".')" title="Inactivate this Game?">
                        <i>X </i>
                    </a>';
            }


            $storeContent .= <<<EOS
                <figure class="item">
                    <figcaption>
                    {$delete}
                        <a class="infoItem" href="gameView.php?id={$game->getId()}">
                                <h2>{$game->getName()}</h2>
                        </a>
                    </figcaption>
                </figure>
EOS;
        }

    }
}

$storeContent .= "</section>";

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
?>