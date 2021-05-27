<?php

require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/AddProductForm.php");

$storeContent = (new AddProductForm)->gestiona();

require_once(PROJECT_ROOT . "/includes/templates/productsStoreTemplate.php");
?>