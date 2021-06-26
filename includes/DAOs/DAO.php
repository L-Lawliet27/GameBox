<?php
require_once(__DIR__ . "/../config.php");

abstract class DAO {
    protected $mysqli;

    protected function __construct() {
        $this->mysqli = Database::connection();
    }

    protected function query($query) {
        $result = $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        return $result;
    }
}
