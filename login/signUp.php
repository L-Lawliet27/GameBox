<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/SignUpForm.php");

$sectionName = "signUp";
$title = "Sign Up";
$content = (new SignUpForm)->gestiona();
require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");