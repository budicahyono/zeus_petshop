<?php
/*
$host 		= "localhost";
$username 	= "zeusdb_user";
$password 	= "zeus_db123!!";
$dbname 	= "zeuspets_db";
*/

$host 		= "localhost";
$username 	= "root";
$password 	= "";
$dbname 	= "zeus_db";

 //define the timezone of this application
date_default_timezone_set("Asia/Tokyo");

  $link = mysqli_connect($host,$username,$password,$dbname);
  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
    " - ".mysqli_connect_error());
  }

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
?>