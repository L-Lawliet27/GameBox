<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOProduct.php");

$daoProduct = new DAOProduct();
$product = $daoProduct->getById($_GET["id"]);

$storeContent = <<<EOS
    <section id="itemsView">
        <h1 id="name">{$product->getName()}</h1>

        <h2 id="user">Sold by {$product->getUser()}</h2>

        <h3 id="description">{$product->getDescription()}</h3>

        <h2 id="price">{$product->getPrice()}</h2>

        <div id="buttons">
        <button type=\"button\" onclick="window.open('{$product->getLink()}','_blank')" style="margin-left:50px;">
        Purchase</button>
        </div>

        <h3 id="genre" style="left:655px;">{$product->getType()}</h3>
    </section>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/productsStoreTemplate.php");
?>