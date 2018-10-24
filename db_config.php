<?php
    //database configuration
    $dbHost = 'mysql.ebola.cz';
    $dbUsername = 'holaneu_vocabio';
    $dbPassword = 'admin2010';
    $dbName = 'holaneu_vocabio_db';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    $db->set_charset("utf8");
?>