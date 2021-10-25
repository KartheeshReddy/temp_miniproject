<!-- if (isset($_SESSION['user_logged_in'])) {
    header('location:index.php');
}
if (isset($_SESSION['admin_logged_in'])) {
    header('location:admin.php');
} -->





<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="abc.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <form action="signup.php" method="POST" id='signin_form'>
        <fieldset>
            <h1>
                <legend>Sign In</legend>
            </h1>
            <input type="email" placeholder="Email" name="email" id=""><br>
            <input type="text" placeholder="Username" name="username" id=""><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="password" placeholder="Confirm Password" name="confirm_password"><br>
            <input type="submit" name='submit_btn' class="btn btn-dark">
        </fieldset>
    </form>

    <?php
    if (isset($_POST['submit_btn'])) {

        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["confirm_password"];
        if ($password != $cpassword) {
            echo "<script>alert('Password and Confirm Password doesn\'t match!')</script>";
        } else {

            $query = "select * from users where user_email = '$email'";
            $query_run = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($query_run);
            if ($row != NULL && $row['user_email'] == $email) {
                echo "<script>alert('Email already exits!')</script>";
            } else {
                $query = "insert into users(`user_name`, `user_email`, `user_pwd`) values('$username', '$email', '$password')";
                $query_run = mysqli_query($con, $query);
                header("Location: login.php");
                exit();
            }
        }
    }
    ?>

</body>

</html>