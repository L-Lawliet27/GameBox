<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOSell.php");

$daoSell = new DAOSell();
$sells = null;
$f_category = null;

if (isset($_GET['f_category'])) {
    $f_category = $_GET['f_category'];
    $sells = $daoSell->getByCategory($f_category);
}

$storeContent = "<section id=\"store\">";
$storeContent .= "<table id=\"table-container\">";
$storeContent .= "<tr>";
$storeContent .= "<td id=\"table-container-entries\" >";
$storeContent .= "<section id=\"entries\">";
if (!empty($sells)) {
    foreach ($sells as $sell) {
        $storeContent .= <<<EOS
            <a href="cover.php?f_category={$f_category}&id={$sell->getId()}">
                {$sell->getName()}
            </a>
EOS;
    }
}
$storeContent .= "</section>";
$storeContent .= "</td>";

$storeContent .= "<td id=\"table-container-article\" >";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sell = $daoSell->getById($id);
    $storeContent .="<fieldset>
                        <h3>WHAT WE OPPER: {$sell->getName()}</h3>
                        <h2>Price: {$sell->getPrice()}€</h2>
                        <input type=\"submit\" href=\"valuesellForm.php\" id=\"\" Value=\"Accept\"</input>
                        <input type=\"submit\" value=\"Decline\"/>
                        
                    </fieldset>";
}
$storeContent .= "</td>";
$storeContent .= "</tr>";
$storeContent .= "</table>";
$storeContent .= "</section>";


require_once(PROJECT_ROOT . "/includes/templates/sellTemplate.php");
