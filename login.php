<?php
require('headers.php');
require('functions.php');

//Tarkistetaan tuleeko palvelimelle basic login tiedot (Authorization: Basic asfkjsafdjsajflkasj)
if( isset($_SERVER['PHP_AUTH_USER']) ){
    if(checkUser(createDbConnection(), $_SERVER['PHP_AUTH_USER'],$_SERVER["PHP_AUTH_PW"] )){
        echo "Kirjauduit sisään!!!";
        exit;
    }
}

//Ilmoitetaan käyttäjälle, että kirjaudupa sisään (avaa selaimessa login ikkunan)
header('WWW-Authenticate: Basic');
exit;

//creatUser(getDbConnection(), "Kalle", "Koodari", "kallekoo", "vekkuli123");
//creatUser(getDbConnection(), "Meija", "Mahtava", "meijuli", "oamk");

// if( checkUser(getDbConnection(), "meijuli", "oamk") ){
//     $_SESSION["user"] = "meijuli";
//     echo "Oikea salasana!";
// }else{
//     echo "Väärä salasana";
// }

?>