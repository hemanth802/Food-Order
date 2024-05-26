<?php
    //include constants file
    include('../config/constants.php');

    //echo "Delete Page";
    //check whether the id and image_name value is set are not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is aviable
        if($image_name != "")
        {
            //image is available.so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error msg and stop the process
            if($remove==false)
            {
                //set the session msg
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to category page with msg
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //Delete data from database
        //sql query delete data
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from DB or not
        if($res==true)
        {
            //Set success
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail
            $_SESSION['delete'] = "<div class='error'>Category Deleted Failed.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>