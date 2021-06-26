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

    public function getAllUsers() {
        $query = "
            SELECT *
            FROM _user WHERE active = 1";
        $result = $this->query($query);
        $user = array();
        while ($row = $result->fetch_assoc()) {
            $rol=$row["name"]."|". $row["rol"]."|". $row["created_at"]."|".$row['id'];
            $user[] = new DTOUser($row["name"],null, $rol, $row["created_at"],$row['id']);
        }
        return $user;
    }
    public function GetAllfriendYes() {
        $query = "
            SELECT _user.*
            FROM _user 
            join friends on friends.id_user= _user.id
            WHERE _user.active = 1 and friends.id_user=".$_SESSION['id'];
        $result = $this->query($query);
        $user = array();
        while ($row = $result->fetch_assoc()) {
            $rol=$row["name"]."|". $row["rol"]."|". $row["created_at"]."|".$row['id'];
            $user[] = new DTOUser($row["name"],null, $rol, $row["created_at"],$row['id']);
        }
        return $user;
    }
    public function GetAllfriendNot() {
        $query = "
            SELECT _user.*
            FROM _user 
            WHERE _user.active = 1  and id not in (select id_user_friend from friends where id_user=".$_SESSION['id'].")";
        $result = $this->query($query);
        $user = array();
        while ($row = $result->fetch_assoc()) {
            $rol=$row["name"]."|". $row["rol"]."|". $row["created_at"]."|".$row['id'];
            $user[] = new DTOUser($row["name"],null, $rol, $row["created_at"],$row['id']);
        }
        return $user;
    }

    public function inactivateUser($id) {
    
        $q = <<<EOS
            UPDATE _user SET active=0 WHERE id="$id"
EOS;
        $this->query($q);
    }

    public function addAsFriend(&$user, $idFriend) {
        $query = <<<EOS
            INSERT INTO friends (id_user, id_user_friend)
            VALUES ("{$_SESSION["id"]}", "{$idFriend}")
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }

    public function removeAsFriend(&$user, $idFriend) {
        $query = <<<EOS
            DELETE FROM friends
            WHERE id_user = "{$_SESSION["id"]}" AND id_user_friend = "{$idFriend}"
EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }
}
