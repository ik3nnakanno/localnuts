<?php include 'config.php'; 
 session_start();
 $username = $_SESSION['ausername'];
 
 if(!isset($_SESSION['ausername'])){
     header("Location: login.admin.php?error=You're not logged in");
 }
if(isset($_POST['update_food'])){
    $food_id = $_POST['food_id'];
    $updated_name = $_POST['updated_name'];
    $updated_price = $_POST['updated_price'];
    $category_id = $_POST['category_id'];
    $updated_image = $_FILES['updated_image']['name'];
    $updated_image_tmp_name = $_FILES['updated_image']['tmp_name'];
    $updated_image_folder = 'img-contain/'.$updated_image;
 
    $update_query = mysqli_query($conn, "UPDATE `food` SET food_name = '$updated_name', price = '$updated_price', food_image = '$updated_image' WHERE food_id = '$food_id'");
 
    if($update_query){
       move_uploaded_file($updated_image_tmp_name, $updated_image_folder);
       echo 'product updated succesfully';
       header('location:update_nig.inc.php');
    }else{
       echo 'product could not be updated';
       header('location:chef.php');
    }
 
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
            <a href=""><li class="active">Nigerian
                <ul class="dropdown">
                    <a href="update_chi.inc.php"><li>Chinese</li></a>
                    <a href="update_norm.inc.php"><li>Normal</li></a>
                    <a href="update_drinks.inc.php"><li>Drinks</li></a>
                </ul>
            </li></a>
            <a href="sales.inc.php"><li>Sales History</li></a>
            <a href="logout.inc.php"><li>Logout</li></a>
        </ul>
        <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `food`WHERE category_id = 7");
    if(mysqli_num_rows($select_products) > 0){
       while($row = mysqli_fetch_assoc($select_products)){
        $food_name = $row['food_name'];
        $price = $row['price'];
        $food_id = $row['food_id'];
        ?>
        <form>
                <label for="food_name"><?=$row['food_name']?></label><br>   
                <label for="price" value="">₦ <?=$row["price"]?></label><br>
                <input type="hidden"  value="<?php echo $row['food_id']; ?>">
                <input type="hidden" value="<?php echo $row['category_id']; ?>">
                <img src="img-contain/<?=$row["food_image"]?>" width="100%" height="180px"><br>
                <button option-btn><a href="update_nig.inc.php?id=<?php echo $row['food_id']; ?>">Update</a></button>
                <button class="dlt" onclick="return confirm('are your sure you want to delete this?');"><a href="delete.php?id=<?php echo $row['food_id']; ?>">Delete</a></button>
        </form>
        <?php  
    }  }
    ?>
         
<div class="edit-form-container">  
    <?php
    if(isset($_GET['id'])){
      $edit_id = $_GET['id'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `food` WHERE food_id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

        <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_edit['food_image']; ?>" height="200" alt="">
            <input type="hidden" name="food_id" value="<?php echo $fetch_edit['food_id']; ?>">
            <input type="hidden" name="category_id" value="<?php echo $fetch_edit['category_id']; ?>">
            <label for="food_name">Food name</label>
            <input type="text" class="box" required name="updated_name" value="<?php echo $fetch_edit['food_name']; ?>" placeholder="<?php echo $fetch_edit['food_name']; ?>">
            <label for="price">Price</label>
            <input type="number" min="0" class="box" required name="updated_price" value="<?php echo $fetch_edit['price']; ?>"placeholder="<?php echo $fetch_edit['price']; ?>">
            <input type="file" class="box" required name="updated_image" accept="image/png, image/jpg, image/jpeg">
            <button type="submit" value="" name="update_food" class="">Update</button>
            <button type="reset" value="" id="close-edit" class="del-btn">Cancel</button>
        </form>

    
    <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>
</div>
    <script>
        document.querySelector('#close-edit').onclick = () => {
        document.querySelector('.edit-form-container').style.display = 'none';
        window.location.href = 'update_nig.inc.php';
        };
    </script>