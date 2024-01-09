<html>
<head>
</head>
<body>
<?php 
?>

</body>
</html>


<?php
$server = "localhost";
$username = "root";
$password = "crm123";
$database = "doorprize_img";

define("HOST", "localhost"); // Host database
define("USER", "root"); // Usernama database
define("PASSWORD", "crm123"); // Password database
define("DATABASE", "doorprize_img"); // Nama database


mysqli_connect($server,$username,$password,$database,false,65536) or die("Koneksi gagal");


$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

if($mysqli->connect_error){
	trigger_error('Koneksi ke database gagal: ' . $mysqli->connect_error, E_USER_ERROR);	
}
?>