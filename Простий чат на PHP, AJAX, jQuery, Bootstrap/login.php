<?php
include('parts/database_connection.php');
session_start();
$message = '';
if(isset($_SESSION['user_id'])) header('location:index.php');
if(isset($_POST["login"])) {
    $query = "SELECT * FROM login WHERE username = :username";
    $statement = $connect->prepare($query);
    $statement->execute(array(':username' => $_POST["username"]));
    $count = $statement->rowCount();
    if($count > 0) {
        $result = $statement->fetchAll();
        foreach($result as $row) {
            if(password_verify($_POST["password"], $row["password"])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $sub_query = "INSERT INTO login_details (user_id) VALUES ('".$row['user_id']."')";
                $statement = $connect->prepare($sub_query);
                $statement->execute();
                $_SESSION['login_details_id'] = $connect->lastInsertId();
                header("location:index.php");
            } else $message = '<span class="badge badge-danger">Wrong password</span>';
        }
    } else $message = '<span class="badge badge-danger">Wrong username</span>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("parts/include_css.php");?>
    <title>Chat Application using PHP Ajax Jquery</title>
</head>
<body class="text-center">
    <div class="container-fluid main-wrapper d-flex justify-content-center align-items-center">
        <form method="post" class="card form-signin">
            <div class="card-body">
                <img src="img/user_login.png" alt="user_login" width="100" height="100">
                <h3 class="h3 mb-2 font-weight-normal cover-heading">Sign In</h3>
                <span class="badge badge-danger mb-1"><?php echo $message; ?></span>
                <label for="inputUsername" class="sr-only">Login</label>
                <input type="text" name="username" id="inputUsername" class="form-control mb-2 mt-3" placeholder="Login" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                <div class="form-group mt-4">
                    <input type="submit" name="login" class="btn btn-success" value="Login" />
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="text-right">Have not registration?</p>
                    </div>
                    <div class="col-6">
                        <a href="register.php">Registration</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("parts/include_scripts.php"); ?>
</body>
</html>