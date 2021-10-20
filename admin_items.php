<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Change font
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@500&display=swap" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="admin_index.css">
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <?php
        if(isset($_GET['del_item']))
        {
            $item_id=$_GET['del_item'];
            $cat_id=$_GET['cat_id'];
            echo $cat_id;
            $query="delete from items where item_id='$item_id'";
            $query_run=mysqli_query($con,$query);
            $query="delete from cart where item_id='$item_id'";
            $query_run=mysqli_query($con,$query);
            header("location: admin_items.php?cat_id=".$cat_id);
        }
    ?>
    <div class="cat-items my-3 mx-2">

        <?php 
        $cat_id = $_GET["cat_id"];
        $query = "select cat_name from categories where cat_id = '$cat_id'";
        $query_run = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($query_run);
        $cat_name = $row['cat_name'];

        echo '<h2 class="mx-4">'.$cat_name.'</h2>';
        
        ?>
        <div class="items">

            <?php
            
            $query = "select * from items where item_cat_id = '$cat_id'";
            $query_run = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($query_run))
            {
                $image = $row['item_image'];
                $item_name = $row['item_name'];
                $price = $row['item_price'];
                $item_id = $row['item_id'];
                $query1="select * from rating where item_id='$item_id'";
                $query_run1=mysqli_query($con,$query1);
                $row1=mysqli_fetch_assoc($query_run1);
                if($row1==null)
                    $rating=0;
                else
                    $rating=$row1['rating'];

            echo '
            <div class="item card mx-2 my-3" style="width: 18rem;">
                <img src="'.$image.'" class="card-img-top" alt="...">
                <i  id="cross-'.$item_id.'" onclick="delItemFunc('.$cat_id.','.$item_id.')"class="fas fa-times-circle fa-2x"></i>
                <div class="card-body">
                    <div class="item-name">
                        <h5 class="card-title">'.$item_name.'</h5>
                        <h5><i class="fa fa-inr" aria-hidden="true"></i> '.$price.'</h5>
                        <span>
                        '.$rating.'<i class="fas fa-star" style="color:gold;"></i>
                        <span>
                    </div>
                    <button id="item-'.$item_id.'" onclick="makeChanges('.$item_id.')" class="btn btn-secondary cart-btn" disabled>Make Changes</button>
                </div>
            </div>';
            }
            

           //add an item 
            echo '
           <div onclick="addItem('.$cat_id.')" class="plus-card card mx-2 my-3" style="width: 18rem;">
                <i  type="button"  class="plus-icon fad fa-plus fa-7x"></i>
                
            </div> ';
            ?>
        </div>
    </div>


    <script>
    function makeChanges(item_id) {
        
        window.location.href = `admin_items.php?cat_id=${catid}?del_item=${item_id}`;
        
    }
    function delItemFunc(catid,item_id){
        var btn = document.getElementById("cross-" + item_id);
        btn.addEventListener('click', function() {
            window.location.href = `admin_items.php?cat_id=${catid}&del_item=${item_id}`;
        })
    }
    function addItem(catid){
        
            window.location.href = `admin_item_page.php?cat_id=${catid}`;
        
    }
    </script>

    <?php
    if (isset($_GET['added'])) {
        echo '<script>alert("Your item has been added")</script>';
    }
    ?>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html>