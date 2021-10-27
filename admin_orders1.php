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
    <!-- <link rel="stylesheet" href="index.css"> -->

    <!-- Link to external js -->
    <!-- <script src="index.js"></script> -->
    <style>
        table{
            text-align:center;
            /* width: 100%; */
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

            $query="update orders set status='$status' where order_id='$order_id'";
            $query_run=mysqli_query($con,$query);
            //header('location:admin_orders.php');
        }
    ?>

    <center><h1>Your Orders</h1></center>
    <div id="orders-table">
    <table align="center">
    <tr>
        <th>Username</th>
        <th>Date-Time</th>
        <th>Order ID</th>
        <th>Item</th>
        <th>Quantity</th>
        <th>Total Bill</th>
        <th colspan='3'>Keep status<th>
        <th>Status</th>
    </tr>
    <?php
    //$user_name=$_SESSION['username'];
    $orders_array = array();
    

    //$query="select * from orders where user_name='$user_name'";
    $query="select * from orders";
    $query_run=mysqli_query($con,$query);
    

    while($row=mysqli_fetch_assoc($query_run))
    {
        $user_name=$row['user_name'];
        $order_id=$row['order_id'];
        $order_id_s = (string)$order_id . "s";
        $order_id_o = (string)$order_id . "o";
        $order_id_d = (string)$order_id . "d";
        
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
            <td rowspan='$no_of_rows'>".$user_name."</td>
            <td rowspan='$no_of_rows'>".$currentTime."</td>
            <td rowspan='$no_of_rows'>".$order_id."</td>
            <td>".$item."</td>
            <td>".$quantity."</td>
            <td rowspan='$no_of_rows'><i class='fas fa-rupee-sign'></i>".$bill."</td>
            <td rowspan='$no_of_rows'><button type='button' name='shipped' id='$order_id_s' onclick='changeStatus(id,name,".$order_id_s.")' class='btn btn-outline-primary'>Shipped</button></td>
            <td rowspan='$no_of_rows'><button type='button' name='onTheWay' id='$order_id_o' onclick='changeStatus(id,name,".$order_id_o.")' class='btn btn-outline-primary'>On The Way</button></td>
            <td rowspan='$no_of_rows'><button type='button' name='delivered' id='$order_id_d' onclick='changeStatus(id,name,".$order_id_d.")' class='btn btn-outline-primary'>Delivered</button></td>
            <td rowspan='$no_of_rows'>".$status."</td>
        </tr>";
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


    <script>
        
    function changeStatus(id,status,order_id) {
        
        // var modified_order_id = order_id.substring(0, order_id.length - 1);
        console.log(status+" "+order_id);
        var btn = document.getElementById(id);
        btn.addEventListener('click', function() {
            // window.location.href = `admin_orders.php?changeStatus=true&order_id=${modified_order_id}&status=${status}`;
        })
    }
    </script>
</body>

</html>

<!-- 
<td rowspan='$no_of_rows'><button type='button' name='shipped' id=".$order_id." onclick='changeStatus(id,name,".$order_id.")' class='btn btn-outline-primary'>Shipped</button></td>
            <td rowspan='$no_of_rows'><button type='button' name='onTheWay' id=".$order_id." onclick='changeStatus(id,name,".$order_id.")' class='btn btn-outline-secondary'>On The Way</button></td>
            <td rowspan='$no_of_rows'><button type='button' name='delivered' id=".$order_id." onclick='changeStatus(id,name,".$order_id.")' class='btn btn-outline-success'>Delivered</button></td>
            -->