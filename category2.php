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

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>


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
            echo '
            <div class="item card mx-2 my-3" style="width: 18rem;">
                <img src="'.$image.'" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="item-name">
                        <h5 class="card-title">'.$item_name.'</h5>
                        <h5><i class="fa fa-inr" aria-hidden="true"></i> '.$price.'</h5>
                    </div>';
                    if (isset($_SESSION["username"])){
                        echo '<button id="item-'.$item_id.'" onclick="add_to_cart('.$item_id.')" class="btn btn-secondary cart-btn">Add to Cart</button>';
                    }
                    else {
                        echo '<button id="item-'.$item_id.'" onclick="add_to_cart('.$item_id.')" disabled class="btn btn-secondary cart-btn">Add to Cart</button>'; 
                    }
                echo '</div>
            </div>';
            }
            

            ?>

        </div>
    </div>


    <script>
    function add_to_cart(item_id) {
        var btn = document.getElementById("item-" + item_id);

        btn.addEventListener('click', function() {
            window.location.href = `cart.php?item_id=${item_id}`;
        })
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