<?php
function getValute($pdo)
{
    $get_id=$_GET['valuteID'];
    $date_from=$_GET['from'];
    $date_to=$_GET['to'];

    $res_qr = $pdo -> query("SELECT * FROM `currency` WHERE `valuteID`='$get_id' AND `date` BETWEEN '$date_from' AND '$date_to'"); // робимо запит до бд
    $final = $res_qr->fetchAll();
    foreach($final as $row) echo "<p>".$row['valuteID'].", ".$row['numCode'].", ".$row['charCode'].", ".$row['name'].", ".$row['value'].", ".$row['date']."</p>";
}