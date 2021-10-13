<!-- Navbar -->
<?php 

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Grocery Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li> -->
            </ul>
            <!-- <form class="d-flex mx-auto">
                <input id="search-input" class="form-control me-2" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->

            <ul class="navbar-nav mb-2 mb-lg-0">';

            if (!(isset($_SESSION["user_loggedin"]))) {
                echo '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="signup.php">Sign Up</a>
            </li>
                ';
            }
            

            if (isset($_SESSION["user_loggedin"]))
            {
                echo '<li class="nav-item">
                    <a class="nav-link" href="cart.php"><img id="cart" src="images/cart.jpg"></a>
                </li>';
                echo '<li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><h5 class="dropdown-header">Signed in as<br><br><strong>'.$_SESSION["username"].'</strong></h5></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        
                    </ul>
                </div>

            </li>';
            }
            
            echo '    
            </ul>

        </div>
    </div>
</nav>';




?>