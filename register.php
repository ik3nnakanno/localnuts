<?php
include 'config.php';

if(isset($_POST['submit'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $password2 = validate($_POST['password2']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);

    
    if (empty($first_name)) {
        header("Location: register.php?error=Fisrt name is required");
            exit();
    }elseif (empty($last_name)) {
        header("Location: register.php?error=Last name is required");
            exit();
    }elseif (empty($email)) {
        header("Location: register.php?error=Email is required");
            exit();
    }elseif (empty($username)) {
        header("Location: register.php?error=Username is required");
            exit();
    }elseif (empty($password)) {
        header("Location: register.php?error=Password is required");
            exit();
    }elseif($password != $password2){
            header("Location: register.php?error=Passwords don't match");
            exit();
    }else{}
    
    $check_query= $row="SELECT email FROM user WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query) or die('error dey'.mysqli_error($conn));
    if(mysqli_num_rows($check_result) > 0){
        header("Location: register.php?error=This Email is taken");
            exit();
    }else{}

    $query = "INSERT INTO user (first_name, last_name, email, username, password) " . "VALUES('$first_name', '$last_name', '$email', '$username', '$hash')";
    $result = mysqli_query($conn, $query) or die('Wahala dey oo');
    header('location: login.php?success=Registration Successful');
}else{
    
}
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="ln.css"><link rel="icon" href="images/icon.png">
</head>
<body class="regg">
    <form action="" method="post">
        <h2 class="hal" align="center">Register</h2><br>
    <?php if (isset($_GET['error'])) { ?>
		<p align="center" class="error"><?php echo $_GET['error']; ?></p>
	        <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
		<p align="center" class="success"><?php echo $_GET['success']; ?></p>
	        <?php } ?>
        <label for="">Username</label><br>
        <input type="text" name="username"><br>
        <label for="">Password</label><br>
        <input type="password" placeholder="password" name="password"><br>
        <label for="">Confirm password</label><br>
        <input type="password" placeholder="confirm password" name="password2"><br>
        <label for="">First Name</label><br>
        <input type="text" name="first_name" placeholder="first name"><br>
        <label for="">Last Name</label><br>
        <input type="text" name="last_name" placeholder="last name"><br>
        <label for="">Email</label><br>
        <input type="email" name="email" placeholder="email@domain.com"><br>
        <button type="submit" name="submit" class="reg-btn">Register</button>
    </form>
</body>
</html>