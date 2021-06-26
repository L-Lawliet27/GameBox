<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/LoginForm.php");

$sectionName = "sectionlogin";
$title = "Login";
$content = (new LoginForm)->gestiona();
require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");