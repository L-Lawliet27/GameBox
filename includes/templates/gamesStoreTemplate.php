<?php
require_once(__DIR__ . "/../config.php");

$topNavContent = <<<EOS
    <ul>
        <a href="">
            <li>
                Genres
                <ul>
                    <a href="cover.php?filter=genre&type=action"><li>Action</li></a>
                    <a href="cover.php?filter=genre&type=adventure"><li>Adventure</li></a>
                    <a href="cover.php?filter=genre&type=horror"><li>Horror</li></a>
                    <a href="cover.php?filter=genre&type=rpg"><li>RPG</li></a>
                </ul>
            </li>
        </a>
        <a href="cover.php?filter=popular"><li>Top Games</li></a>
        <a href="cover.php?filter=recent"><li>Recently Released</li></a>
        <a href="addGame.php" id="add"><li>Add Game +</li></a>
    </ul>
EOS;

require_once(PROJECT_ROOT . "/includes/templates/storeTemplate.php");
?>