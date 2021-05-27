<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTODiscussion.php");

class DAOMessage extends DAO {
    public function __construct() {
        parent::__construct();
    }

    public function getMessage($id, $discussion) {
        $query = <<<EOS
            SELECT *
            FROM message
            WHERE id = $id AND discussion = $discussion
        EOS;
        $row = $this->query($query)->fetch_assoc();
        return new DTOMessage($row["discussion"], $row["responding"], $row["_user"], $row["content"], $row["id"]);
    }

    public function getMessages($discussion, $first, $last) {
        $query = "
            SELECT *
            FROM message
            WHERE discussion = " . $discussion . "
            ORDER BY id ASC
            LIMIT " . ($last - $first + 1) . " OFFSET " . ($first - 1);
        $result = $this->query($query);
        $messages = array();
        while ($row = $result->fetch_assoc()) {
            $messages[] = new DTOMessage($row["discussion"], $row["responding"], $row["_user"], $row["content"], $row["id"]);
        }

        return $messages;
    }

    public function getNumberOfMessages($discussion) {
        $query = <<<EOS
            SELECT COUNT(*) AS numberOfMessages
            FROM message
            WHERE discussion = $discussion
        EOS;
        return $this->query($query)->fetch_assoc()["numberOfMessages"];
    }

    public function insertMessage(&$message) {
        $id = $this->getNumberOfMessages($message->getDiscussion()) + 1;
        $query = <<<EOS
            INSERT INTO message
            VALUES ("$id", "{$message->getDiscussion()}", "{$message->getResponding()}", "{$message->getUser()}", "{$message->getContent()}")
        EOS;
        $this->mysqli->query($query)
            or die($this->mysqli->error . " in the line " . (__LINE__ - 1));
        $message->setId($id);
    }
}
