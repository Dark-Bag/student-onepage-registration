<?php
error_reporting(E_ALL & ~E_NOTICE);
GLOBAL $db_conn,$DATABASE_NAME;
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'unidb');
$db_conn =
mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if(mysqli_connect_errno()) {
die("ERROR: Database Connection to <u>localhost</u> has Failed! [".
mysqli_connect_error() ."]");
}else{
if (!mysqli_set_charset($db_conn, "utf8")) {} //try set UTF8

$sql = "SELECT database() AS strDB";
$rst = mysqli_query($db_conn, $sql);
$DATABASE_NAME = mysqli_fetch_object($rst)->strDB;
}
?>