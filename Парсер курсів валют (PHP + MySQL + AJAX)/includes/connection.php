<?php
    $options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
        $dbh = new PDO("mysql::host=localhost;dbname=tz", 'root', '', $options);
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage();                                                // якщо відбулась помилка при ініціалізації БД - говоримо про це
        die();                                                                              // завершуємо роботу скрипту в разі невдачі
    }