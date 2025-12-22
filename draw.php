<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draw</title>
    <link rel="stylesheet" href="draw.css">

</head>

<canvas id="export-canvas" style="display:none;"></canvas>

<body>
    <div class="navbar">
        <a href="index.php">
            <img src="images/image.png" alt="logo" class="logo">
        </a>

        <nav class="nav1">
            <ul class="nav">

                <a href="index.php">
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



    <div class="panel">
        <div class="tools">
            <h1 id="tools-heading">Tools</h1>
            <div class="tools-grid">
                <button id="pen-btn" class="tool-btn active">✎ Pen</button>
                <button id="eraser-btn" class="tool-btn">🗑 Eraser</button>
            </div>
            <button id="reset-btn" class="btn">⟳ Reset</button>
            <input type="color" value="#fffff" class="color-picker">
            <input type="number" value="20" class="size">
        </div>
        <div class="container-panel">
            <div class="container">
                <!-- <div class="box"></div>
            <div class="box"></div> -->
            </div>
        </div>

        <div class="actions">
            <h1 id="actions-heading">Actions</h1>
            <button class="btn" id="download-btn">⬇ Download</button>
            <button class="btn" id="save-btn">⎙ Save</button>
            <a href="gallery.html" target="_blank" class="btn">[◉°] Gallery</a>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="script.js"></script>

    <script>
        //alert shown when navdraw is click
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

        // dropmenu shown
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

</body>

</html>