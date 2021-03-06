<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Monitor Presensi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- fav icon -->
	<link rel="SHORTCUt ICON" href="{{ asset('image/javan.png') }}" type="x/icons" />

	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

	<!-- loading effect -->
	<link rel="stylesheet" type="{{ asset('text/css') }}" href="css/nprogress.css" />
	
	<!-- btt -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<script src="{{ asset('js/modernizr.js') }}"></script> 
	
	<!-- date picker -->
	<link rel="stylesheet" href="{{ asset('css/foundation-datepicker.min.css') }}">

	<!-- circular -->
	<script src="{{ asset('js/jquery.js') }}"></script>
	<link href="{{ asset('css/jquery.circliful.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<script src="{{ asset('js/jquery.circliful.min.js') }}"></script>

	<style>
	body {
	    font-family: arial,verdana, sans-serif;
	    font-size: 12px;
	}
	</style>
</head>
 <script>
        setTimeout(function(){
           window.location.reload(1);
        }, 30000);
        </script>              
<body>

<div id="progsesbar"></div>
<!-- navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="{{ asset('image/javan.png') }}" class="img-responsive" width="90" style="margin-top:-14px;height:50px;">
      </a>
    </div>
  </div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="col-sm-12 col-md-3">
				<div class="form-group">
				<label>Urutan</label>
				    <select class="form-control" name="forma" onchange="location = this.options[this.selectedIndex].value;">
				    	<option value="" disabled selected>Urutkan Berdasarkan....</option>
					    <option value="{{ url('index') }}">Jam Masuk</option>
					    <option value="{{ url('indexjammasukterlambat') }}">Jam Masuk Terlambat</option>
					    <option value="{{ url('indexjamkeluar') }}" >Jam Keluar</option>
					    <option value="{{ url('indextidakmasuk') }}">Tidak Masuk</option>
					    <option value="{{ url('indexnama') }}">Nama</option>
					</select>
				</div><!-- form group -->
			</div><!-- Col-->
	
	
			<div class="col-sm-12 col-md-3">
				<div class="form-group">
		    	<label>Tanggal</label>
			      <input type="text" class="form-control" placeholder="Pilih Tanggal...." id="dp1" >	
				</div>
			</div><!-- col -->
		</div><!-- col 12-->
		<div class="col-sm-12 col-md-12">

		@foreach($show as $shows)
			<!-- other -->
			<?php 
			$jam_masuk_absensi = $shows->absensi_masuk; 
			$jam_masuknya_absensi = strtotime($jam_masuk_absensi);
			$ow = date('H:i:s', $jam_masuknya_absensi);

			
			if ($ow == '07:00:00' Or $ow == '00:00:00') {
				$jammasukreal = '';

			}else{
				$jammasukreal = $ow;
			}
			$jam_keluar = $shows->absensi_keluar;
			$jammkeluar = new DateTime($jam_keluar);
				$jam_keluarnya = strtotime($jam_keluar);
			$jammm_keluar = date('H:i:s', $jam_keluarnya);
			if ($jammm_keluar == '07:00:00' Or $jammm_keluar == '00:00:00') {
				$jamkeluar = '';
			}else{
				$jamkeluar = $jammm_keluar;
			}
			date_default_timezone_set('Asia/Jakarta'); 

			$kini = new DateTime('now');
			$jam_masuk = $shows->absensi_masuk;
			$jammasuk = new DateTime($jam_masuk);
			$durasikerja = $jammasuk->diff($kini)->format('%H:%I');
			if ($durasikerja == '00:00') {
				$rumus = 0;
				$durasireal = '';
			}else{
				$rumus = ($durasikerja*10)+10;
				$durasireal = $durasikerja;
			}
			$durasikerjasudahpulang = $jammasuk->diff($jammkeluar)->format('%H:%I');
			if ($jammkeluar != null) {
				$durasireal = $durasikerjasudahpulang;
			}else{
				$rumus = ($durasikerja*10)+10;
				$durasireal = $durasikerja;
			}
			$izin = $shows->absensi_izin;
			?>
			<!-- batas -->
			<div class="col-sm-12 col-md-3">
				<div class="row">
				<!-- default -->
				<?php
				if($jammasukreal==null){
				?>
					<center>
						<div id="myStat{{ $shows->id }}" data-dimension="200" data-text="<?php echo $durasireal; ?>" data-info="Durasi Kerja" data-width="20" data-fontsize="38" data-percent="<?php if($durasireal==""){ $rumus=0; } else{echo $rumus; }?>" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-category="transition"></div>
					</center>

					<center><b class="name">{{ $shows->absensi_nama_lengkap }}</b>

					<br>Jam Masuk : <?php echo $jammasukreal; ?>
					<br>Jam Keluar : <?php echo $jamkeluar; ?>
					
					<br><div class="label label-primary"><?php echo $izin; ?></div><br><br>

				<?php
				}elseif($jammasukreal<='08.00'){
				?>
				<!-- default-->

					<center>
						<div id="myStat{{ $shows->id }}" data-dimension="200" data-text="<?php echo $durasireal; ?>" data-info="Durasi Kerja" data-width="20" data-fontsize="38" data-percent="<?php if($durasireal==""){ $rumus=0; } else{echo $rumus; }?>" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-category="transition"></div>
					</center>

					<center><b class="name">{{ $shows->absensi_nama_lengkap }}</b>

					<br>Jam Masuk : <?php echo $jammasukreal; ?>
					<br>Jam Keluar : <?php echo $jamkeluar; ?>
					
					<br><div class="label label-success">Datang Tepat Waktu</div><br><br>
				<?php
				}elseif($jammasukreal>'08.00'){
				?>
					<center>
						<div id="myStat{{ $shows->id }}" data-dimension="200" data-text="<?php echo $durasireal; ?>" data-info="Durasi Kerja" data-width="20" data-fontsize="38" data-percent="<?php if($durasireal==""){ $rumus=0; } else{echo $rumus; }?>" data-fgcolor="#d9534f" data-bgcolor="#eee" data-category="transition"></div>
					</center>

					<center><b class="name">{{ $shows->absensi_nama_lengkap }}</b>

					<br>Jam Masuk : <?php echo $jammasukreal; ?>
					<br>Jam Keluar : <?php echo $jamkeluar; ?>
					
					<br><div class="label label-danger">Datang Terlambat</div><br><br>
				<?php
				}
				?>

				</div><!-- row -->
			</div><!-- col -->
		@endforeach

		</div><!-- col -->


	</div><!-- row1-->
