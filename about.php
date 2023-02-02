<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="ln.css">
    <link rel="icon" href="images/icon.png">
</head>

<body>
    <nav class="about">
        <input id="nav-toggle" type="checkbox">
        <a href="localnut.php"><img src="images/logo.png" width="170px" class="lg" alt="logo" id="logo"></a>
        <ul>
            <a href="localnut.php">
                <li>Home</li>
            </a>
            <a href="beverages.php">
                <li>Beverages</li>
            </a>
            <a href="chinesefood.inc.php">
                <li>Chinese</li>
            </a>
            <a href="nigerianfood.inc.php">
                <li>Nigerian</li>
            </a>
            <a href="logout.php">
                <li>Login/Logout</li>
            </a>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    <main class="abt-main">
        <div class="image"><img src="images/F8C11180-DE3F-C4A2-AEA363DDCF96210B.jpg" alt=""></div>
        <div class="text">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro deserunt vel atque labore sint distinctio
                temporibus blanditiis, quibusdam officia vitae modi debitis repellat, voluptates voluptatum ad, nemo sed
                fugiat alias. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium numquam sed
                necessitatibus a odio et cupiditate neque, blanditiis sequi culpa cumque, eligendi fugit laudantium
                aliquam quisquam error, sapiente omnis voluptatem.
            </p>
        </div>
    </main>

    <footer id="foot">
        <div class="contact">
            <h3>Contact us</h3>
            +234 XXX XXXX XXX
            <br>
            +234 XXX XXXX XXX<br><br>
            <a href="mailto:@domain@gmail.com"><img src="images/mail.png" alt="email us">&nbsp;Mail us</a><br><br>
            <img src="images/location.png" width="30px" height="30px" alt="">&nbsp;&nbsp;<label>Plot 5 Kado District,
                Abuja</label>
        </div>
        <div class="lgimg">
            <img src="images/insta.png" width="30px" height="30px" alt="ig"><a href=""><span
                    class="a1">@localnuts</span></a>&nbsp;&nbsp;&nbsp;
            <img src="images/fb.png" width="30px" height="30px" alt="fb"><a href=""><span class="a2">local
                    nuts</span></a>&nbsp;&nbsp;&nbsp;
            <img src="images/twitter.png" width="30px" height="30px" alt="twitter"><a href=""><span
                    class="a3">@local_nuts</span></a>&nbsp;&nbsp;&nbsp;

        </div>


        <a href="#">Back to top</a> <br>
        &copy;
        <?php echo date("Y"); ?>

    </footer>

</body>

</html>