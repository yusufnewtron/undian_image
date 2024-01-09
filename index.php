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
	<script src="js/jquery.snowfall.js"></script>

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!--link CSS-->
	<link href="style.css" rel="stylesheet">
	
    <title>Undian</title>
  </head>

  <style>
    .custom-select {
		min-width: 200px;
		font-weight: bold;
		font-size:25px;
    }

    select {
		appearance: none;
		/* safari */
		-webkit-appearance: none;
		/* other styles for aesthetics */
		/* width: 100%; */
		/* font-size: 1.15rem; */
		padding: 0.5em ;
		background-color: #fff;
		border: 1px solid #caced1;
		border-radius: 0.25rem;
		color: #000;
		cursor: pointer;
    }

    .teks{
        font-weight: bold;
        font-size:25px;
        color:white;
    }
  </style>
  
  <body id="home" class="fireworks"
  style="background-image: url('img/bg_undian.jpeg'); 
  background-repeat: no-repeat, repeat;
  background-size:cover;
  background-position: center center;
  height:100vh;
  width:100vw;
  overflow:hidden !important;
  ">
  <!-- <body id="home" class="fireworks" style="background-color:black;"> -->

	<!--Jumbotron-->
	<section class="text-center justify-content-md-center" >
        <?php
            include ("conn.php");
            $show =$mysqli->query("Select * from tbl_peserta order by rand()");
            $total=0;
            $arr=array();
            while($r =mysqli_fetch_array($show)){
                // echo $r['Nama'];
                array_push($arr, $r['qr_code']);
                $total++;
            }

            $get_list_juara =$mysqli->query("Select * from tbl_juara order by nomor_juara desc");
            // print_r($arr);
            // echo $total;
        ?>

        

        <div class="row justify-content-md-center" style="margin-top:-50px;">
            <div class="col col-md-12" >
                <center>
                <select id="list_juara" class="custom-select" style="width:100px;">
                    <?php
                    while($r=mysqli_fetch_array($get_list_juara)){
                        echo"
                        <option value='$r[nomor_juara]' style='font-weight: bolder;'><strong>JUARA $r[nomor_juara]</strong></option>";
                    }
                    ?>
                </select>
                </center>
                </br>
            </div>

            <div class="col col-md-12" style="position:'absolute'; z-index: 10;">
                <button class="btn btn-success" id="start">Start</button>
                <button class="btn btn-danger" id="stop">Stop</button>
                <button class="btn btn-warning" id="refresh" >Refresh</button>
                <button class="btn btn-primary" id="save">Save</button>
                </br></br>
            </div>

            <div class="col col-md-4" >
                <div class="show_data"></div>
                <div class="teks"></div>
                <!-- <img src="qr/corel.png" width="200px"> -->
                
            </div>
        </div>
		<input type="hidden" id="total" value="<?php echo $total?>">

	  <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
		<path fill="#ffffff" fill-opacity="1" 
		d="M0,160L40,160C80,160,160,160,240,176C320,192,400,224,480,202.7C560,181,640,107,720,112C800,117,880,
		203,960,213.3C1040,224,1120,160,1200,117.3C1280,75,1360,53,1400,42.7L1440,32L1440,320L1400,320C1360,320,
		1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,
		320,240,320C160,320,80,320,40,320L0,320Z">
		</path>
	  </svg> -->
	</section>
	<!--Akhir Jumbotron-->
    <div id="wb_undian" style="position:absolute;left:510px;top:627px;width:56px;height:54px;z-index:16;">
        <audio src="backsound/undian.mp3" id="undian" loop="loop"></audio>
    </div>
    <div id="wb_kemenangan_lain" style="position:absolute;left:510px;top:627px;width:56px;height:54px;z-index:16;">
        <audio src="backsound/kemenangan_lain.mp3" id="kemenangan_lain" ></audio>
    </div>
    <div id="wb_kemenangan1" style="position:absolute;left:510px;top:627px;width:56px;height:54px;z-index:16;">
        <audio src="backsound/kemenangan1_gabung.mp3" id="kemenangan1" loop="loop"></audio>
    </div>
    <div id="wb_clink" style="position:absolute;left:566px;top:628px;width:56px;height:53px;z-index:17;">
        <audio src="backsound/clink.WAV" id="clink"></audio>
    </div>

<script>
$(document).ready(function(){
	$('#start').prop('disabled', false);
	$('#stop').prop('disabled', true);
	$('#refresh').prop('disabled', true);
	$('#save').prop('disabled', true);
});
let kill=false;

$('#start').click(function(){
    <?php
    $php_array = $arr;
    $js_array = json_encode($php_array);
    echo "var img_array = ". $js_array . ";\n";
    ?>
    let total =$('#total').val();
    let juara =$('#list_juara').val();
    $('#start').prop('disabled', true);
	$('#stop').prop('disabled', false);
	$('#refresh').prop('disabled', true);
	$('#save').prop('disabled', true);
    document.getElementById('undian').play();
    // alert(juara);
    // alert(total);
    // alert(img_array);
    Looper(total,img_array);
});

function Looper(total,img_array){
    for(let i=0; i<total; i++){
        setTimeout(function(y) {  
            i =parseInt(i);  
            console.log(i);
            // console.log(img_array[i]);
            if(kill) return;
            $('.show_data').html(`<img src="qr/${img_array[i]}" width="400px" class="w3-center w3-animate-top">`);
            if (i == (total -1)) {
                // console.log('end');
                Looper(total,img_array);
            }
        }, i * 100);
        
    }
}

$('#stop').click(function(){
    kill =true;
    let juara =$('#list_juara').val();
	$('#start').prop('disabled', true);
	$('#stop').prop('disabled', true);
	$('#refresh').prop('disabled', false);
	$('#save').prop('disabled', false);
    if(juara ==1){
        document.getElementById('undian').pause();
        document.getElementById('clink').play();
        document.getElementById('kemenangan1').play();
        snowwall();
    } else {
        document.getElementById('undian').pause();
        document.getElementById('clink').play();
        document.getElementById('kemenangan_lain').play();
    }
    $.ajax({    
        type: "GET",
        url: "show.php",  
        data:'juara='+juara,      
        success: function(response){               
            $(".show_data").html(response); 
            $('.teks').text('Silahkan Scan...');
        }

    });
});


$('#refresh').click(function(){
    location.reload();
});

$('#save').click(function(){
    let juara =$('#list_juara').val();
    $.ajax({    
        type: "POST",
        url: "save.php",  
        data:'juara='+juara,      
        success: function(response){               
            location.reload();
        }

    });
});

function snowwall(){
    $.snowfall.start({
        // content:'<i class="fa fa-snowflake-o"></i>'
        size: {
            min: 10,
            max: 50
        },
		opacityRange: [0.5, 0.8],
		intensity: 10,
		driftRange: [-2, 2],
		speedRange: [25, 80],
        color:'#fff',
        // content:'&#10052;'
        content:'&#9830;'
    });

}
</script>


</body>
</html>