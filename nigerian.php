<?php
include "config.php";

if(isset($_POST['submit']) && isset($_POST['food_name']) && isset($_FILES['food-img']) && isset($_POST['price'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $food_name = validate($_POST['food_name']);
    $price = validate($_POST['price']);
    $category_id = 7;

    $img_name = $_FILES['food-img']['name'];
     $img_size = $_FILES['food-img']['size'];
     $tmp_name = $_FILES['food-img']['tmp_name'];
     $error = $_FILES['food-img']['error'];
    
     $query = "SELECT food_name from food where food_name = '$food_name' ";

     $result = mysqli_query($conn, $query) or die("USER QUERY FAILED".mysqli_error($conn));
     
     if(mysqli_num_rows($result) > 0)
     {
     
        header("Location: nigerian.inc.php?error=Food name already exist!");
        exit();
     
     }

     if (empty($food_name)) {
        header("Location: nigerian.inc.php?error=Food name is required");
            exit();
    }elseif (empty($price)) {
        header("Location: nigerian.inc.php?error=Pricing is required");
            exit();
    }else {
                 
    }
     
     if ($error === 0) {
        if ($img_size > 513024){
            header("Location: nigerian.inc.php?error=File too large  > 512kb");
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

            $query = "INSERT INTO food (food_name, price, food_image, category_id) " . "VALUES('$food_name', '$price', '$new_img_name', '$category_id')";
                
            $result = mysqli_query($conn, $query) or die("Operation failed".MYSQLI_ERROR($conn)); 
            header("Location: nigerian.inc.php?success=Upload Successful"); 
        }else{
            header("Location: nigerian.inc.php?error=You can't upload files of this type");
            exit();
        }

    }
     }else{
        header("Location: nigerian.inc.php?error=unknown error occured!");
            exit();
     }
}
