<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOStream.php");

class DAOStream extends DAO {
    public function __construct() {
        parent::__construct();
    }

    public function getStream($id) {
        $query = <<<EOS
            SELECT *
            FROM stream
            WHERE id = $id AND active = 1
EOS;
        $row = $this->query($query)->fetch_assoc();
        return new DTOStream($row["name"], $row["platform"], $row["link"], $row["_user"], $row["discussion"], $row["id"]);
    }

    public function getTopStreams($first, $last) {
        $query = "
            SELECT *
            FROM stream
            WHERE active = 1 
            ORDER BY (
                SELECT COUNT(*)
                FROM message
                WHERE message.discussion = stream.discussion
                ) DESC,
                id DESC
            LIMIT " . ($last - $first + 1) . " OFFSET " . ($first - 1);
        $result = $this->query($query);
        $streams = array();
        while ($row = $result->fetch_assoc()) {
            $streams[] = new DTOStream($row["name"], $row["platform"], $row["link"], $row["_user"], $row["discussion"], $row["id"]);
        }

        return $streams;
    }

    public function getRecentStreams($first, $last) {
        $query = "
            SELECT *
            FROM stream WHERE active = 1
            ORDER BY (
                SELECT lastTime
                FROM discussion
                WHERE discussion.id = stream.discussion
            ) DESC,
            id DESC
            LIMIT " . ($last - $first + 1) . " OFFSET " . ($first - 1);
        $result = $this->query($query);
        $streams = array();
        while ($row = $result->fetch_assoc()) {
            $streams[] = new DTOStream($row["name"], $row["platform"], $row["link"], $row["_user"], $row["discussion"], $row["id"]);
        }

        return $streams;
    }

    public function getNumberOfStreams() {
        $query = <<<EOS
            SELECT COUNT(*) AS numberOfStreams
            FROM stream WHERE active = 1
        EOS;
        return $this->query($query)->fetch_assoc()["numberOfStreams"];
    }

    public function insertStream(&$stream) {
        $query = <<<EOS
            INSERT INTO stream (name, platform, link, _user, discussion, active)
            VALUES (
                "{$stream->getName()}",
                "{$stream->getPlatform()}",
                "{$stream->getLink()}",
                "{$stream->getUser()}",
                "{$stream->getDiscussion()}",
                "1"
            )
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        $stream->setId($this->mysqli->insert_id);
    }

    public function updateStream($id, $mod) {
        $query = <<<EOS
            UPDATE stream
            SET
                name="{$mod->getName()}",
                platform="{$mod->getPlatform()}",
                link="{$mod->getLink()}",
                _user="{$mod->getUser()},
                discussion="{$mod->getDiscussion()}"
            WHERE id = " . $id AND active = 1
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
    }

    /**
     * Inactivate a STREAM, don't delete from DB 
     *
     * @param  [id] $id
     * @return [url] query
    */

    public function inactivateStream($id) {
        $q = <<<EOS
            UPDATE stream SET active=0 WHERE id="$id"
EOS;
        $this->query($q);
    }
}
