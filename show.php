<?php
include ("conn.php");
$sql ='SELECT * FROM tbl_peserta where nomor_juara='.$_GET['juara'];
// echo $sql;
$get_juara =$mysqli->query($sql);
if(mysqli_num_rows($get_juara) >0){
    $r=mysqli_fetch_array($get_juara);
    echo"
    <img src='qr/$r[qr_code]' width='400px'>";
}
?>

