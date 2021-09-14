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
            <form class="d-flex mx-auto">
                <input id="search-input" class="form-control me-2" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <ul class="navbar-nav mb-2 mb-lg-0">';

            if (!(isset($_SESSION["user_loggedin"]))) {
                echo '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>';
            }
            else {
                echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>';
            }
                echo '<li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart <img id="cart" src="images/cart.jpg"></a>
                </li>
            </ul>

        </div>
    </div>
</nav>';

?>