<?php
$host = 'localhost'; // MYSQL database host adress
$db = 'dipa'; // MYSQL database name
$user = 'ds1'; // Mysql Database user
$pass = 'CxEYaY9KzJhxQJJx'; // Mysql Datbase password
 
// Connect to the database
$link = mysql_connect($host, $user, $pass);
mysql_select_db($db);
 
require 'exportcsv.inc.php';
 
$table="persons"; // this is the tablename that you want to export to csv from mysql.
 
exportMysqlToCsv($table);
 
?>