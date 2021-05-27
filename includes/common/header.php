<?php
require_once(__DIR__ . "/../config.php");
?>

<header>
    <nav class="menu">   
        <ul>
            <a href="/GameBox/index.php">
                <input type="image" name="logo" src="/GameBox/includes/common/logo.png"/>
            </a>
            <a class="aMain" href="/GameBox/store/game/cover.php"><li>Store</li></a>
            <a class="aMain" href="/GameBox/forum/cover.php?left=1&right=1"><li>Blog</li></a>
            <a class="aMain" href="/GameBox/streams/cover.php?left=1&right=1"><li>Streams</li></a>			
            <a class="aMain" href="/GameBox/about/about.php"><li>About</li></a>
            <a href="">
                <li>Profile
                    <?php if( !isset($_SESSION["loggedin"]) !== false ): ?>
                        <ul>
                        <a class="aMain" href="/GameBox/login/login.php"><li>Login</li></a>
                        <a class="aMain" href="/GameBox/login/signUp.php"><li>Sign up</li></a>
                        </ul>
                    <?php else :?>
                        <ul>
                        <a class="aMain" href="/GameBox/profile/profile.php"><li>Profile</li></a>
                        <a class="aMain" href="/GameBox/login/logout.php"><li>Logout</li></a>
                        </ul>
                    <?php endif ?>
                </li>
            </a>
        </ul>
	</nav>
</header>
