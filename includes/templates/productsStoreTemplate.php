<?php
require_once(__DIR__ . "/../config.php");

$topNavContent = <<<EOS
    <ul>
        <a href="cover.php?filter=consoles"><li>Consoles</li></a>
        <a href="cover.php?filter=equipment"><li>Equipment</li></a>
        <a href="addProduct.php" id="add"><li>Add Product +</li></a>
    </ul>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/storeTemplate.php");
?>