<?php
include('parts/database_connection.php');
session_start();
$message = '';
if(isset($_SESSION['user_id'])) {
    header('location:index.php');
}
if(isset($_POST["register"]))
{
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $check_query = "SELECT * FROM login WHERE username = :username";
    $statement = $connect->prepare($check_query);
    $check_data = array(':username'  => $username);
    if($statement->execute($check_data)) {
        if($statement->rowCount() > 0) {
            $message .= '<span class="badge badge-danger mb-1">Username already taken</span>';
        } else {
            if(empty($username)) {
                $message .= '<span class="badge badge-danger mb-1">Username is required</span>';
            }
            if(empty($password)) {
                $message .= '<span class="badge badge-danger mb-1">Password is required</span>';
            } else {
                if($password != $_POST['confirm_password']) {
                    $message .= '<span class="badge badge-danger mb-1">Password not match</span>';
                }
            }
            if($message == '') {
                $data = array(
                    ':username'  => $username,
                    ':password'  => password_hash($password, PASSWORD_DEFAULT)
                );
                $query = "INSERT INTO login(username, password) VALUES (:username, :password)";
                $statement = $connect->prepare($query);
                if($statement->execute($data)) {
                    $message = '<span class="badge badge-success">Registration Completed!</span><br><span class="badge badge-success mb-1">Please, click "Back to login"</span>';
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("parts/include_css.php"); ?>
    <title>Chat Application using PHP Ajax Jquery</title>
</head>
<body class="text-center">
    <div class="container-fluid main-wrapper d-flex justify-content-center align-items-center">
        <form method="post" class="card form-signin">
            <div class="card-body">
                <img src="img/user_registration.png" alt="user_regitration" width="100" height="100">
                <h3 class="h3 mb-2 font-weight-normal cover-heading">User Registration</h3>
                <?php echo $message; ?>
                <label for="inputUsername" class="sr-only">Email address</label>
                <input type="text" name="username" id="inputUsername" class="form-control mb-2 mt-3" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control mb-2" placeholder="Password" required="">
                <label for="inputConfirmPassword" class="sr-only">Confirm password</label>
                <input type="password" name="confirm_password" id="inputConfirmPassword" class="form-control" placeholder="Confirm password" required="">
                <div class="form-group mt-4">
                    <input type="submit" name="register" class="btn btn-info" value="Registration" />
                </div>
                <div class="row">
                    <a href="login.php" class="ml-auto mr-auto">&#8592; Back to login</a>
                </div>
            </div>
        </form>
    </div>
    <?php include("parts/include_scripts.php"); ?>
</body>
</html>