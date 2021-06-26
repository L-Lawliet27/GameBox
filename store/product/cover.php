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

        $delete="";
        if(isset($_SESSION["rol"])){
            if( $_SESSION["rol"] =='admin'){
                $delete='<a class="btnInactivate" href="javascript:void(0);" 
                    onclick="javascript:confirmAction('."'inactivateProduct.php?id=".$product->getId()."'".')" title="Inactivate this Product?">
                    <i>X </i>
                    </a>';
            }

        $storeContent .= <<<EOS
            <figure class="item">
                <figcaption>
                    {$delete}
                    <a class="infoItem" href="productView.php?id={$product->getId()}">
                        <i>
                            <h2>{$product->getName()}</h2>
                        </i>
                    </a>
                </figcaption>
            </figure>
EOS;
        }
    }
}

$storeContent .= "</section>";

require_once(PROJECT_ROOT . "/includes/templates/productsStoreTemplate.php");
?>