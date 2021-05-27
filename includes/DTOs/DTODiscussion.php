<?php

class DTODiscussion {
    private $id;
    private $name;
    private $user;
    private $lastTime;
    private $type;

    public function __construct($name, $user, $lastTime, $type, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->user = $user;
        $this->lastTime = $lastTime;
        $this->type = $type;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUser() {
        return $this->user;
    }

    public function getLastTime() {
        return $this->lastTime;
    }

    public function getType() {
        return $this->type;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setLastTime($lastTime) {
        $this->lastTime = $lastTime;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
