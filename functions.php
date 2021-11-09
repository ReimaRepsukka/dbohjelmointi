<?php
function createTable($con){
    $sql = "CREATE TABLE IF NOT EXISTS user(
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        username varchar(50) NOT NULL,
        password varchar(150) NOT NULL,
        PRIMARY KEY (username)
        )";


    $sql_add = "INSERT IGNORE INTO user VALUES ('Reima', 'Riihimäki','repe','eper'),
        ('John','Doe', 'doejohn', 'eod'),('Lisa','Simpson','ls','qwerty')";

    try{
        $con->exec($sql);
        $con->exec($sql_add);   
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function getDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=secdb', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        createTable($dbcon);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}

?>