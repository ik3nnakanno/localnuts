<?php
include 'config.php';

if(isset($_GET['id'])){
    $food_id= $_GET['id'];

    $query = "DELETE from food WHERE food_id = $food_id";
    $result = mysqli_query($conn, $query);
    if($result){
        header("Location: update.inc.php?message=deleted succesfully");
    }else{
        die(MYSQLI_ERROR($conn));
    }
 
}