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

    $select_model = $dbh -> query("SELECT distinct `model` FROM `mycardata` WHERE `manufacturer`='$brand' ORDER BY `mycardata`.`model` ASC");
    $model = $_POST['model'];

    $select_type = $dbh -> query("SELECT distinct `car` from `mycardata` WHERE `manufacturer`='$brand' AND model='$model' ORDER BY `mycardata`.`model` ASC");
    $type = $_POST['type'];

    function Select_H($param, $select_param, $key)
    {
        $letters_array=array();
        foreach($select_param as $zn)
        {
            
            $tmp = $zn[$key];
            $first_letter=substr($tmp,0,1);

            if(!in_array($first_letter, $letters_array))
            {
                if(!empty($letters_array))
                {
                    echo "</optgroup>\n";
                }
                echo "<optgroup label='".$first_letter."'>\n";
                array_push($letters_array, $first_letter);
            }
            
            if($tmp == $param) echo "<option data-whatever='".$first_letter."' value='".$tmp."' selected>".$tmp."</option>";
            else echo "\t<option data-whatever='".$first_letter."'  value='".$tmp."'>".$tmp."</option>\n";
        }
        echo "</optgroup>\n";
    }

    if(empty($brand))
        Select_H($brand, $select_brand, 'manufacturer');
    else if(empty($model))
        Select_H($model, $select_model, 'model');
    else
        Select_H($type, $select_type, 'car');
?>