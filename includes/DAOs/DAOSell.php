<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOSell.php");

class DAOSell extends DAO {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $q = <<<EOS
            SELECT *
            FROM sell
        EOS;
        $r = $this->query($q);
        $sell = array();

        while ($n = $r->fetch_assoc()) {
            $sell[] = $this->createSell($n);
        }
        $r->free();
        return $sell;
    }

    public function getById($id) {
        $q = <<<EOS
            SELECT *
            FROM sell
            WHERE id="$id"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();
            $sell = $this->createSell($u);
            $r->free();
            return $sell;
        }
        $r->free();
        return false;
    }

    public function getByCategory($category) {
        $q = <<<EOS
            SELECT *
            FROM sell
            WHERE category="$category"
        EOS;
        $r = $this->query($q);
        $sells = array();

        while ($n = $r->fetch_assoc()) {
            $sells[] = $this->createSell($n);
        }
        $r->free();
        return $sells;
    }

    public function getByName($name) {
        $q = <<<EOS
            SELECT *
            FROM sell
            WHERE name="$name"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();
            $sell = $this->createSell($u);
            $r->free();

            return $sell;
        }
        return false;
    }

    private function createSell($n) {
        return new DTOSell($n["category"], $n["name"], $n["price"], $n["id"]);
    }
}
