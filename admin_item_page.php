<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery | Home</title>

   
  

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


    <!-- Change font -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@500&display=swap" rel="stylesheet"> -->

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="admin_index.css">
    <!-- Link to external js -->
    <!-- <script src="index.js"></script> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>
    
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <?php
        $cat_id=$_GET['cat_id'];
        $query="select cat_name from categories where cat_id='$cat_id'";
        $query_run=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($query_run);
        $cat_name=$row['cat_name'];

        echo "<h1>Add an item for $cat_name</h1>";
    ?>
    
    <form action="" method="POST" enctype="multipart/form-data">
        Item Name: <input type="text" name="item-name" required><br><br>
        Item Price: <input type="text" name="item-price" required><br><br>
        Upload an image: <input type="file" name="fileToUpload" accept=".jpg,.jpeg,.png" required><br>
        <input type="submit" name="add-item-btn" class="btn btn-primary">


        
    </form>
    <?php
        if(isset($_POST['add-item-btn']))
        {
            $item_name=$_POST['item-name'];
            $item_price=$_POST['item-price'];
            $file_name=$_FILES['fileToUpload']['name'];
            $file_temp=$_FILES['fileToUpload']['tmp_name'];
            $file_size=$_FILES['fileToUpload']['size'];
            $directory='images/';
            $target_file=$directory.$file_name;

            move_uploaded_file($file_temp,$target_file);
            
            $query="insert into items(item_name,item_price,item_cat_id,item_image) values('$item_name','$item_price','$cat_id','$target_file')";
            $query_run=mysqli_query($con,$query);
            //echo $cat_id;
            header("location: admin_items.php?cat_id=".$cat_id."");
        }
        
        ?>


    
    </body>

</html>