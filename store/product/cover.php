<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOProduct.php");

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

$storeContent = "<section id=\"entries\">";

$daoProduct = new DAOProduct();
$products = null;

if (isset($filter)) {
    switch ($filter) {
        case "consoles":
            $products = $daoProduct->getByConsole();
            break;

        case "equipment":
            $products = $daoProduct->getByEquipment();
            break;
    }
} else {
    $products = $daoProduct->getAllProducts();
}

if (!empty($products)) {
    foreach ($products as $product) {
        $storeContent .= <<<EOS
            <a href="productView.php?id={$product->getId()}">
                <i>
                    <h2>{$product->getName()}</h2>
                </i>
            </a>
EOS;
    }
}

$storeContent .= "</section>";

require_once(PROJECT_ROOT . "/includes/templates/productsStoreTemplate.php");
?>