<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOUser.php");

class DAOUser extends DAO {
    public function __construct() {
        parent::__construct();
    }

    public function getUser($name) {
        $query = <<<EOS
            SELECT *
            FROM _user
            WHERE name = "$name"
        EOS;
        $row = $this->query($query)->fetch_assoc();
        return empty($row) ? null : new DTOUser($row["name"], $row["password"], $row["rol"], $row["created_at"], $row["id"]);
    }

    public function insertUser(&$user) {
        $query = <<<EOS
            INSERT INTO _user (name, password, rol)
            VALUES ("{$user->getName()}", "{$user->getHashedPassword()}", "{$user->getRol()}")
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        $user->setId($this->getNumberOfUsers());
    }

    public function updateUser($id, $mod) {
        $query = <<<EOS
            UPDATE _user
            SET name="{$mod->getName()}", password="{$mod->getHashedPassword()}", rol="{$mod->getRol()}"
            WHERE id = $id
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }

    public function getNumberOfUsers() {
        $query = <<<EOS
            SELECT COUNT(*) AS numberOfUsers
            FROM _user
        EOS;
        return $this->query($query)->fetch_assoc()["numberOfUsers"];
    }
}
