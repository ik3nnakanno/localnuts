<?php
include 'config.php';

if(isset($_POST['submit'])){
session_start();
    $_SESSION['ausername'] = $_POST['ausername'];
}
if(isset($_POST['submit'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $ausername = validate($_POST['ausername']);
    $password = validate($_POST['password']);
    if (empty($ausername)) {
        header("Location: login.admin.php?error=username is required");
            exit();
    }elseif (empty($password)) {
        header("Location: login.admin.php?error=password is required");
            exit();  
     }else {}
        $query = "SELECT * FROM admin WHERE ausername = '$ausername'";
        
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])){
                   header("Location: chef.php");
                   exit();
            }else{
                header("Location: login.admin.php?error=Incorrect username or password");
                exit();
            }
        }else{
            header("Location: login.admin.php?error=Incorrect username or password");
            exit();
        }
    } 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="main.css"><link rel="icon" href="images/icon.png">
</head>
<body id="body-main">
    <header>
        <div class="title"><a href="index.php"><img src="images/logo.png" alt="logo"></a><h3>Chef Section</h3></div>
        
    </header>
    <main>
        <ul>
            <li>Hello $user</li>
            <li>Upload
            <ul class="dropdown">
                <a href="chinese.inc.php"><li>Chinese</li></a>
                <a href="nigerian.inc.php"><li>Nigerian</li></a>
                <a href="normal.inc.php"><li>Normal</li></a>
                <a href="drinks.inc.php"><li>Drinks</li></a>
            </ul></li>
            <a href="update.inc.php"><li>Update</li></a>
            <a href="sales.inc.php"  ><li>Sales History</li></a>
            <a href="logout.inc.php" class="active"><li>Logout</li></a>
        </ul>
	 
  <form action="" method="post">
  	<h2 align="center" class="hal">Login</h2>

	<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
    <?php if (isset($_GET['success'])) { ?>
		<p align="center" class="success"><?php echo $_GET['success']; ?></p>
	        <?php } ?>

	<label>username: </label>
	<input type="text" value="guest_admin" name="ausername" placeholder="username"><br>

	<label>password: </label>
	<input type="password" value="123" name="password" placeholder="password"><br>

	<button type="submit" name="submit">Login</button><br>

  </form>
</body>
</html>