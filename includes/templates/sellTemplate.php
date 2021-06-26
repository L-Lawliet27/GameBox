<?php
require_once(__DIR__ . "/../config.php");

$title = "Sell";
$sectionName = "sell";
if (isset($_GET['f_category'])) {
    $f_category = $_GET['f_category'];
}
$topNavContent = <<<EOS
	<form id="combo" name="combo" action="cover.php" method="GET">
		<div>Category: 
			<select name="f_category" id="bx_category">
				<option value="0">Select an option</option>
EOS;
if ($f_category == "consola") {
	$topNavContent .= "<option value=\"consola\" selected=\"selected\">Consoles</option>";
} else{
	$topNavContent .= "<option value=\"consola\">Consoles</option>";
}
if ($f_category == "equipamiento") {
	$topNavContent .= "<option value=\"equipamiento\" selected=\"selected\">Equipments</option>";
} else{
	$topNavContent .= "<option value=\"equipamiento\">Equipments</option>";
}
$topNavContent .= <<<EOS
			</select>
		</div>
		<input type="submit" value="Filter"/>
	</form>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/storeTemplate.php");

 