<?php
    $user = 'root'; // имя пользователя
    $pass = ''; // пароль
    $options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $dbh = new PDO('mysql:host=localhost;dbname=popa_kak_y_kim', $user, $pass, $options);

    $select_brand = $dbh -> query("SELECT distinct `manufacturer` FROM `mycardata` ORDER BY `mycardata`.`manufacturer` ASC");
    $brand = $_POST['brand'];
    $brand_text = "brand";

    $select_model = $dbh -> query("SELECT distinct `model` FROM `mycardata` WHERE `manufacturer`='$brand' ORDER BY `mycardata`.`model` ASC");
    $model = $_POST['model'];
    $model_text = "model";

    $select_type = $dbh -> query("SELECT distinct `car` from `mycardata` WHERE `manufacturer`='$brand' AND model='$model' ORDER BY `mycardata`.`model` ASC");
    $type = $_POST['type'];
    $type_text = "type";

    function Select_H($param, $select_param, $key, $text_param)
    {
        foreach($select_param as $zn)
        {
            $tmp = $zn[$key];
            echo '<div class="col-lg-3">';
            echo '<form method="post" class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$tmp.'</h5>';
            echo "<input type='hidden' name='".$text_param."' value='".$tmp."'>";
            echo '<input type="submit" class="btn btn-primary" value="Go!">';
            echo '</div>';
            echo '</form><br>';
            echo '</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <h1>Вибери вже для себе нормальну тачку!</h1>
                <?php
                    if(empty($brand)) {
                        Select_H($brand, $select_brand, 'manufacturer', $brand_text);
                        echo 'brand';
                    }
                    else if(empty($model))
                        foreach($select_model as $zn)
                        {
                            $tmp = $zn['model'];
                            echo '<div class="col-lg-3">';
                            echo '<form method="post" class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$tmp.'</h5>';
                            echo "<input type='hidden' name='brand' value='".$brand."'>";
                            echo "<input type='hidden' name='model' value='".$tmp."'>";                            
                            echo '<input type="submit" class="btn btn-primary" value="Go!">';
                            echo '</div>';
                            echo '</form><br>';
                            echo '</div>';
                        }
                    else if (!empty($brand) && !empty($model))
                        foreach($select_type as $zn) {
                            $tmp = $zn['car'];
                            echo '<div class="col-lg-3">';
                            echo '<form method="post" class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$tmp.'</h5>';
                            echo "<input type='hidden' name='brand' value='".$brand."'>";
                            echo "<input type='hidden' name='model' value='".$model."'>";
                            echo "<input type='hidden' name='type' value='".$tmp."'>";
                            echo '<input type="submit" class="btn btn-primary" value="Go!">';
                            echo '</div>';
                            echo '</form><br>';
                            echo '</div>';
                        }
                    else if(!empty($brand) && !empty($model) && !empty($type)) {
                        $car_info = $dbh -> query("SELECT * FROM `mycardata` WHERE `manufacturer`='$brand' AND model='$model' AND car='$type'");
                        while ($result=mysql_fecth_array($car_info)) carid: $result[carid];
                    }
                ?>
        </div>
    </div>
</body>
</html>