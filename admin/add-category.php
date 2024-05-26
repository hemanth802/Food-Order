<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
            
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";

                    $title = $_POST['title'];

                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //Set Default value
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        //Set Default value
                        $active = "No";
                    }

                    //print_r($_FILES['image']);

                    //die(); //break the code

                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        $image_name = $_FILES['image']['name'];

                        //upload image only image is selected
                        if($image_name != "")
                        {

                            //Auto Rename our image
                            //Get the Extension of our image(jpg,png,etc) e.g. "specialfood1.png"
                            $ext = end(explode('.', $image_name));

                            //Rename the image
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. Food_Category_834.jpg


                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path ="../images/category/".$image_name;

                            //Finally upload image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                                header('location:'.SITEURL.'admin/add-category.php');

                                die();
                            }
                        }
                    }
                    else
                    {
                        //Don't upload image and set image_name value as blank
                        $image_name="";
                    }

                    //create sql query to insert category in DB
                    $sql = "INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                            ";

                            $res = mysqli_query($conn, $sql);

                            if($res==true)
                            {
                                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                            }
                            else
                            {
                                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                            }
                }
            ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>