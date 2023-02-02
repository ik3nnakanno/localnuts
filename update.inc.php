<?php include 'config.php';
 session_start();
 $username = $_SESSION['ausername'];
 
 if(!isset($_SESSION['ausername'])){
     header("Location: login.admin.php?error=You're not logged in");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ln Upload hub</title>
    <link rel="stylesheet" href="main.css"><link rel="icon" href="images/icon.png">
</head>
<body id="body-main">
    <header>
        <div class="title"><a href="index.php"><img src="images/logo.png" alt="logo"></a><h3>Chef Section</h3></div>
        
    </header>
    <main>
        <ul>
            <li>Hello <span><?php echo $username?></span></li>
            <li>Upload
            <ul class="dropdown">
                <a href="chinese.inc.php"><li>Chinese</li></a>
                <a href="nigerian.inc.php"><li>Nigerian</li></a>
                <a href="normal.inc.php"><li>Normal</li></a>
                <a href="drinks.inc.php"><li>  Drinks</li></a>
            </ul></li>
            <a href="update.inc.php" class="active"><li>Update
                <ul class="dropdown">
                    <a href="update_chi.inc.php"><li>Chinese</li></a>
                    <a href="update_nig.inc.php"><li>Nigerian</li></a>
                    <a href="update_norm.inc.php"><li>Normal</li></a>
                    <a href="update_drinks.inc.php"><li>Drinks</li></a>
                </ul>
            </li></a>
            <a href="sales.inc.php"><li>Sales History</li></a>
            <a href="logout.inc.php"><li>Logout</li></a>
        </ul>
        <h4 align="center">Update food name, price and image here.</h4><br>
        <?php if (isset($_GET['message'])) { ?>
		<p align="center" class="message"><?php echo $_GET['message']; ?></p>
	        <?php } ?>


    </main>
    