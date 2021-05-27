<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOGame.php");

class DAOGame extends DAO {

    public function __construct() {
        parent::__construct();
    }

    public function getAllGames() {
        $q = <<<EOS
            SELECT *
            FROM game
EOS;
        $r = $this->query($q);
        $games = array();

        while ($n = $r->fetch_assoc()) {

            $games[] = $this->createGame($n);
        }
        $r->free();
        return $games;
    }


    public function getById($id) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE id="$id"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();

            $game = $this->createGame($u);
            $r->free();
            return $game;
        }
        return false;
    }


    public function getSingleByName($name) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE name="$name"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();
            $game = $this->createGame($u);
            $r->free();

            return $game;
        }
        return false;
    }


    public function getByName($name) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE name="$name"
        EOS;
        $r = $this->query($q);
        $gamesWithName = array();

        while ($n = $r->fetch_assoc()) {

            $gamesWithName[] = $this->createGame($n);
        }
        $r->free();

        return $gamesWithName;
    }

    public function updateVisits($id) {
        $q = <<<EOS
            UPDATE game
            SET visits = visits + 1
            WHERE id="$id"
        EOS;
        $this->query($q);
    }


    public function getByUser($_user) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE _user="$_user"
        EOS;
        $r = $this->query($q);
        $gamesByUser = array();

        while ($n = $r->fetch_assoc()) {
            $gamesByUser[] = $this->createGame($n);
        }
        $r->free();

        return $gamesByUser;
    }


    public function getByDate($date) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE releaseDate="$date"
        EOS;
        $r = $this->query($q);
        $gamesReleased = array();

        while ($n = $r->fetch_assoc()) {
            $gamesReleased[] = $this->createGame($n);
        }
        $r->free();
        return $gamesReleased;
    }

    public function getRecent() {
        $q = <<<EOS
            SELECT *
            FROM game
            ORDER BY releaseDate DESC
        EOS;
        $r = $this->query($q);

        $recentGames = array();

        while ($n = $r->fetch_assoc()) {

            $recentGames[] = $this->createGame($n);
        }
        $r->free();
        return $recentGames;
    }

    public function getPopular() {
        $q = <<<EOS
            SELECT *
            FROM game
            ORDER BY visits DESC
        EOS;
        $r = $this->query($q);

        $recentGames = array();

        while ($n = $r->fetch_assoc()) {
            $recentGames[] = $this->createGame($n);
        }
        $r->free();
        return $recentGames;
    }


    public function getByGenre($genre) {
        $q = <<<EOS
            SELECT *
            FROM game
            WHERE genre="$genre"
        EOS;
        $r = $this->query($q);
        $gameGenre = array();

        while ($n = $r->fetch_assoc()) {
            $gameGenre[] = $this->createGame($n);
        }
        $r->free();
        return $gameGenre;
    }


    public function addGame($game) {
        $q = <<<EOS
            INSERT INTO game (name, price, _user, description, releaseDate, genre, physical, digital, visits, link)
            VALUES (
                "{$game->getName()}",
                "{$game->getPrice()}",
                "{$game->getUser()}",
                "{$game->getDescription()}",
                "{$game->getReleaseDate()}",
                "{$game->getGenre()}",
                "{$game->getPhysical()}",
                "{$game->getDigital()}",
                "{$game->getVisits()}",
                "{$game->getLink()}"
            )
        EOS;

        $this->query($q);
    }

    private function createGame($n) {
        return new DTOGame(
            $n["name"],
            $n["price"],
            $n["_user"],
            $n["description"],
            $n["releaseDate"],
            $n["genre"],
            $n["physical"],
            $n["digital"],
            $n["visits"],
            $n["link"],
            $n["id"]
        );
    }
}
?>