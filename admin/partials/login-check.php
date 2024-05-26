<?php
    //AUTHORIZATION - Acc Control
    //check whether the user is login or not
    if(!isset($_SESSION['user'])) //If User session is not set
    {
        $_SESSION['no-login-message'] = "<div class='error check-center'>Please login to access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>