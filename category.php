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
    <script src="https://use.fontawesome.com/6a0c97f605.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="index.css">
   <script>let n;</script>
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>



<!--  -->
<!-- Modal Reviews -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reviews</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!--  -->



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
                $query1="select round(avg(rating),1) as item_rating from rating group by item_name having item_name='$item_name' ";
                $query_run1=mysqli_query($con,$query1);
                $row1=mysqli_fetch_assoc($query_run1);
                if($row1==null)
                    $rating=0;
                else
                    $rating=$row1['item_rating'];
            echo '
            <div class="item card mx-2 my-3" style="width: 18rem;">
                <img src="'.$image.'" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="item-name">
                        <h5 class="card-title">'.$item_name.'</h5>
                        <h5><i class="fa fa-inr" aria-hidden="true"></i> '.$price.'</h5>
                        <span>
                        '.$rating.'<i class="fas fa-star" style="color:gold;"></i>
                        <span>
                    </div>
                    ';
                
                if(isset($_SESSION["user_loggedin"]))

                    echo'    <button style="width:60%" id="item-'.$item_id.'" onclick="add_to_cart('.$item_id.')" class="btn btn-secondary cart-btn">Add to Cart</button>';
                else
                    echo'    <button style="width:60%" id="item-'.$item_id.'" onclick="add_to_cart('.$item_id.')" class="btn btn-secondary cart-btn" disabled>Add to Cart</button>';
                
                //echo'    <button id="item-'.$item_id.'" onclick="add_to_cart('.$item_id.')" class="btn btn-secondary cart-btn" disabled>Add to Cart</button>';
                   
                // echo '<button class="btn btn-primary mx-1" id="review-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Reviews</button>';
                // onclick="ratingModal(id, '.$cat_id.')"
               // echo '<button  type="button" class="btn btn-primary mx-1" data-item="'.$item_name.'" data-bs-toggle="modal" data-target="#rating_modal_'.$item_name.'">
                //Ratings
              //</button>';

              $str = $item_name;
              $arr=(explode(" ",$str));
              $item_name_forid=join("_",$arr);

              
              echo '<button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modal_'.$item_name_forid.'">
              Ratings
              </button>';
              
              echo '</div>
            </div>';


           
            ?>
          
           <!-- Modal -->
          <div class="modal fade" id="modal_<?php echo $item_name_forid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ratings and Reviews for <b><?php echo $item_name; ?></b></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php 
                
                $query_r="select * from rating where item_name='$item_name'";
                $query_run_r=mysqli_query($con,$query_r);
                
                $ratings_found=false;
                while($row_r=mysqli_fetch_assoc($query_run_r))
                {
                  
                  $ratings_found=true;
                  $user_name=$row_r["user_name"];
                  $rating=$row_r["rating"];
                  $review=$row_r["review"];
                 
                 
                  $str=$user_name;
                  $arr=(explode(" ",$str));
                  $user_name_forid=join("_",$arr);
                  ?>
                  
                    <div style="display:flex; justify-content: space-between;border: 1px solid black;margin-bottom:1px;">
                      <div>
                        User Name: <?php echo $user_name; ?>
                      </div>
                      
                      <div style="display:block;">
                        <i class="fas fa-star" id="1_<?php echo $item_name_forid; ?>_<?php echo $user_name_forid;?>"></i>
                        <i class="fas fa-star" id="2_<?php echo $item_name_forid; ?>_<?php echo $user_name_forid;?>"></i>
                        <i class="fas fa-star" id="3_<?php echo $item_name_forid; ?>_<?php echo $user_name_forid;?>"></i>
                        <i class="fas fa-star" id="4_<?php echo $item_name_forid; ?>_<?php echo $user_name_forid;?>"></i>
                        <i class="fas fa-star" id="5_<?php echo $item_name_forid; ?>_<?php echo $user_name_forid;?>"></i><br>
                        <!-- <input type="text" id="ratingField_<?php //echo $user_name;?>" value=<?php //echo $rating; ?> hidden> -->
                        <!-- Rating : <?php //echo $rating; ?><i class="fas fa-star" style="color:gold;"></i> -->
                        <script>
                              //let n=parseInt(document.getElementById("ratingField_<?php //echo $user_name;?>").value);
                              
                              n=<?php echo $rating; ?>;
                              // console.log(n);
                              for(let i=1;i<=n;i++)
                              {
                                  document.getElementById(i.toString()+"_"+ "<?php echo $item_name_forid; ?>"  +"_"+"<?php echo $user_name_forid;?>").style.color="gold";
                              }  
                      </script>
                        Review : <?php echo $review; ?>
                      </div>
                    </div>
                  <?php
                }
                if($ratings_found==false)
                {
                  ?>
                    <div>
                      <center>No ratings and reviews yet!</center>
                    </div>

                  <?php

                }
              ?>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
          </div>
          </div>
            <?php
            }
            
            
            ?>

        </div>
    </div>


    <script>

    // function ratingModal(item_name, cat_id) {
    //     item_name = item_name.substr(7, item_name.length - 7);
    //     console.log(item_name);
    //     window.location.href = `category.php?cat_id=${cat_id}&rating_item=${item_name}`;
    // }

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