<?php

function checkUser(PDO $dbcon, $username, $passwd){
    try{
        $sql = "SELECT password FROM user WHERE username=?";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username));

        $rows = $prepare->fetchAll();

        foreach($rows as $row){
            $pw = $row["password"];
            if( password_verify($passwd, $pw) ){
                return true;
            }
        }

        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function creatUser($dbcon, $fname, $lname, $username, $passwd){
    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO user VALUES (?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($fname, $lname, $username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}


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