<?php

class DTOStream {
    private $id;
    private $name;
    private $platform;
    private $link;
    private $user;
    private $discussion;

    public function __construct($name, $platform, $link, $user, $discussion, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->platform = $platform;
        $this->link = $link;
        $this->user = $user;
        $this->discussion = $discussion;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPlatform() {
        return $this->platform;
    }

    public function getLink() {
        return $this->link;
    }

    public function getUser() {
        return $this->user;
    }

    public function getDiscussion() {
        return $this->discussion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPlatform($platform) {
        $this->platform = $platform;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setDiscussion($discussion) {
        $this->discussion = $discussion;
    }
}
