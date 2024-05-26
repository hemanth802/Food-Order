<?php

    //Include constants.php file
    include('../config/constants.php');

    //1.get the id of admin to be deleted
    $id = $_GET['id'];

    //2.create sql query to delette admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whethrt the query execute are not
    if($res == TRUE)
    {
        //Query execute successfully and admin delete
        //echo "Admin Deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Delete Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to delete admin
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3.redirect to manage admin page
?>