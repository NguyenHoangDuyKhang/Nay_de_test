<?php
$host = "localhost";
$usename = "root";
$password = "13032004";
$dbname = "data_php";

global  $conet;
$conet = new mysqli($host, $usename, $password, $dbname);
if($conet->connect_errno){
    die('Kết nối thất bại: ' . $conet->connect_errno);
}
?>