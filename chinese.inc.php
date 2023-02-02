<?php
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
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="images/icon.png">
</head>
<body class="chinese-body">
    <header>
        <div class="title"><a href="index.php"><img src="images/logo.png" alt="logo"></a><h3>Chef Section</h3></div>
        
    </header>
    <main>
        <ul>
            <li>Hello <span><?php echo $username?></span></li>
            <a href="#"><li class="active">Chinese
            </a><ul class="dropdown">
                <a href="nigerian.inc.php"><li>Nigerian</li></a>
                <a href="normal.inc.php"><li>Normal</li></a>
                <a href="drinks.inc.php"><li>Drinks</li></a>
            </ul></li>
            <a href="update.inc.php"><li>Update</li></a>
            <a href="sales.inc.php"><li>Sales History</li></a>
            <a href="logout.inc.php"><li>Logout</li></a>
        </ul>
        <div class="action">
            <form action="chinese.php" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['error'])) { ?>
		<p align="center" class="error"><?php echo $_GET['error']; ?></p>
	        <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
		<p align="center" class="success"><?php echo $_GET['success']; ?></p>
	        <?php } ?>
            
            <label for="food_name">Food Name</label><br>
                <input type="text" placeholder="Food name" name="food_name"><br>
                <label for="price">Price</label><br>
                <input type="number" placeholder="price" name="price"><br>
                <label for="food-image">Upload food image</label><br>
                <input type="file" name="food-img"><br>
                <button type="submit" name="submit" value="Upload">Upload</button>
            </form>
        </div>
    </main>
</body>
</html>