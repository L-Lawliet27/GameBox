<?php

class DTOMessage {
    private $id;
    private $discussion;
    private $responding;
    private $user;
    private $content;

    public function __construct($discussion, $responding, $user, $content, $id = null) {
        $this->id = $id;
        $this->discussion = $discussion;
        $this->responding = $responding;
        $this->user = $user;
        $this->content = $content;
    }

    public function getId() {
        return $this->id;
    }

    public function getDiscussion() {
        return $this->discussion;
    }

    public function getResponding() {
        return $this->responding;
    }

    public function getUser() {
        return $this->user;
    }

    public function getContent() {
        return $this->content;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDiscussion($discussion) {
        $this->discussion = $discussion;
    }

    public function setResponding($responding) {
        $this->respond = $responding;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setContent($content) {
        $this->content = $content;
    }
}
