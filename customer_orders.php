<?php

    // if(!isset($_SESSION["user_loggedin"]))
    // {
    //     header("location:login.php");
    // }

?>
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Change font -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@500&display=swap" rel="stylesheet"> -->

    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">

    <!-- Link to external js -->
    <!-- <script src="index.js"></script> -->
    <style>
        table{
            text-align:center;
             width: 100%; 
        }
        table,td,th,tr{
            border: 2px solid;
        }
        #orders-table{
            /* width: 50%; */
            margin: auto;
        }
        /* tr:nth-child(even){background-color: cyan;}
        tr:nth-child(odd){background-color: violet;} */
    </style>
</head>

<body>


    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <?php
        if(isset($_GET['changeStatus']))
        {
            
            $order_id=$_GET['order_id'];
            $status=$_GET['status'];

            echo $order_id,$status;

            $query="update orders set status='$status' where order_id='$order_id' order by date_time desc";
            $query_run=mysqli_query($con,$query);
            header('location:customer_orders.php');
        }
    ?>

    <center><h1>Your Orders</h1></center>
    <div id="orders-table">
    <table align="center">
    <tr>
        <th>Date-Time</th>
        <th>Order ID</th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Total Bill</th>
        
        <th>Status</th>
    </tr>
    <?php
    $user_name=$_SESSION['username'];
    $orders_array = array();
    

    $query="select * from orders where user_name='$user_name'";
    $query_run=mysqli_query($con,$query);
    

    while($row=mysqli_fetch_assoc($query_run))
    {
        $order_id=$row['order_id'];
        $item=$row['item'];
        $quantity=$row['quantity'];
        $bill=$row['total_bill'];
        $currentTime=$row['date_time'];
        $status=$row['status'];
        $query1="select count(*) as cnt from orders group by order_id having order_id='$order_id'";
        $query_run1=mysqli_query($con,$query1);
        $row1=mysqli_fetch_assoc($query_run1);
        $no_of_rows=$row1['cnt'];


        
        if (!isset($orders_array[$order_id]))
        {
            $orders_array[$order_id] = 1;
            echo "<tr>
            <td rowspan='$no_of_rows'>".$currentTime."</td>
            <td rowspan='$no_of_rows'>".$order_id."</td>
            <td>".$item."</td>
            <td>".$quantity."</td>
            <td rowspan='$no_of_rows'><i class='fas fa-rupee-sign'></i>".$bill."</td> ";
            if($status=="shipped")
            {
                echo "<td rowspan='$no_of_rows' ><b style='color:CornflowerBlue;'>Shipped</b></td>";
            }
            elseif($status=="onTheWay")
            {
                echo "<td rowspan='$no_of_rows'><b style='color:Orchid;'>On The Way</b></td>";
            }
            elseif($status=="delivered")
            {
                echo "<td rowspan='$no_of_rows'><b style='color:green;'>Delivered</b></td>";
            }
            else
                echo "<td rowspan='$no_of_rows'></td>";
        echo "</tr>";
        }
        else 
        {
            echo "<tr>
            <td>".$item."</td>
            <td>".$quantity."</td>
            </tr>";
        }

        
        // echo "<tr><td >".$currentTime."</td><td>".$order_id."</td><td>".$item."</td><td>".$quantity."</td><td>".$bill."</td></tr>";
        
    }
    echo "</table>";
    
    ?>
    </div>
    <br>
    <h1 align="center">Rate & Review items that you've bought!</h1>
    <br>
    <br>
    <?php
    $user_name=$_SESSION['username'];
    $query="select distinct(item) from orders where user_name='$user_name'";
    $query_run=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($query_run))
    {
        $item_name=$row['item'];
        //echo $item_name;
        $query1="select * from items where item_name='$item_name'";
        $query_run1=mysqli_query($con,$query1);
        $row1=mysqli_fetch_assoc($query_run1);
        
        $item_image=$row1['item_image'];
    ?>
    <div class="cart-item">
            <div class="cart-item-image">
                <img width="150px" src="<?php echo $item_image; ?>">
            </div>
            <div class="cart-item-name">
                <h4>Item Name: <?php echo $item_name; ?></h4>
                
            </div>
            <div class="cart-item-total">
                <?php
                    $query2="select * from rating where user_name='$user_name' and item_name='$item_name'";
                    $query_run2=mysqli_query($con,$query2);
                    $row2=mysqli_fetch_assoc($query_run2);
                    if($row2==null)
                    {
                ?>
                <button type="button" class="btn btn-warning" onclick="rate_item('<?php echo $item_name; ?>')">Rate & Review Item</button>
                <?php
                    }
                    else
                    {
                        $rating=$row2['rating'];
                        $review=$row2['review'];
                        echo "Your rating: $rating<i style='color:gold' class='fas fa-star'></i> <br> Your review: $review";
                    }
                ?>
            
            </div>

        </div>
    <?php 
    }
    ?>
<!-- <div class="cart-item-quantity">
                <a href="cart.php?item_id='.$item_id.'&dec=true" id="itemno-'.$item_id.'" name="cart_inc"><img style="width:15px" src="images/minus.png"></a>
                <span>'.$item_quantity.'</span>
                <a href="cart.php?item_id='.$item_id.'&inc=true" id="itemno-'.$item_id.'" name="cart_dec"><img style="width:15px" src="images/plus.png"></a>
            </div>
            <div class="cart-item-total">
                <p>Total: '.$item_price * $item_quantity.'</p>
            </div> -->





    <script>
        
    function changeStatus(id,status,order_id) {
        //console.log(status+" "+order_id);
        var btn = document.getElementById(id);
        btn.addEventListener('click', function() {
            window.location.href = `customer_orders.php?changeStatus=true&order_id=${order_id}&status=${status}`;
        })
    }

    function rate_item(item_name) {
        console.log(item_name);
        window.location.href = `customer_rating.php?item_name=${item_name}`;
        
    }
    </script>
    <?php include 'partials/scripts.php'; ?>
</body>

</html>