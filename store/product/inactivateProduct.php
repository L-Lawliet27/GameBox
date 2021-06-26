<?php

require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOProduct.php");

$daoProduct = new DAOProduct();
$product = $daoProduct->getById($_GET["id"]);

$daoProduct->inactivateProduct($product->getId());

header("Location: cover.php");
exit();

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
