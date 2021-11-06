<?php
include 'functions.php';
// if(empty($_SESSION['login']))
//   header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Sistem Referensi Pemilihan Alternatif Android</title>
	<link rel="icon" href="assets/favicon.ico" />
	<link href="assets/css/cerulean-bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/general.css" rel="stylesheet" />
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/highcharts.js"></script>
	<script src="assets/js/exporting.js"></script>
	<script src="assets/js/highcharts-3d.js"></script>
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="?">FCM TOPSIS</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php if ($_SESSION['login']) : ?>
						<li><a href="?m=atribut"><span class="glyphicon glyphicon-th-large"></span> Atribut</a></li>
						<li class="dropdown">
							<a href="?m=alternatif" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-plus"></span> Alternatif <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="?m=alternatif"><span class="glyphicon glyphicon-plus"></span> Alternatif</a></li>
								<li><a href="?m=rel_alternatif"><span class="glyphicon glyphicon-star"></span> Nilai Alternatif</a></li>
							</ul>
						</li>
						<li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Perhitungan</a></li>
						<li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
						<li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					<?php else : ?>
						<li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Perhitungan</a></li>
						<li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<?php
		if (!$_SESSION['login'] && !in_array($mod, array('', 'home', 'hitung', 'login')))
			$mod = 'login';

		if (file_exists($mod . '.php'))
			include $mod . '.php';
		else
			include 'home.php';
		?>
	</div>
	<footer class="footer bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<p>Copyright &copy; <?= date('Y') ?> RumahSourceCode.Com</p>
				</div>
				<div class="col-md-6">
					<p><em class="pull-right">Updated 21 Oktober 2021</em></p>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>