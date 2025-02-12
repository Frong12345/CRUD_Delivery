<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_delivery";

try{
    $condb = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username , $password);
    // echo "Connection Successfully";
} catch(PDOException $e){
    echo "Connection failed". $e->getMessage(); 
}

//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
?>