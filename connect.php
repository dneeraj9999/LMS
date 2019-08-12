<?php 
session_start();
$user_name = "root";
$password = "";
$database = "wtdb";
$server = "127.0.0.1";
$con=new mysqli($server, $user_name, $password, $database);
if(!$con){
	die("Connection Failed!");
}

 ?>