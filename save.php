<?php
include ("conn.php");
$get_peserta =$mysqli->query("SELECT * FROM tbl_peserta WHERE nomor_juara=".$_POST['juara']);
$get=mysqli_fetch_array($get_peserta);
echo $get['Nomor'];
$insert_pemenang =$mysqli->query("INSERT INTO pemenang SET 
                                    Nomor ='".$get['Nomor']."',
                                    Nama ='".$get['Nama']."',
                                    Hadiah ='".$get['nomor_juara']."',
                                    qr_code ='".$get['qr_code']."'
                                    ");
$hapus_peserta =$mysqli->query("DELETE FROM tbl_peserta WHERE nomor_juara=".$_POST['juara']);
$hapus_peserta =$mysqli->query("DELETE FROM tbl_juara WHERE nomor_juara=".$_POST['juara']);
$data['hasil']=1;
$data['nama']=$get['Nama'];
json_encode($data);
?>