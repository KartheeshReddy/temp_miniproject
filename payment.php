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

    <!-- <h1>Payment Page</h1> -->

    <?php 
        $user_id = $_SESSION["user_id"];
        $user_name = $_SESSION["username"];
        $query = "select * from cart where user_id = '$user_id'";
        //$items = "";
        $query_run = mysqli_query($con, $query);
        $order_id = rand();
        $bill = $_SESSION["bill"];
        date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );
// echo $currentTime;
        while ($row = mysqli_fetch_assoc($query_run))
        {
            $item_id = $row["item_id"];
            $quantity=$row['quantity'];

            //echo $item_id." ".$quantity."\n";
            $query2 = "select item_name from items where item_id = '$item_id'";
            $query_run2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_assoc($query_run2);
            $item_name = $row2["item_name"];
            //$items = $items . $item_name . " " . $row["quantity"] . "\n";
            $query3 = "insert into orders values ('$currentTime','$order_id', '$user_name', '$item_name','$quantity', '$bill','')";
            $query_run3 = mysqli_query($con, $query3);
        }
        
        

        // clear the cart
        $query = "delete from cart where user_id = '$user_id'";
        $query_run = mysqli_query($con, $query);

        

        echo '<center><h1>Your order has been placed with order id: '. $order_id .'</h1></center>';
    ?>



</body>
</html>