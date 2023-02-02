<?php
    include 'config.php';
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
    <title>Sales</title>
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
                <a href="drinks.inc.php"><li>Drinks</li></a>
            </ul></li>
            <a href="update.inc.php"><li>Update</li></a>
            <a href="sales.inc.php"  class="active"><li>Sales History</li></a>
            <a href="logout.inc.php"><li>Logout</li></a>
        </ul>
        <?php
        $query ="SELECT * FROM orders";
        $result = mysqli_query($conn, $query) or die("Image QUERY FAILED".MYSQLI_ERROR($conn));
    
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
                ?>
        <div class="sales"> 
            <label for="">Customer name: <span><?=$item['first_name']?>&nbsp;<?=$item['last_name']?></span></label><br>
            <label for="">Phone number: <span><?=$item['phone']?></span></label><br>
            <label for="">Purchased: <span><?=$item['total_product']?></span></label><br>
            <label for="">Payment method: <span><?=$item['method']?></span></label><br>
            <label for="">Price: ₦ <span><?=$item['total_price']?></span></label><br>
            <label for="">Date: <span><?=$item['date']?></span></label>
        </div> <hr>
               <?php
            }   
        