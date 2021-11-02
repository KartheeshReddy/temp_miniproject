<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="admin_dashboard.css">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>
    
  </head>
<body>
    <?php //include 'sidebar.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>


  <?php
    $query="select count(*) as cnt from users";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $customers=$row['cnt'];

    $query="select count(distinct order_id) as cnt from orders";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $orders=$row['cnt'];

    $query="select count(*) as cnt from categories";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $categories=$row['cnt'];

    $query="select count(*) as cnt from items";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $items=$row['cnt'];

    $query="select sum(total_bill) as amount from orders group by order_id";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $revenue=$row['amount'];


  ?>
  <div class="container">
    <div class="row">

    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-users"></i>
        <span class="count-numbers"><?php echo $customers; ?></span>
        <span class="count-name">Customers</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter primary">
      
      <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <span class="count-numbers"><?php echo $orders; ?></span>
        <span class="count-name">Orders</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
      <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span class="count-numbers"><?php echo $categories; ?></span>
        <span class="count-name">Categories</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <span class="count-numbers"><?php echo $items; ?></span>
        <span class="count-name">Items</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter text-dark">
        
      <i class="fa fa-inr" aria-hidden="true"></i>
        <span class="count-numbers"><?php echo $revenue; ?></span>
        <span class="count-name">Revenue</span>
      </div>
    </div>

    










  </div>
</div>

</body>
</html>


