<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spritee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <a href="index.php">
            <img src="images/image.png" alt="logo" class="logo">
        </a>
        <img id="menubar" src="images/menubar.png" alt="">
        <div class="navback">
             <img id="crossicon" src="images/cross.png" alt="">
            <nav class="nav1">
                <ul class="nav">
                    
                    <a href="#">
                        <li>Home</li>
                    </a>
                    <?php if (isset($_SESSION['logged_in'])): ?>
                        <a href="draw.php">
                            <li>Draw</li>
                        </a>
                        <?php else: ?>
                            <a href="signin.php" id="navDraw">
                                <li>Draw</li>
                            </a>
                            <?php endif; ?>
                            
                            <a href="https://github.com/NighterFlex/Spritee" target="_blank">
                                <li>Github</li>
                            </a>
                            
                            <!-- LOGIN / USER MENU -->
                            <?php if (isset($_SESSION['logged_in'])): ?>
                                <li class="user-menu">
                                    <span class="username">
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </span>
                                    
                                    <div class="dropdown">
                                        <!-- <a href="#">Extra Button</a> -->
                                        <a href="logout.php">Logout</a>
                                    </div>
                                </li>
                                <?php else: ?>
                                    <a href="signin.php">
                                        <li>Login</li>
                                    </a>
                                    <?php endif; ?>
                                    
                                </ul>
                            </nav>
            </div>
    </div>

    <!-- HERO SECTION -->
     <div class="extra"></div>
    <div class="bgimg"></div>

    <div class="draw-btn">
        <?php if (isset($_SESSION['logged_in'])): ?>
            <a href="draw.php"><button>DRAW</button></a>
        <?php else: ?>
            <a href="signin.php"><button id="drawBtn">DRAW</button></a>
        <?php endif; ?>
    </div>


    <!-- AUTH BUTTONS (HIDE WHEN LOGGED IN) -->
    <?php if (!isset($_SESSION['logged_in'])): ?>
        <div class="auth-btns">
            <a href="signin.php"><button class="auth login">LOGIN</button></a>
            <a href="signin.php"><button class="auth register">REGISTER</button></a>
        </div>
    <?php endif; ?>

    <footer>
        <p id="welcome-paragraph">Welcome to <b id="msg-spritee">SpRITEE</b>! Probably the most fun and intriguing websites out there. What's it about? Welllll, It's just a little pixel-art maker! A place where one can draw ANYTHING pixelated. I tried to keep it as interactive as possible. Hope you enjoy!!!! :3</p>
        </p>
        <p id="copyright">© 2025 Spritee. All rights reserved.</p>
    </footer>

    <script>
        <?php if (!isset($_SESSION['logged_in'])): ?>
            const drawBtn = document.getElementById('drawBtn');

            drawBtn.addEventListener('click', function(e) {
                e.preventDefault(); // stop default link behavior
                alert('Sign in to draw!'); // show alert message
                window.location.href = 'signin.php'; // redirect to sign-in page
            });
        <?php endif; ?>

            <?php if (!isset($_SESSION['logged_in'])): ?>
        const navDraw = document.getElementById('navDraw');

        if (navDraw) {
            navDraw.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Sign in to draw!');
                window.location.href = 'signin.php';
            });
        }
        <?php endif; ?>


    document.addEventListener('DOMContentLoaded', () => {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.querySelector('.user-menu .dropdown');

    if (userMenu) {
    userMenu.addEventListener('click', (e) => {
    e.stopPropagation(); // prevent click from closing immediately
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', () => {
    dropdown.style.display = 'none';
    });
    }
    });
    </script>
    <script src="home.js"></script>

</body>

</html>