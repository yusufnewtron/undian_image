<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/title.png" >
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!--link CSS-->
	<link href="style.css" rel="stylesheet">
	
    <title>Undian</title>
  </head>

  <style>
  </style>
  
    <body id="home" >
    <!-- <body id="home" class="fireworks" style="background-color:black;"> -->

    <section class="text-center justify-content-md-center" >
        <?php
            include ("conn.php");
            $show =$mysqli->query("Select j.*,p.Nama,p.Nomor,p.qr_code from tbl_juara j
                                INNER JOIN tbl_peserta p ON p.nomor_juara=j.nomor_juara
                                order by nomor_juara desc");
            
            $peserta =$mysqli->query("Select * from tbl_peserta order by Nama asc");
            
        ?>

        <div class="row justify-content-md-center">
            <div class="col col-md-4" >
                <form method="POST" action="">
                <input type="number" name="nomor_juara" class="form-control" placeholder="Juara" style="width:300px;">
                <select name="peserta" class="form-control" style="width:300px;">
                    <?php
                    while($r=mysqli_fetch_array($peserta)){
                        echo"
                        <option value='$r[Id]' >$r[Nama]</option>";
                    }
                    ?>
                </select>
                </br>
                <button class="btn btn-primary" type="submit" name="Simpan" value="Simpan">Save</button>
                <a class="btn btn-danger" href="index.php">Back To Undian</a>
                </form>
                </br></br>
            </div>

            <div class="col col-md-9" >
                <table class="table">
                    <head>
                        <tr>
                            <th>Juara</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </head>
                    <?php
                    while($r=mysqli_fetch_array($show)){ ?>
                        <tr>
                            <td><?php echo 'Juara '.$r['nomor_juara'];?></td>
                            <td><?php echo $r['Nama'];?></td>
                            <td><a href="?id_hapus=<?php echo $r['nomor_juara'];?>" class="btn btn-danger">Hapus</a></td>
                        </tr>
                        <?php
                    }?>
                </table>
            </div>

        </div>
	</section>
    </body>
</html>

<?php
if(isset($_POST['Simpan'])){
    $nomor_juara=$_POST['nomor_juara'];
    $Id=$_POST['peserta'];

    $insert_juara=$mysqli->query("INSERT INTO tbl_juara SET 
                                    nomor_juara=".$nomor_juara);
    
    $update_peserta=$mysqli->query("UPDATE tbl_peserta SET 
                                    nomor_juara=".$nomor_juara."
                                    WHERE Id=".$Id);
    if ($update_peserta == TRUE) 
    {
        $page = $_SERVER['PHP_SELF'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
    }
}

if(isset($_GET['id_hapus'])){
    // echo $_GET['id_hapus'];
    $hapus_juara =$mysqli->query("DELETE FROM tbl_juara WHERE nomor_juara=".$_GET['id_hapus']);

    $update_peserta =$mysqli->query("UPDATE tbl_peserta SET 
                                    nomor_juara=0
                                    WHERE nomor_juara=".$_GET['id_hapus']);
    
    if ($update_peserta == TRUE) 
    {
        $page = $_SERVER['PHP_SELF'];
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
    }
}
?>