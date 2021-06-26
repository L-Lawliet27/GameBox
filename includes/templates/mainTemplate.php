<?php
require_once(__DIR__ . "/../config.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title> <?= $title ?> </title>
    <link rel="stylesheet" type="text/css" href="/GameBox/style.css">
    <script type="text/javascript" src="/GameBox/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/GameBox/js/main.js"></script>
</head>

<body>

    <section id="container">
        <?php require(PROJECT_ROOT . "/includes/common/header.php"); ?>

        <?php if (isset($leftNavContent)) : ?>
            <nav class="menu" id="left">
                <?= $leftNavContent ?>
            </nav>
        <?php endif ?>

        <section id="content">
            <section id="<?= $sectionName ?>">
                <?= $content ?>
            </section>
        </section>

        <?php require(PROJECT_ROOT . "/includes/common/footer.php"); ?>
    </section>

</body>

</html>