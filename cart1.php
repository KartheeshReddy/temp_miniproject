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

    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">

    <!-- Link to external js -->
    <!-- <script src="index.js"></script> -->

</head>

<body>


    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <?php 
    // echo $_SESSION["user_id"];
    if (isset($_GET["inc"]) && $_GET["inc"]==true)
    {
        // get item id and increment quantity
        $user_id = $_SESSION["user_id"];
        $item_id = $_GET["item_id"];
        $query = "update cart set quantity = quantity + 1 where item_id = '$item_id' and user_id = '$user_id'";
        $query_run = mysqli_query($con, $query);
        header("Location: cart.php");
        exit();
    }
    if (isset($_GET["dec"]) && $_GET["dec"]==true)
    {
        // get item id and decrement quantity
        $user_id = $_SESSION["user_id"];
        $item_id = $_GET["item_id"];
        $query = "update cart set quantity = quantity - 1 where item_id = '$item_id' and user_id = '$user_id'";
        $query_run = mysqli_query($con, $query);

        // check if quantity is 0, if yes delete from cart
        $query = "delete from cart where quantity = 0";
        $query_run = mysqli_query($con, $query);        

        header("Location: cart.php");
        exit();
    }
    

    ?>


    <div class="container cart-items mt-5">

        <?php 
        $user_id = $_SESSION["user_id"];
        // echo $user_id;
        if (isset($_GET['item_id'])) {
            
            // For category id
            $item_id = $_GET['item_id'];
            $query = "select item_cat_id from items where item_id = '$item_id'";
            $query_run = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($query_run);
            $cat_id = $row['item_cat_id'];

            // inserting into cart (retrieving item id)
            $query = "select item_id, quantity from cart where item_id = '$item_id' and user_id = '$user_id'";
            $query_run = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($query_run);
            
            if ($row == NULL)
            {
                $query = "insert into cart values ('$item_id', 1, '$user_id')";
                $query_run = mysqli_query($con, $query);
            }
            else if ($row["quantity"] == 0)
            {
                $query = "update cart set quantity = quantity + 1 where item_id = '$item_id' and user_id = '$user_id'";
                $query_run = mysqli_query($con, $query);
            }

            header("Location: category.php?cat_id=".$cat_id."&added=true");
            exit();
        }
        $query = "select item_id from cart where user_id = '$user_id'";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) == 0)
        {
            // $isempty = true;
            echo '<center><h1>Your cart is empty</h1></center>';
            exit();
        }
        $bill = 0;
        while ($row = mysqli_fetch_assoc($query_run)) 
        {
            $item_id = $row['item_id'];
            $subquery = "select * from items where item_id = '$item_id'";
            $subquery_run = mysqli_query($con, $subquery);
            $row2 = mysqli_fetch_assoc($subquery_run);
            $item_name = $row2['item_name'];
            $item_image = $row2['item_image'];
            $item_price = $row2['item_price'];

            $subquery = "select quantity from cart where item_id = '$item_id' and user_id = '$user_id'";
            $subquery_run = mysqli_query($con, $subquery);
            $row2 = mysqli_fetch_assoc($subquery_run);
            $item_quantity = $row2["quantity"];
            // if ($item_quantity == 0)
            // {
            //     continue;
            // }
            $bill += $item_price * $item_quantity;

        echo '<div class="cart-item">
            <div class="cart-item-image">
                <img width="150px" src="'.$item_image.'">
            </div>
            <div class="cart-item-name">
                <h4>Item Name: '.$item_name.'</h4>
                <p>Item Price: '.$item_price.'</p>
            </div>
            <div class="cart-item-quantity">
                <a href="cart.php?item_id='.$item_id.'&dec=true" id="itemno-'.$item_id.'" name="cart_inc"><img style="width:15px" src="images/minus.png"></a>
                <span>'.$item_quantity.'</span>
                <a href="cart.php?item_id='.$item_id.'&inc=true" id="itemno-'.$item_id.'" name="cart_dec"><img style="width:15px" src="images/plus.png"></a>
            </div>
            <div class="cart-item-total">
                <p>Total: '.$item_price * $item_quantity.'</p>
            </div>

        </div>';
        }

        // calculating cart total
        // $query = "select item_id from cart";
        // $query_run = mysqli_query($con, $query);
        // $sum = 0;
        // while ($row = mysqli_fetch_assoc($query_run)) {
            
        //     $item_id = $row['item_id'];
        //     // echo $item_id;
        //     $query2 = "select item_price from items where item_id = '$item_id'";
        //     $query_run2 = mysqli_query($con, $query2);
        //     $row2 = mysqli_fetch_assoc($query_run2);
        //     $sum += $row2['item_price'];
        // }
        $_SESSION["bill"] = $bill;
        echo '<h3 style="color: green; float:right;">Total Bill: '.$bill.'</h3>';
        echo '<a href="payment.php">Go to Payment</a>';


        ?>
        <!-- <button style="float:right;" class="btn btn-primary mb-3">Generate Bill</button> -->

    </div>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>


</html>