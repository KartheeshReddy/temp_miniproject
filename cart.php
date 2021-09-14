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

    <!-- Link to external js -->
    <!-- <script src="index.js"></script> -->

</head>

<body>


    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <div class="container cart-items mt-5">

        <?php 

        if (isset($_GET['item_id'])) {
            
            // For category id
            $item_id = $_GET['item_id'];
            $query = "select item_cat_id from items where item_id = '$item_id'";
            $query_run = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($query_run);
            $cat_id = $row['item_cat_id'];

            // inserting into cart (retrieving item id)
            $query = "select item_id from cart where item_id = '$item_id'";
            $query_run = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run) != 1){
                $query = "insert into cart values ('$item_id')";
                $query_run = mysqli_query($con, $query);
            }


            header("Location: category.php?cat_id=".$cat_id."&added=true");
            exit();
        }
        $query = "select item_id from cart";
        $query_run = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) 
        {
            $item_id = $row['item_id'];
            $subquery = "select * from items where item_id = '$item_id'";
            $subquery_run = mysqli_query($con, $subquery);
            $row2 = mysqli_fetch_assoc($subquery_run);
            $item_name = $row2['item_name'];
            $item_image = $row2['item_image'];
            $item_price = $row2['item_price'];
        echo '<div class="cart-item">
            <div class="cart-item-image">
                <img width="150px" src="'.$item_image.'">
            </div>
            <div class="cart-item-name">
                <h4>Item Name: '.$item_name.'</h4>
                <p>Item Price: '.$item_price.'</p>
            </div>
            <div class="cart-item-quantity">
                <p>Quantity: 1</p>
            </div>
            <div class="cart-item-total">
                <p>Total: '.$item_price.'</p>
            </div>
        </div>';
        }

        // calculating cart total
        $query = "select item_id from cart";
        $query_run = mysqli_query($con, $query);
        $sum = 0;
        while ($row = mysqli_fetch_assoc($query_run)) {
            
            $item_id = $row['item_id'];
            // echo $item_id;
            $query2 = "select item_price from items where item_id = '$item_id'";
            $query_run2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_assoc($query_run2);
            $sum += $row2['item_price'];
        }
        
        echo '<h3 style="color: green; float:right;">Total Bill: '.$sum.'</h3>';


        ?>
        <!-- <button style="float:right;" class="btn btn-primary mb-3">Generate Bill</button> -->

    </div>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>


</html>