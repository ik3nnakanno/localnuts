<?php
$conn = mysqli_connect('localhost', 'test', '', 'local_nuts');

if(!$conn){
    echo "connection failed";
}