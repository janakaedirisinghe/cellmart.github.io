<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'testing';

$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (mysqli_connect_errno()) {
	die('database connect failed'.mysqli_connect_error());
	echo "error";
}else{
	//echo  "connect successful ";
}

?>


