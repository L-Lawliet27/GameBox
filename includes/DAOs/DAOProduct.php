<?php

require_once("DAO.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOProduct.php");

class DAOProduct extends DAO {

    public function __construct() {
        parent::__construct();
    }

    public function getAllProducts() {
        $q = <<<EOS
            SELECT *
            FROM product
        EOS;
        $r = $this->query($q);
        $products = array();

        while ($n = $r->fetch_assoc()) {
            $products[] = $this->createProduct($n);
        }
        $r->free();
        return $products;
    }


    public function getById($id) {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE id="$id"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();
            $product = $this->createProduct($u);
            $r->free();
            return $product;
        }
        $r->free();
        return false;
    }


    public function getSingleByName($name) {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE name="$name"
        EOS;
        $r = $this->query($q);

        if ($r && $r->num_rows == 1) {
            $u = $r->fetch_assoc();
            $product = $this->createProduct($u);
            $r->free();

            return $product;
        }
        return false;
    }

    public function getByName($name) {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE name="$name"
        EOS;
        $r = $this->query($q);
        $productsWithName = array();

        while ($n = $r->fetch_assoc()) {
            $productsWithName[] = $this->createProduct($n);
        }
        $r->free();
        return $productsWithName;
    }


    public function getByUser($_user) {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE _user="$_user"
        EOS;
        $r = $this->query($q);
        $productsByUser = array();

        while ($n = $r->fetch_assoc()) {
            $productsByUser[] = $this->createProduct($n);
        }
        $r->free();
        return $productsByUser;
    }


    public function getByConsole() {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE type="console"
        EOS;
        $r = $this->query($q);
        $consoles = array();

        while ($n = $r->fetch_assoc()) {
            $consoles[] = $this->createProduct($n);
        }
        $r->free();
        return $consoles;
    }


    public function getByEquipment() {
        $q = <<<EOS
            SELECT *
            FROM product
            WHERE type="equipment"
        EOS;
        $r = $this->query($q);
        $equipments = array();

        while ($n = $r->fetch_assoc()) {
            $equipments[] = $this->createProduct($n);
        }
        $r->free();
        return $equipments;
    }


    public function addProduct($product) {
        $q = <<<EOS
            INSERT INTO product (name, price, _user, type, description, link)
            VALUES (
                "{$product->getName()}",
                "{$product->getPrice()}",
                "{$product->getUser()}",
                "{$product->getType()}",
                "{$product->getDescription()}",
                "{$product->getLink()}"
            )
        EOS;

        $this->query($q);
    }

    private function createProduct($n) {
        return new DTOProduct($n["name"], $n["price"], $n["_user"], $n["type"], $n["description"], $n["link"], $n["id"]);
    }
}
?>