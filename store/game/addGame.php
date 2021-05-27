<?php

require_once(__DIR__ . "/../../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/AddGameForm.php");

$storeContent = (new AddGameForm)->gestiona();

require_once(PROJECT_ROOT . "/includes/templates/gamesStoreTemplate.php");
?>