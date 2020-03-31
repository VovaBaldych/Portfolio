<?php
    require_once('includes/read_xml_data.php');
    require_once ('includes/rest_api.php');
    require_once ('includes/get_valute_per_date.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Парсер курсів валют</title>
</head>
<body>
    <div class="container">
        <h1 class="main-title mb wow fadeInLeft">Бажаєте отримати актуальний курс валют?</h1>

        <form action="" class="block-wrapper form shadow mb wow fadeInRight" id="valuteForm">
            <label for="valute-date" class="form-text-row">Виберіть дату, за яку хочете отримати курс валют</label>
            <div class="form-row">
                <input type="date" name="valute-date" id="valute-date" class="valute-date">
                <input type="submit" name="submit" class="submit-button" id="submit-button" value="Отримати дані">
            </div>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['q'] == 'getValute') {
                getValute($dbh);
            }
            if(isset($_GET['submit'])) {
                getValutePerDate($dbh);
            }
        ?>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>