<?php
    //include constant.php for siteurl
    include('../config/constants.php');
    //1. Destroy the session
    session_destroy(); //unsets $_SESSION['user']

    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>