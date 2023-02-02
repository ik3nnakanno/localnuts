<?php include 'config.php'; 

if(isset($_POST['add_to_tab'])){
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $food_image = $_POST['food_image'];
    $quantity = 1;

    

    $select_tray = mysqli_query($conn, "SELECT * FROM tray WHERE food_name = '$food_name'");

    if(mysqli_num_rows($select_tray) > 0){
        echo '<label class="message">food has already been added to tray</label>';
    }else{
        $insert_food = mysqli_query($conn, "INSERT INTO tray (food_name, price, food_image, quantity) 
        VALUES('$food_name', '$price', '$food_image', '$quantity')");
        echo  '<label class="message">food added to tray successfully</label>';
    }
}
if(isset($_POST['search-click'])){
    header('location: search.php');   
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nigerian Food</title>
    <link rel="stylesheet" href="ln.css"><link rel="icon" href="images/icon.png">
</head>
<body>
<nav class="nigerian">
    <input id="nav-toggle" type="checkbox">
        <a href="localnut.php"><img src="images/logo.png" width="170px" alt="logo" id="logo"></a>
        <?php
        //tray count
        $select_rows = mysqli_query($conn, "SELECT * FROM `tray`");
        $row_count = mysqli_num_rows($select_rows);
        ?>
        <div class="tray"><a href="tray.php"><label>Your Tray<span>&nbsp; <?php echo$row_count; ?> &nbsp;</span></a></label></div>
        
        
        <ul>
            <a href="localnut.php">
                <li>Home</li>
            </a>
            <a href="beverages.php">
                <li>Beverages</li>
            </a>
            <a href="chinesefood.inc.php">
                <li>Chinese</li>
            </a>
            <a href="about.php">
                <li>About</li>
            </a>
            <a href="logout.php">
                <li>Login/Logout</li>
            </a>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>

    <main>
    <section id="food-header">
    <h2>Food Section</h2><label for="sort">Sort Food</label>
    <form action="" method="get" class="sort">
        <div class="select">
            <select name="sort_by" id="sort">
                <option value="Popularity" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == "Popularity"){echo "Selected";} ?> >Popularity</option>
                <option value="High+to+Low" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == "High+to+Low"){echo "Selected";} ?> >Price(High to Low)</option>
                <option value="Low+to+High" <?php if(isset($_GET['sort_by']) && $_GET['sort_by'] == "Low+to+High"){echo "Selected";} ?> >Price(Low to High)</option>
            </select>
        </div>
        <button type="submit">Sort</button>
        
    </form><br>
    <form action="" method="post"><button type="submit" name="search-click"><img src="images/search-icon.png" alt=""></button></form>
    

    </section>
    <section id="foods">
    <?php


    //Sort food start
    $sort_option = "";

    if(isset($_GET['sort_by']))

    if($_GET['sort_by'] == "High+to+Low")
    {
        $sort_option = "ORDER BY price DESC";
    }elseif($_GET['sort_by'] == "Low+to+High"){
        $sort_option = "ORDER BY price ASC";
    }elseif($_GET['sort_by'] == "Popularity"){
        $sort_option =  "ORDER BY popularity asc";
    }

    
    $query = "SELECT * FROM food  WHERE category_id = 7 $sort_option";
    $result = mysqli_query($conn, $query) or die("Image QUERY FAILED".MYSQLI_ERROR($conn));
    
	while($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
            $food_name = $item['food_name'];
            $price = $item['price'];
            ?>
    <div class="food"> 
           <form action="" method="post">
            
                    <img src="img-contain/<?=$item["food_image"]?>">
                    <label for="food_name"><?=$item['food_name']?></label><br>
                    <label for="price">₦ <?=$item["price"]?></label>
                    <input type="hidden" name="food_name" value=" <?php echo $item['food_name']; ?> ">
                    <input type="hidden" name="price" value=" <?php echo $item['price']; ?> ">
                    <input type="hidden" name="food_image" value="img-contain/<?php echo $item['food_image']; ?> ">
                    <input type="hidden" name="category_id" value=" <?php echo $item['category_id']; ?> ">
                    <input type="hidden" name="food_id" value=" <?php echo $item['food_id']; ?> ">
                    <button name="add_to_tab">Add to tab</button>
            
        </form>
           </div> 
           <?php
        }

     ?>
    </section>
    </main>
    <footer id="foot">
        <div class="contact">
            <h3>Contact us</h3>
            +234 XXX XXXX XXX
            <br>
            +234 XXX XXXX XXX<br><br>
            <a href="mailto:@domain@gmail.com"><img src="images/mail.png" alt="email us">&nbsp;Mail us</a><br><br>
            <img src="images/location.png" width="30px" height="30px" alt="">&nbsp;&nbsp;<label>Plot 5 Kado District,
                Abuja</label>
        </div>
        <div class="lgimg">
            <img src="images/insta.png" width="30px" height="30px" alt="ig"><a href=""><span
                    class="a1">@localnuts</span></a>&nbsp;&nbsp;&nbsp;
            <img src="images/fb.png" width="30px" height="30px" alt="fb"><a href=""><span class="a2">local
                    nuts</span></a>&nbsp;&nbsp;&nbsp;
            <img src="images/twitter.png" width="30px" height="30px" alt="twitter"><a href=""><span
                    class="a3">@local_nuts</span></a>&nbsp;&nbsp;&nbsp;

        </div>


        <a href="#">Back to top</a> <br>
        &copy; <?php echo date("Y"); ?>

    </footer>
</body>
</html>