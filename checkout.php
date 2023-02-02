<?php
include 'config.php';
session_start();
$username = $_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location: login.php?error=You're not logged in");
}
$check_query = mysqli_query($conn, "SELECT * FROM `tray`");
   if(mysqli_num_rows($check_query) < 1){
        header('location: tray.php');
   }else{}
if(isset($_POST['order'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);
    $method = validate($_POST['method']);
    if (empty($phone)) {
        header("Location: checkout.php?error=phone number is required");
            exit();
    }elseif (empty($address)) {
        header("Location: checkout.php?error=address is required");
            exit();  
     }else {
    $tray_query = mysqli_query($conn, "SELECT * FROM `tray`");
   $price_total = 0;
   if(mysqli_num_rows($tray_query) > 0){
      while($product_item = mysqli_fetch_assoc($tray_query)){
         $product_name[] = $product_item['food_name'] .' ('. $product_item['quantity'] .') ';
         $product_price = (int)($product_item['price'] * (int)$product_item['quantity']);
         (int)$price_total += (int)$product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(first_name, last_name, phone, email, method, address, username, total_product, total_price) VALUES('$first_name', '$last_name','$phone','$email','$method', '$address', '$username', '$total_product','$price_total')") or die('query failed');
   if($tray_query && $detail_query){
    echo "
    <div class='order-message-container'>
    <div class='message-container'>
       <h3>Your order has been placed😁</h3>
       <div class='order-detail'>
          <span>".$total_product."</span>
          <span class='total'> total : ₦".$price_total."  </span>
       </div>
       <div class='customer-details'>
          <p> Name <br> <span>".$first_name." ".$last_name."</span> </p><hr>
          <p> Mobile number <br> <span>".$phone."</span> </p><hr>
          <p> Email <br> <span>".$email."</span> </p> <hr>
          <p> Delivery Address <br> <span>".$address."</span> </p><hr>
          <p> Method of payment <br> <span>".$method."</span> </p><hr>
       </div>
          <button class='regg-btn'><a href='localnut.php' class='btn'>continue shopping</a></button>
       </div>
    </div>
    "; }
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="images/icon.png">
</head>
<body>
    <?php
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query) or die('error processing request');
        while($row=mysqli_fetch_array($result)){
?>
    
    <form action="" method="post">
    <?php if (isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
    <div class="display-order">
      <?php
         $select_tray = mysqli_query($conn, "SELECT * FROM `tray`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_tray) > 0){
            while($fetch_tray = mysqli_fetch_assoc($select_tray)){
            $total_price = (int)($fetch_tray['price'] * $fetch_tray['quantity']);
            (int)$grand_total = (int)$total += (int)$total_price;
      ?>
      <span><?= $fetch_tray['food_name']; ?>(<?= $fetch_tray['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your tray is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> Total price: ₦ <?= $grand_total; ?> </span>
   </div>
        <div class="check">
            <label for="">Fullname: <?=$row['first_name'];?> <?=$row['last_name'];?></label>
            <input type="hidden" name="first_name" value="<?=$row['first_name'];?>">
            <input type="hidden" name="last_name" value="<?=$row['last_name'];?>">
        </div>
        <div class="check">
            <label for="">Email: <?=$row['email'];?></label>
            <input type="hidden" name="email" value="<?=$row['email'];?>">
        </div>
        <div class="check">
            <label for="">Phone number</label>
            <input type="number" placeholder="your mobile number" name="phone" value="">
        </div>
        <div class="check">
            <label for="">Detailed address</label>
            <textarea name="address" placeholder="e.g. flat 23, Street name, Abuja" cols="28" rows="3"></textarea>
        </div>
        <div class="check">
        <label for="">Payment method</label><br>
            <select name="method">
               <option value="pay on delivery" selected>pay on devlivery</option>
               <option value="credit card" name="credit_card">credit card</option>
               <option value="paypal">paypal</option>
            </select>
            </div>
        <button type="submit" name="order" class="reg-btn">Order now</button>
    </form>
  <?php  
    }
    ?>
</body>
</html>