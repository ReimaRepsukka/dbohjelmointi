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

function createUser(PDO $dbcon, $fname, $lname, $username, $passwd){
    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO user VALUES (?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($fname, $lname, $username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}


function createTable(PDO $con){
    // $sql = "CREATE TABLE IF NOT EXISTS user(
    //     first_name varchar(50) NOT NULL,
    //     last_name varchar(50) NOT NULL,
    //     username varchar(50) NOT NULL,
    //     password varchar(150) NOT NULL,
    //     PRIMARY KEY (username)
    //     )";

    // $sql_add = "INSERT IGNORE INTO user VALUES ('Reima', 'Riihimäki','repe','eper'),
    //     ('John','Doe', 'doejohn', 'eod'),('Lisa','Simpson','ls','qwerty')";

$sql_add = "INSERT IGNORE INTO user VALUES ('joku', 'kalle','simo','er')";

$sql_add2 = "INSERT IGNORE INTO user VALUES ('hopo', 'hepe','hei','hoi')";

    try{
        $con->beginTransaction();        
        $con->exec($sql_add2);
        $con->exec($sql_add);  
        $con->commit();
    }catch(PDOException $e){
        $con->rollBack();
        echo '<br>'.$e->getMessage();
    }
}

function getDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=secdb', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}

?>