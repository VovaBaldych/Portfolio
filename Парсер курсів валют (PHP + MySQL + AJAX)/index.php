<?php
    require_once('connection.php');
    $startDate = new DateTime('-1 month');
    $endDate = new DateTime();
    $period = new DatePeriod($startDate, new \DateInterval('P1D'), $endDate->modify('+1 day'));
    $dbh -> query("DELETE FROM `currency`");

    foreach ($period as $date) {
        $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date->format('d/m/Y'); // URL, XML документ, всегда содержит актуальные данные
        if (!$xml = simplexml_load_file($url)) die('Ошибка загрузки XML'); // загружаем полученный документ в дерево XML
        foreach ($xml->Valute as $row) { // перебор всех значений
            $sth = $dbh->prepare("INSERT INTO `currency`(`valuteID`, `numCode`, `charCode`, `name`, `value`, `date`) VALUES(:valuteid,:numcode,:charcode,:valname,:valvalue,:valdate)");
            $sth->bindParam(':valuteid', $row->attributes()->ID);
            $sth->bindParam(':numcode', $row->NumCode);
            $sth->bindParam(':charcode', $row->CharCode);
            $sth->bindParam(':valname', $row->Name);
            $sth->bindParam(':valvalue', $row->Value);
            $sth->bindParam(':valdate', $xml->attributes()->Date);
           $sth->execute();
        }
    }
$sth = $dbh -> query("SELECT * from `currency`");
$data = $sth->fetchAll();
foreach($data as $row) echo "<p>".$row['valuteID'].", ".$row['numCode'].", ".$row['charCode'].", ".$row['name'].", ".$row['value'].", ".$row['date']."</p>";