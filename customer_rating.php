<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="abc.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Groccery Store | Login</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <style>
        /* .fa-star{
            color: gold;
        } */
    </style>
    <!-- <script src="js/jquery-1.11.0.min.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        // $(document).ready(function () {
        //     func4();
        // });
        function func1(x)
        {
            let n=parseInt(x);
            
            for(let i=1;i<=n;i++)
            {
                document.getElementById(i.toString()).style.color="gold";
            }
            for(let i=n+1;i<=5;i++)
            {
                document.getElementById(i.toString()).style.color="black";
            }
        }
        function func2(x)
        {
            let n=parseInt(x);
            for(let i=1;i<=n;i++)
            {
                document.getElementById(i.toString()).style.color="black";
            }
            func4();
        }
        function func3(x)
        {
            let n=parseInt(x);
            document.getElementById("ratingField").value=n;
        }
        function func4()
        {
            let rating=document.getElementById("ratingField").value;
            func1(rating.toString());
        }
    </script>
</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>
    
    <form action="" method="POST">
        Rating:
        <i class="fas fa-star" id="1" onmouseover="func1(id)" onmouseout="func2(id)" onclick="func3(id)"></i>
        <i class="fas fa-star" id="2" onmouseover="func1(id)" onmouseout="func2(id)" onclick="func3(id)"></i>
        <i class="fas fa-star" id="3" onmouseover="func1(id)" onmouseout="func2(id)" onclick="func3(id)"></i>
        <i class="fas fa-star" id="4" onmouseover="func1(id)" onmouseout="func2(id)" onclick="func3(id)"></i>
        <i class="fas fa-star" id="5" onmouseover="func1(id)" onmouseout="func2(id)" onclick="func3(id)"></i><br>
        <textarea type="text" placeholder="Type Review Here" name="review"></textarea><br>
        <input type="text" id="ratingField" value="0" name="rating"><br>
        <input type="submit" name="review_btn" class="btn btn-primary">
    </form>
    <?php
        if(isset($_POST['review_btn']))
        {
            $item_id=21;
            $customer_name="abc";
            $rating=$_POST['rating'];
            $review=$_POST['review'];
            echo $item_id;//.$customer_name.$rating.$review;
            $query="insert into rating values('$item_id','$customer_name','$rating',' $review')";
            $query_run=mysqli_query($con,$query);
            header('location: temp.php');
        }
    ?>
</body>
</html>