<?php
    include 'config.php';
    $filtervalues = $_GET['food_name'] ?? ' ' ;
    if(isset($_POST['add_to_tab'])){
        $food_name = $_POST['food_name'];
        $price = $_POST['price'];
        $food_image = $_POST['food_image'];
        $category_id = $_POST['category_id'];
        $food_id = $_POST['food_id'];
        $quantity = 1;
    
        
        
    
        $select_tray = mysqli_query($conn, "SELECT * FROM tray WHERE food_name = '$food_name'");
    
        if(mysqli_num_rows($select_tray) > 0){
            echo '<label class="message">food has already been added to tray</label>';
        }else{
            $insert_food = mysqli_query($conn, "INSERT INTO tray (food_name, price, food_image, quantity, food_id) 
            VALUES('$food_name', '$price', '$food_image', '$quantity', '$food_id')");
            echo  '<label class="message">food added to tray successfully</label>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="ln.css"><link rel="icon" href="images/icon.png">
</head>
<body>
<?php
        
 ?>       
<div class='search-container'>
    <form action='' method='get' class='search-form'>
        <input type='text' name='food_name' placeholder='search...' required>
        <button type='submit' name='search-food' class='src-btn'><img src='images/search-icon.png' alt=''></button>
    </form>
    <?php
    $select_rows = mysqli_query($conn, "SELECT * FROM `tray`");
        $row_count = mysqli_num_rows($select_rows);
        ?>
        <a href="tray.php"><div class="tray"><label> Your Tray<span>&nbsp; <?php echo$row_count; ?> &nbsp;</span></label></div></a>
    <div class='search-box'>
<?php
if(isset($_GET['search-food'])){
    function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    $filter = validate($_GET['food_name']);
$check_query = mysqli_query($conn, "SELECT * FROM food  WHERE CONCAT(food_name) LIKE '%$filter%'");
if(mysqli_num_rows($check_query) < 1){
     header("location:search.php?data=No food shown for '$filter' try checking the spelling and try again");
     exit();
     
}else($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $food_name = $row['food_name'];
    $price = $row['price'];
    $food_image = $row['food_image'];
    $category_id = $row['category_id'];
    $food_id = $row['food_id'];
?>
    
    
        <div class='food'> 
        <form action="" method="post">
            
            <img src="img-contain/<?=$row["food_image"]?>">
            <label for="food_name"><?=$row['food_name']?></label><br>
            <label for="price">₦ <?=$row["price"]?></label>
            <input type="hidden" name="food_name" value=" <?php echo $row['food_name']; ?> ">
            <input type="hidden" name="price" value=" <?php echo $row['price']; ?> ">
            <input type="hidden" name="food_image" value="img-contain/<?php echo $row['food_image']; ?> ">
            <input type="hidden" name="category_id" value=" <?php echo $row['category_id']; ?> ">
            <input type="hidden" name="food_id" value=" <?php echo $row['food_id']; ?> ">
            <button name="add_to_tab">Add to tab</button>
    
</form>
           </div>
           

 <?php       
    }
    
    }
     if (isset($_GET['data'])) { ?>
		<p align="center" class="data"><?php echo $_GET['data']; ?></p>
	        <?php } 
     ?>
    </div><div class='close'>
    <button id='close-btn' ><a href="localnut.php">Close search</a></button>
</div>
</div> 
</body>
</html>