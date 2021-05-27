<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTODiscussion.php");

class DAODiscussion extends DAO {
    public function __construct() {
        parent::__construct();
    }

    public function getDiscussion($id) {
        $query = <<<EOS
            SELECT *
            FROM discussion
            WHERE id = $id
EOS;
        $row = $this->query($query)->fetch_assoc();
        return new DTODiscussion($row["name"], $row["_user"], $row["lastTime"], $row["type"], $row["id"]);
    }

    public function getRecentDiscussions($first, $last) {
        $query = "
            SELECT *
            FROM discussion
            WHERE type = 0
            ORDER BY lastTime DESC, id DESC
            LIMIT " . ($last - $first + 1) . " OFFSET " . ($first - 1);
        $result = $this->query($query);
        $discussions = array();
        while ($row = $result->fetch_assoc()) {
            $discussions[] = new DTODiscussion($row["name"], $row["_user"], $row["lastTime"], $row["type"], $row["id"]);
        }

        return $discussions;
    }

    public function getTopDiscussions($first, $last) {
        $query = "
            SELECT *
            FROM discussion
            WHERE type = 0
            ORDER BY (
                SELECT COUNT(*)
                FROM message
                WHERE message.discussion = discussion.id
                ) DESC,
                id DESC
            LIMIT " . ($last - $first + 1) . " OFFSET " . ($first - 1);
        $result = $this->query($query);
        $discussions = array();
        while ($row = $result->fetch_assoc()) {
            $discussions[] = new DTODiscussion($row["name"], $row["_user"], $row["lastTime"], $row["type"], $row["id"]);
        }

        return $discussions;
    }

    public function getNumberOfDiscussions($type = null) {
        $query = <<<EOS
            SELECT COUNT(*) AS numberOfDiscussions
            FROM discussion
EOS;
        if ($type !== null) {
            $query .= " WHERE type = $type";
        }
        return $this->query($query)->fetch_assoc()["numberOfDiscussions"];
    }

    public function insertDiscussion(&$discussion) {
        $query = <<<EOS
            INSERT INTO discussion (name, _user, lastTime, type)
            VALUES ("{$discussion->getName()}", "{$discussion->getUser()}", "{$discussion->getLastTime()}", "{$discussion->getType()}")
EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        $discussion->setId($this->getNumberOfDiscussions());
    }

    public function updateDiscussion($id, $mod) {
        $query = <<<EOS
            UPDATE discussion
            SET name="{$mod->getName()}", _user="{$mod->getUser()}", lastTime="{$mod->getLastTime()}", type="{$mod->getType()}"
            WHERE id = $id
EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }
}
?>