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

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>

</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>


    <?php
        
        $user_id=$_SESSION["user_id"];
        $username=$_SESSION["username"];
        $email=$_SESSION["email"];
        $query="select * from user_details where user_id='$user_id'";
        $query_run=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($query_run);
        $phone=$row["user_phone"];
        $address=$row["address"];
    
    echo'
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name:</label><input type="text" class="form-control" value='.$username.'></div>
                    </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Phone Number:</label><input type="text" class="form-control"  value='.$phone.'></div>
                    <div class="col-md-12"><label class="labels">Email ID:</label><input type="text" class="form-control"  value='.$email.' disabled></div>
                    
                </div>
                
                <div class="mt-5 "><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="p-4 py-5">
            <div class="form-group">
            
            <div class="col-md-12"><label class="labels">Shipping Address:</label><input type="text" class="form-control"  value='.$address.'></div>
                    
            </div>   
            </div>  
        </div>
    </div>';

    ?>
</div>
</div>
</div>
<!-- <label for="comment">Shipping Address:</label>
<textarea class="form-control" rows="5" id="comment" value='.$address.'></textarea> -->


    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
        </script>



</body>

</html>