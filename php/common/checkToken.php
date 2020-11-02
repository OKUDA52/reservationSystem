<?php

if (isset($_POST["form_token"]) 
 && $_POST["form_token"] === $_SESSION['tmp_token']) {
       
 } else {
    header('Location:../page/errorPage.php');
    die();
 }
?>