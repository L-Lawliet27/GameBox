<?php
require_once(__DIR__ . "/../includes/config.php");

$title = "About";
$sectionName = "about";
$content = <<<EOS
    <h1> Sobre Nosotros: </h1> 	
	<h2>Misión</h2>
	<p>
        La misión de la plataforma es que los gamers profesionales y aficionados tengan un espacio donde 
		poder compartir sus  inquitudes y dudas en relacion al mundo de los videojuegos.
    </p>
	<h2>Visión</h2>
	<p>La visión de la plataforma es llegar a ser una página pionera para los gamers.</p>
	<h2>Contacto</h2>
	<p>Telefono: 555000555</p>
	<p>Email:  info@gamebox.com</p>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
