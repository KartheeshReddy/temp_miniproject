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
    //delete category if del_category is set in address bar
    if(isset($_GET['del_category']))
    {
        $cat_id=$_GET['del_category'];
        $query="delete from categories where cat_id='$cat_id'";
        $query_run=mysqli_query($con,$query);
        $query="delete from items where item_cat_id='$cat_id'";
        $query_run=mysqli_query($con,$query);
        $query="delete from categories where cat_id='$cat_id'";
        $query_run=mysqli_query($con,$query);
        header('location: admin_index.php');
    }
    ?>
    <!-- Categories -->
    <div class="categories my-3 mx-2">
        <h2 class="mx-4">Pick Your Category</h2>
        <!-- Each category -->
        <div class="category">
        

            <?php

            $query = "select * from categories";
            $query_run = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($query_run))
            {
                $image = $row['cat_image'];
                $cat_name = $row['cat_name'];
                $cat_id = $row['cat_id'];
            echo '
            <div onclick="func('.$cat_id.')" id="'.$cat_id.'" class="card mx-2 my-3" style="width: 18rem;">
                <img src="'.$image.'" class="card-img-top" alt="...">
                <i  onclick="delCategoryFunc('.$cat_id.')"class="fas fa-times-circle fa-2x"></i>
                <div class="card-body">
                    <h4 class="card-text">'.$cat_name.'</h4>
                </div>
            </div>';

            }
            ?>
            <div onclick="addCategory()" class="plus-card card mx-2 my-3" style="width: 18rem;">
                <i  type="button"  class="plus-icon fad fa-plus fa-7x"></i>
                
            </div>
            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="plus-icon fad fa-plus fa-7x"></i></button> -->
            <!-- <i  type="button" data-toggle="modal" data-target="#myModal" class="plus-icon fad fa-plus fa-7x"></i> -->
                
        </div>

    </div>
    </div>

    
    

    <script>
    function func(catid) {

        var btn = document.getElementById(catid);

        btn.addEventListener('click', function() {
            window.location.href = `admin_items.php?cat_id=${catid}`;
        })
    }
    //to delete a category
    function delCategoryFunc(catid)
    {
        var btn = document.getElementById(catid);

        btn.addEventListener('click', function() {
            window.location.href = `admin_index.php?del_category=${catid}`;
        })
    }

    function addCategory()
    {
        window.location.href = `admin_category_page.php`;
    }
    </script>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>



</body>

</html>