<?php

class DTOProduct {
    private $id;
    private $name;
    private $price;
    private $user;
    private $type;
    private $description;
    private $link;

    public function __construct($name, $price, $user, $type, $description, $link, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->user = $user;
        $this->type = $type;
        $this->description = $description;
        $this->link = $link;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getUser() {
        return $this->user;
    }

    public function getType() {
        return $this->type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLink() {
        return $this->link;
    }
}
