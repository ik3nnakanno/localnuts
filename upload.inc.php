<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ln Upload hub</title>
    <link rel="stylesheet" href="main.css"><link rel="icon" href="images/icon.png">
</head>
<body>
    <header>
        <div class="title"><a href="index.php"><img src="images/logo.png" alt="logo"></a><h3>Chef Section</h3></div>
        
    </header>
    <main>
        <ul>
            <li>Hello $user</li>
            <li class="active">Upload
            <ul class="dropdown">
                <a href="chinese.inc.php"><li>Chinese</li></a>
                <a href="nigerian.inc.php"><li>Nigerian</li></a>
                <a href="normal.inc.php"><li>Normal</li></a>
                <a href="drinks.inc.php"><li>Drinks</li></a>
            </ul></li>
            <a href="update.inc.php"><li>Update</li></a>
            <a href="sales.inc.php"><li>Sales History</li></a>
            <a href="logout.inc.php"><li>Logout</li></a>
        </ul>
        <div class="action">
            <?php if (isset($_GET['error'])): ?>
                <p><?php echo $_GET['error']; ?></p>
                <?php endif ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="food_name">Food Name</label><br>
                <input type="text" placeholder="Food name" name="food_name"><br>
                <label for="price">Price</label><br>
                <input type="number" placeholder="price" name="price"><br>
                <label for="food-image">Upload food image</label><br>
                <input type="file" name="food-img"><br>
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
    </main>
</body>
</html>