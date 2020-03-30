<?php
    require_once('connection.php');

    $startDate = new DateTime('-1 month'); // початкова дата
    $endDate = new DateTime(); // кінцева дата
    $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate->modify('+1 day')); // обраховуємо період
    $dbh -> query("DELETE FROM `currency`"); // видаляємо всі наявні записи в БД, щоб завантажити нові

    foreach ($period as $date) { // перебираємо всі значення за період (в нашому випадку - місяць)
        $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date->format('d/m/Y'); // XML-документ з даними про валюти
        if (!$xml = simplexml_load_file($url)) die('Ошибка загрузки XML'); // завантажуємо отриманий документ в дерево XML
        foreach ($xml->Valute as $row) { // перебираємо всі значення за день
            $sth = $dbh->prepare("INSERT INTO `currency`(`valuteID`, `numCode`, `charCode`, `name`, `value`, `date`) VALUES(:valuteid,:numcode,:charcode,:valname,:valvalue,:valdate)"); // готуємо запит до БД
            $sth->bindParam(':valuteid', $row->attributes()->ID); // записуємо ID валюти
            $sth->bindParam(':numcode', $row->NumCode); // записуємо номерний код валюти
            $sth->bindParam(':charcode', $row->CharCode); // записуємо символьний код валюти
            $sth->bindParam(':valname', $row->Name); // записуємо назву валюти
            $sth->bindParam(':valvalue', $row->Value);  // записуємо вартість валюти (в рос. рублях)
            $sth->bindParam(':valdate', $xml->attributes()->Date); // записуємо дату оновлення курсу
            $sth->execute(); // запускаємо підготовлений запит
        }
    }
//              Виводимо отримані дані з БД на екран
//    $sth = $dbh -> query("SELECT * FROM `currency`");
//    $data = $sth->fetchAll();
//    foreach($data as $row) echo "<p>".$row['valuteID'].", ".$row['numCode'].", ".$row['charCode'].", ".$row['name'].", ".$row['value'].", ".$row['date']."</p>";