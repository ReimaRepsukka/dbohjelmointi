<?php
session_start();
require('headers.php');
require('functions.php');

// $db = getDbConnection();
// createTable($db);

//creatUser(getDbConnection(), "Kalle", "Koodari", "kallekoo", "vekkuli123");
//creatUser(getDbConnection(), "Meija", "Mahtava", "meijuli", "oamk");

if( checkUser(getDbConnection(), "meijuli", "oamk") ){
    $_SESSION["user"] = "meijuli";
    echo "Oikea salasana!";
}else{
    echo "Väärä salasana";
}

?>