<?php
include('parts/database_connection.php');
session_start();
if(!isset($_SESSION['user_id'])) {
    header("location:login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('parts/include_css.php'); ?>
    <title>Chat Application using PHP Ajax Jquery</title>
</head>
<body>
    <div class="container main-wrapper d-flex flex-column justify-content-center">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-center">
                        <img src="img/user_avatar.png" alt="user_avatar" width="100" height="100">
                    </div>
                    <div class="col-4 text-center">
                        <h3>Hi, <?php echo $_SESSION['username'];  ?></h3>
                    </div>
                    <div class="col-4 text-center">
                        <a class="btn btn-link" href="parts/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 mb-3" id="user_model_details"></div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center mb-4">All users</h4>
                        <div id="user_details"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('parts/include_scripts.php'); ?>
</body>
</html>