<?php
require_once(__DIR__ . "/../config.php");

$title = "Store";
$sectionName = "store";

$leftNavContent = <<<EOS
    <ul>
        <a href="/GameBox/store/game/cover.php"><li>Games</li></a>
        <a href="/GameBox/store/product/cover.php"><li>Products</li></a>
        <a href=""><li>Sell</li></a>
    </ul>
EOS;

$content = <<<EOS
    <nav class="menu">
        $topNavContent
    </nav>
    
    $storeContent
EOS;

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
?>