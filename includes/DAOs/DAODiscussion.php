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
            WHERE id = $id AND active = 1
        EOS;
        $row = $this->query($query)->fetch_assoc();
        return new DTODiscussion($row["name"], $row["_user"], $row["lastTime"], $row["type"], $row["id"]);
    }

    public function getRecentDiscussions($first, $last) {
        $query = "
            SELECT *
            FROM discussion
            WHERE type = 0 AND active = 1
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
            WHERE type = 0  AND active = 1
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
            $query .= " WHERE type = $type AND active = 1";
        }
        return $this->query($query)->fetch_assoc()["numberOfDiscussions"];
    }

    public function insertDiscussion(&$discussion) {
        $query = <<<EOS
            INSERT INTO discussion (name, _user, lastTime, type, active)
            VALUES ("{$discussion->getName()}", "{$discussion->getUser()}", "{$discussion->getLastTime()}", "{$discussion->getType()}", "1")
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        $discussion->setId($this->mysqli->insert_id);
    }

    public function updateDiscussion($id, $mod) {
        $query = <<<EOS
            UPDATE discussion
            SET name="{$mod->getName()}", _user="{$mod->getUser()}", lastTime="{$mod->getLastTime()}", type="{$mod->getType()}"
            WHERE id = $id AND active = 1
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }

    /**
     * Inactivate a DISCUSSION, don't delete from DB 
     *
     * @param  [id] $id
     * @return [url] query
    */

    public function inactivateDiscussion($id) {
        $q = <<<EOS
            UPDATE discussion SET active=0 WHERE id="$id"
EOS;
        $this->query($q);
    }

}
