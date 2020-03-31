<?php
function getValute($pdo)
{
    $get_id=$_GET['valuteID'];
    $date_from=$_GET['from'];
    $date_to=$_GET['to'];
    $res_qr = $pdo -> query("SELECT * FROM `currency` WHERE `valuteID`='$get_id' AND `date` BETWEEN '$date_from' AND '$date_to'"); // робимо запит до бд
    $final = $res_qr->fetchAll();
    ?>

    <div class="block-wrapper shadow wow fadeInUp">
        <h2 class="title">Результат роботи методу REST API</h2>
        <table>
            <tr>
                <th>ID валюти</th>
                <th>Числовий код валюти</th>
                <th>Буквений код валюти</th>
                <th>Назва валюти</th>
                <th>Значення курсу</th>
                <th>Дата публікації курсу</th>
            </tr>
              <?php foreach($final as $row) echo "<tr><td>".$row['valuteID']."</td><td>".$row['numCode']."</td><td>".$row['charCode']."</td><td>".$row['name']."</td><td>".$row['value']."</td><td>".$row['date']."</td></tr>"; ?>
        </table>
    </div>
<?php } ?>