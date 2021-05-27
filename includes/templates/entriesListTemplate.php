<?php
require_once(__DIR__ . "/../config.php");

/**
 * Navegador para moverse entre las diferentes páginas de un panel
 * Ejemplo:
 * Previous 1 2 3 4 5 Next
 */
function getNavigatorHTML($panelId, $totalEntries, $entriesPerPage, $navigatorAction) {
    $nPages = $totalEntries == 0 ? 1 : intval(ceil($totalEntries / $entriesPerPage));

    // Número de página del panel izquierdo y del derecho
    $pages = array("left" => $_GET["left"], "right" => $_GET["right"]);

    // Enlace a la página anterior
    $pages[$panelId] = $_GET[$panelId] == 1 ? 1 : $_GET[$panelId] - 1;
    $navigatorHTML = <<<EOS
        <a href="$navigatorAction?left={$pages["left"]}&right={$pages["right"]}">Previous</a>
    EOS;

    // Enlaces numerados a cada una de las páginas
    for ($pages[$panelId] = 1; $pages[$panelId] <= $nPages; $pages[$panelId]++) {
        $navigatorHTML .= <<<EOS
            <a href="$navigatorAction?left={$pages["left"]}&right={$pages["right"]}">{$pages[$panelId]}</a>
        EOS;
    }

    // Enlace a la página siguiente
    $pages[$panelId] = $_GET[$panelId] == $nPages ? $nPages : $_GET[$panelId] + 1;
    $navigatorHTML .= <<<EOS
        <a href="$navigatorAction?left={$pages["left"]}&right={$pages["right"]}">Next</a>
    EOS;

    return $navigatorHTML;
}

/**
 * Panel donde se muestra un número determinado de entradas ("$entriesPerPage").
 * El navegador ("getNavigatorHTML") permite desplazarse entre las páginas.
 * Las entradas pueden corresponder a discusiones del foro, por ejemplo.
 */
function getPanelHTML($panelId, $title, $panelEntriesHTML, $totalEntries, $entriesPerPage, $navigatorAction) {
    // HTML para el navegador de páginas
    $navigatorHTML = getNavigatorHTML($panelId, $totalEntries, $entriesPerPage, $navigatorAction);

    // HTML para las entradas del panel
    $entriesHTML = "";
    foreach ($panelEntriesHTML as $entry) {
        $entriesHTML .= <<<EOS
            <article class="entry">
                $entry
            </article>
        EOS;
    }

    $entriesPanelHeight = $entriesPerPage * 56;
    return <<<EOS
        <section class="panel">
            <h2 class="title">$title</h2>
            $navigatorHTML
            <br><br>
            <section class="entriesPanel" style="height: {$entriesPanelHeight}px;">
                $entriesHTML
            </section>
            <br>
            $navigatorHTML
        </section>
    EOS;
}

/**
 * Formulario que permite añadir una nueva entrada (una discusión si esta plantilla fuera utilizada por el foro, por ejemplo)
 */
function getFormPanelHTML($formPanelName, $formHTML) {
    return <<<EOS
        <section class="formPanel">
            <h2 class="title">$formPanelName</h2>
            $formHTML
        </section>
    EOS;
}

$content = getPanelHTML("left", $leftPanelName, $leftPanelEntriesHTML, $totalEntries, $entriesPerPage, $navigatorAction);
$content .= getPanelHTML("right", $rightPanelName, $rightPanelEntriesHTML, $totalEntries, $entriesPerPage, $navigatorAction);
$content .= getFormPanelHTML($formPanelName, $formHTML);

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
