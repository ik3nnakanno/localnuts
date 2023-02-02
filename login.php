<?php
includes 'config.php';

if(isset($_POST['submit'])){
session_start();
    $_SESSION['username'] = $_POST['username'];
}
if(isset($_POST['submit'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    if (empty($username)) {
        header("Location: login.php?error=username is required");
            exit();
    }elseif (empty($password)) {
        header("Location: login.php?error=password is required");
            exit();  
     }else {}
        $query = "SELECT * FROM user WHERE username = '$username'";
        
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])){
                   header("Location: tray.php");
                   exit();
            }else{
                header("Location: login.php?error=Incorrect username or password");
                exit();
            }
        }else{
            header("Location: login.php?error=Incorrect username or password");
            exit();
        }
    } 

?>
<!DOCTYPE html>
<html>
<head>
  <title>login</title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="tray.css"><link rel="icon" href="images/icon.png">
</head>
<body>
<nav class="tray-nav">
    <a href="localnut.php"><img src="images/logo.png" width="170px" alt="logo" id="logo"></a>
        
        
    </nav>
 
  <form action="" method="post" class="login-f">
  	<h2 align="center" class="hal">Login</h2>

	<?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
    <?php if (isset($_GET['success'])) { ?>
		<p align="center" class="success"><?php echo $_GET['success']; ?></p>
	        <?php } ?>

	<label>username: </label>
	<input type="text" value="Client_03" name="username" placeholder="username"><br>

	<label>password: </label>
	<input type="password" value="123" name="password" placeholder="password"><br>

	<button type="submit" name="submit">Login</button><br>
    <label for=""><a href="register.php" class="link">Sign up now</a> </label>

  </form>
</body>
</html>