<?php

include 'partials/_dbconnect.php';
require 'partials/_session.php';
$user =  $_SESSION['username'];
$sql = "delete from notes where username = $user;";
$result = mysqli_query($conn,$sql);
if($result){
    header("location: index.php");
}
else{
    echo "sorry some errer ocupie plzz try after some time";
}






?>