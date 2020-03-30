<?php
    require_once('read_xml_data.php');
    require_once ('rest_api.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['q'] == 'getValute') {
        getValute($dbh);
    } else {
        echo 'Невірно вказана адреса';
    }