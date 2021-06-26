<?php
require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOSell.php");

$daoSell = new DAOSell();
$sell = $daoSell->getById($_GET["id"]);

$storeContent = <<<EOS
    <section id="itemsView">
        <h1 id="name">{$sell->getName()}</h1>

        <h2 id="price">{$sell->getPrice()}</h2>

        <h3 id="category">{$sell->getCategory()}</h3>
    </section>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/sellTemplate.php");
