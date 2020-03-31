<?php
function getValutePerDate($pdo) {
    $valute_date_pieces = explode("-", $_GET['valute-date']);
    list($valute_date_pieces[0], $valute_date_pieces[2]) = array($valute_date_pieces[2], $valute_date_pieces[0]);
    $valute_date = implode(".", $valute_date_pieces);

    $res_qr = $pdo -> query("SELECT * FROM `currency` WHERE `date`='$valute_date'"); // робимо запит до бд
    $final = $res_qr->fetchAll();
    ?>
    <div class="block-wrapper shadow wow fadeInUp">
        <h2 class="title">Курс валют за вибрану вами дату</h2>
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