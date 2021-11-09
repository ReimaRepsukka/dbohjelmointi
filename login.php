<?php
require('headers.php');
require('functions.php');

$db = getDbConnection();
createTable($db);

$db->beginTransaction();
//....exec

$db->commit();

//catch
$db->rollBack();



?>