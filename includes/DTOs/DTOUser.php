<?php

class DTOUser {
    private $id;
    private $name;
    private $hashedPassword;
    private $createdAt;

    public function __construct($name, $hashedPassword, $rol, $createdAt = null, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->hashedPassword = $hashedPassword;
        $this->rol = $rol;
        $this->created_at = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setHashedPassword($hashedPassword) {
        $this->hashedPassword = $hashedPassword;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
}
