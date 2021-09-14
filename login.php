<!-- // if (isset($_SESSION['user_logged_in'])) {
// header('location:index.php');
// }
// if (isset($_SESSION['admin_logged_in'])) {
// header('location:admin.php');
// } -->





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
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <form action="login.php" method="POST" id='signin_form'>
        <fieldset>
            <h1>
                <legend>Login</legend>
            </h1>
            <input type="email" placeholder="Email" name="email" id=""><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="submit" name='submit_btn' class="btn btn-dark">
        </fieldset>
    </form>

    <?php
    if (isset($_POST['submit_btn'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "select * from users where user_email = '$email' and user_pwd = '$password'";
        $query_run = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($query_run);

        if ($row!=NULL) {
            $_SESSION["username"] = $row["user_name"];
            $_SESSION["user_loggedin"] = true;
            header('location:index.php');
            exit();
        } else {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    }
    ?>

    <!-- Bootstrap Bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

</body>

</html>