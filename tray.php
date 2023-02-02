<?php
    include 'config.php';

    session_start();
    
    $username = $_SESSION['username'] ?? 'USER';

    if(isset($_POST['update_update_btn'])){
        $update_value = $_POST['update_quantity'];
        $update_id = $_POST['quantity_id'];
        $update_quantity_query = mysqli_query($conn, "UPDATE `tray` SET quantity = '$update_value' WHERE tray_id = '$update_id'");
        if($update_quantity_query){
           header('location:tray.php');
        };
     };
     
     if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `tray` WHERE tray_id = '$remove_id'");
        header('location:tray.php');
     };
     
     if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `tray`");
        header('location:tray.php');
     }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tray</title>
    <link rel="stylesheet" href="tray.css"><link rel="icon" href="images/icon.png">
</head>
<body>
    <nav class="tray-nav">
    <a href="localnut.php"><img src="images/logo.png" width="170px" alt="logo" id="logo"></a>
        <label>Welcome <?php echo htmlspecialchars($username);  ?></label>
    <?php
        $select_rows = mysqli_query($conn, "SELECT * FROM `tray`");
        $row_count = mysqli_num_rows($select_rows);
        ?>
        <label>Tray count<span>&nbsp; <?php echo$row_count; ?> &nbsp;</span></label>
        
        
    </nav>

<section>
        
<main>
<?php
  $query = "SELECT * FROM tray";
  $result = mysqli_query($conn, $query) or die("Image QUERY FAILED".MYSQLI_ERROR($conn));
  $grand_total = 0;
  while($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
  {
          ?>
          <div class="tray">
                <div class="tray-box">
                  <img src="<?=$item["food_image"]?>" alt="<?php echo $item['food_name']; ?>">
                  <label for="food_name"><?=$item['food_name']?></label>&nbsp;&nbsp;&nbsp;
                    <label for="price">₦<?php echo (int)($item['price']); ?></label>
            </div>
                <div class="tray-box">   
                    <form action="" method="post">
                        <input type="hidden" name="quantity_id"  value="<?php echo $item['tray_id']; ?>" >
                        <label for="">quantity</label><br>
                        <input type="number" name="update_quantity" min="1"  value="<?php echo $item['quantity']; ?>"><br>
                        <button type="submit"  name="update_update_btn" class="upd-btn">Update</button>
                        <label for="">Total price: ₦<?php echo $sub_total = (int)($item['price'] * $item['quantity']); ?></label><br>
                        <button class="del-btn"><a href="tray.php?remove=<?php echo $item['tray_id']; ?>" onclick="return confirm('remove <?=$item['food_name']?> from tray?')" > Remove</a></button>
                    </form> 
                </div>
         </div>


            <?php
                (int)$grand_total += (int)$sub_total;  
            }
        $check_query = mysqli_query($conn, "SELECT * FROM `tray`");
   if(mysqli_num_rows($check_query) < 1){
        echo '<h2 align="center">Tray is empty</h2>';
   }else{}
            ?> 
    </main> </section>
<div class="tray-btm">
            
    <button class="upd-btn"><a href="localnut.php"  style="margin-top: 0;">Continue shopping</a></button>
   <label for="">Sub total:&nbsp;&nbsp;&nbsp; ₦<?php echo $grand_total; ?></label>
   <button class="del-btn"><a href="tray.php?delete_all" onclick="return confirm('are you sure you want to delete all?');">Delete all</a> </button>
    <button class="upd-btn"><a href="checkout.php">Proceed to checkout</a></button>
</div>           
    
    

</body>
</html>