</div><!--first container -->

<a href="#0" class="cd-top">Top</a>


<!-- all script -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/nprogress.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/foundation-datepicker.min.js') }}"></script>

<!-- other script here -->
<script>
$( document ).ready(function() {
	<?php 
	for($a=1; $a<=$untuk_row;$a++){
	?>
		$('#myStat<?php echo $a; ?>').circliful();
	<?php
	}
	?>
    });
</script>

<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
</script>

<script>
			$(function () {
				window.prettyPrint && prettyPrint();
				$('#dp1').fdatepicker({
					format: 'dd-mm-yyyy',
					disableDblClickSelection: true
				});
				$('#dp2').fdatepicker({
					closeButton: true
				});
				$('#dp3').fdatepicker();
				$('#dp3').fdatepicker();
				$('#dp-margin').fdatepicker();
				$('#dpMonths').fdatepicker();
				var startDate = new Date(2012, 1, 20);
				var endDate = new Date(2012, 1, 25);
				$('#dp4').fdatepicker()
					.on('changeDate', function (ev) {
					if (ev.date.valueOf() > endDate.valueOf()) {
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#dp4').data('date'));
					}
					$('#dp4').fdatepicker('hide');
				});
				$('#dp5').fdatepicker()
					.on('changeDate', function (ev) {
					if (ev.date.valueOf() < startDate.valueOf()) {
						$('#alert').show().find('strong').text('The end date can not be less then the start date');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#dp5').data('date'));
					}
					$('#dp5').fdatepicker('hide');
				});
				// implementation of disabled form fields
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				var checkin = $('#dpd1').fdatepicker({
					onRender: function (date) {
						return date.valueOf() < now.valueOf() ? 'disabled' : '';
					}
				}).on('changeDate', function (ev) {
					if (ev.date.valueOf() > checkout.date.valueOf()) {
						var newDate = new Date(ev.date)
						newDate.setDate(newDate.getDate() + 1);
						checkout.update(newDate);
					}
					checkin.hide();
					$('#dpd2')[0].focus();
				}).data('datepicker');
				var checkout = $('#dpd2').fdatepicker({
					onRender: function (date) {
						return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
					}
				}).on('changeDate', function (ev) {
					checkout.hide();
				}).data('datepicker');
			});
		</script>
</body>
</html>

