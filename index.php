<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spritee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
    <a href="index.php"><img src="images/image.png" alt="logo" class="logo">  </a>  
    <img id="menubar" src="images/menubar.png" alt="">
        <div class="navback">
            <img id="crossicon" src="images/cross.png" alt="">
            <nav class="nav1">
                <ul class="nav">
                    <a href="#"><li>Home</li></a>
                    <a href="draw.html"><li>Draw</li></a>
                    <a href="https://github.com/NighterFlex/Spritee" target="_blank"><li>Github</li></a>
                    <a href="signin.php"><li>Login</li></a>
                </ul>
            </nav>
        </div>    

    </div>

    <div class="bgimg">
        <!-- <img src="bg.png" alt="bg" > -->
         <!-- <img src="images/bg.png" alt="bg" style="width: 100%; height: 70vh; object-fit: cover;"> -->
    </div>


        <div class="draw-btn">
            <a href="draw.html"><button >DRAW</button></a>
        </div>
<div class="auth-btns">
    <a href="login.html"><button class="auth login">LOGIN</button></a>
    <a href="register.html"><button class="auth register">REGISTER</button></a>
</div>


<script src="home.js"></script>
</body>

<footer>
    
    <p id="welcome-paragraph">Welcome to <b id="msg-spritee">SpRITEE</b>! Probably the most fun and intriguing websites out there. What's it about? Welllll, It's just a little pixel-art maker! A place where one can draw ANYTHING pixelated. I tried to keep it as interactive as possible. Hope you enjoy!!!! :3</p>
    </p>
    <p id="copyright">© 2024 Spritee. All rights reserved.</p>
</footer>
</html>