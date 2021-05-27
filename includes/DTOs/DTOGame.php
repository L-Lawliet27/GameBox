<?php

class DTOGame {
    private $id;
    private $name;
    private $price;
    private $user;
    private $description;
    private $releaseDate;
    private $genre;
    private $physical;
    private $digital;
    private $visits;
    private $link;

    public function __construct($name, $price, $user, $description, $releaseDate, $genre, $physical, $digital, $visits, $link, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->user = $user;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
        $this->genre = $genre;
        $this->physical = $physical;
        $this->digital = $digital;
        $this->visits = $visits;
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

    public function getDescription() {
        return $this->description;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getPhysical() {
        return $this->physical;
    }

    public function getDigital() {
        return $this->digital;
    }

    public function getVisits() {
        return $this->visits;
    }

    public function getLink() {
        return $this->link;
    }
}
