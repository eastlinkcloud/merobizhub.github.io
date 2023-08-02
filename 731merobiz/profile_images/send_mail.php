<?php

if(isset($_POST) && !empty($_POST)){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
 $status=mail($email,$name,$message);   
 if($status){
     header("Location:../index.php");
 }
}

?>