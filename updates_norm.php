<?php
include "config.php";

if(isset($_POST['submit'])){   
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $food_id= $_GET['food_id'];
    $food_name = validate($_POST['food_name']);
    $price = validate($_POST['price']);


    $img_name = $_FILES['food-img']['name'];
     $img_size = $_FILES['food-img']['size'];
     $tmp_name = $_FILES['food-img']['tmp_name'];
     $error = $_FILES['food-img']['error'];
    
     $query = "SELECT food_name from food where food_name = '$food_name' ";

     $result = mysqli_query($conn, $query) or die("USER QUERY FAILED".mysqli_error($conn));
     

     if (empty($food_name)) {
        header("Location: update_norm.php?error=Food name is required");
            exit();
    }elseif (empty($price)) {
        header("Location: update_norm.php?error=Pricing is required");
            exit();
    }else {
                 
    }
     
     if ($error === 0) {
        if ($img_size > 513024){
            header("Location: update_norm.php?error=File too large");
            exit();
    }else{
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "png", "jpeg", "webp");

        if (in_array($img_ex_lc, $allowed_exs)){
            $new_img_name = uniqid("local_nuts-", true).'.'.$img_ex_lc;
            $img_upload_path = 'img-contain/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);


            //Insert into database

            $query = "UPDATE food SET food_name='$food_name', price='$price', food_image='$new_img_name' WHERE food_id='$food_id'";
                
            $result = mysqli_query($conn, $query) or die("Operation failed".MYSQLI_ERROR($conn)); 
            
            header("Location: update_norm.php?success=Updated Successful"); 
        }else{
            
           header("Location: update_norm.php?error=Error processing your request");
            exit();
        }

    }
     }else{
        header("Location: update_norm.php?error=Incomplete Data!");
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
    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="main.css">
</head>
<body>
        <div class="action">
            <form method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['error'])) { ?>
		<p align="center" class="error"><?php echo $_GET['error']; ?></p>
	        <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
		<p align="center" class="success"><?php echo $_GET['success']; ?></p>
	        <?php } ?>
            
            <form action="" method="post">
                <label for="food_name">Food Name</label><br>
                <input type="text" placeholder="Food name" name="food_name"><br>
                <label for="price">Price</label><br>
                <input type="number" placeholder="price" name="price"><br>
                <label for="food_image">Update image</label><br>
                <input type="file" class="box" required name="food_image" accept="image/png, image/jpg, image/jpeg">
                <button type="submit" name="submit" value="Update">Update</button>
                <label class="back"><a href="update.inc.php">Return</a></label>
            </form>
        </div>
    </main>
</body>
</html>