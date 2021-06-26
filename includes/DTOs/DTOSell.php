<?php

class DTOSell {
    private $id;
    private $category;
    private $name;
    private $price;
    
    public function __construct($category, $name, $price, $id = null) {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

   
   
}
