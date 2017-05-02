<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CRUD Data</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url('') ?>assets/datatables.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" href="#">Hello World</a>
								</div>
						
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">
									<ul class="nav navbar-nav">
										<li class=""><a href="<?php echo site_url('pegawai') ?>">Biodata Pegawai</a></li>
										<li class=""><a href="<?php echo site_url('anak/create/'.$this->uri->segment(3)); ?>">Tambah Data Anak</a></li>
									</ul>
								</div><!-- /.navbar-collapse -->
						</div>
						</nav>

					</div>	
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h1>Daftar Anak</h1>	
						<div class="table-responsive">
							<table class="table table-hover" id="example">
								<thead>
									<tr>
										<th>Nama Pegawai</th>
										<th>Nama Anak</th>
										<th>Tanggal Lahir</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($anak_list as $key) { ?>
									<tr>
										<td><?php echo $key->namaPegawai ?> <a href="<?php echo site_url('anak/update/').$key->id ?>"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </a> <a href="<?php echo site_url('anak/delete/').$key->id ?>"> <span class="glyphicon glyphicon-trash" aria-hidden="true" onClick="return doconfirm();"></span> </a></td>
										<td><?php echo $key->namaAnak ?></td>
										<td><?php echo $key->tanggalLahir ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>


		<script>
		function doconfirm()
		{
    		job=confirm("Are you sure to delete this data permanently?");
    		if(job!=true)
    		{
        		return false;
    		}
		}
		</script>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url('') ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('') ?>assets/datatables.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
 		<script src="Hello World"></script>
 		<script type="text/javascript">
		$(document).ready(function()
		{
			$('#example').DataTable();
		} );
		</script>
	</body>
</html>