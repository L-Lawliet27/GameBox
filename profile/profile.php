<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/LoginForm.php");

$title = "Profile";

//$name = $datos["name"];
$name = $_SESSION["name"];
$rol =  $_SESSION["rol"];

$content = <<<EOS

    <section>
        <div>
            <h2> Nombre de usuario </h2>
            <input readonly id="nombre" type="text" name="name" value="$name"
        </div>
        <div>
            <h2> Rol de usuario </h2>
            <input readonly id="nombre" type="text" name="name" value="$rol"
        </div>
    </section>

EOS;

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
