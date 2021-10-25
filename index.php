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


    <!-- Categories -->
    <div class="categories my-3 mx-2">
        <h2 class="mx-4">Pick Your Category</h2>
        <!-- Each category -->
        <div class="category">


            <?php

            $query = "select * from categories";
            $query_run = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($query_run))
            {
                $image = $row['cat_image'];
                $cat_name = $row['cat_name'];
                $cat_id = $row['cat_id'];
            echo '
            <div onclick="func('.$cat_id.')" id="'.$cat_id.'" class="card mx-2 my-3" style="width: 18rem;">
                <img src="'.$image.'" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-text">'.$cat_name.'</h4>
                </div>
            </div>';

            }
            ?>

        </div>

    </div>
    </div>


    <script>
    function func(catid) {

        var btn = document.getElementById(catid);

        btn.addEventListener('click', function() {
            window.location.href = `category.php?cat_id=${catid}`;
        })
    }
    </script>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>



</body>

</html>