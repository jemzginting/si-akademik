<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Chat Laporan Pelayanan</h1> -->
	<div class="row">
		<!-- DataTales Example -->
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Jadwal Mata Kuliah</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered" id="mengajar_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%">
											<center>No</center>
										</th>
										<th width="20%">
											<center>Kode</center>
										</th>
										<th width="20%">
											<center>Nama Matakuliah</center>
										</th>
										<th width="15%">
											<center>Hari</center>
										</th>
										<th width="20%">
											<center>Jam Mulai</center>
										</th>
										<th width="20%">
											<center>Jam Pulang</center>
										</th>
										<th>
											<center>SKS</center>
										</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.container-fluid -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$('#mengajar_tabel').DataTable();
		load_data();

	});
</script>

<script type="text/javascript" language="javascript">
	function load_data() {
		var x = $('#mengajar_tabel').DataTable();

		$.ajax({

			url: '<?php echo site_url("DosenControl/get_jadwal_pribadi") ?>',
			dataType: "JSON",

			success: function(data) {
				x.clear().draw();
				var HTMLbuilder = "";
				for (var i = 0; i < data.length; i++) {
					x.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['kode_huruf'] + " " + data[i]['kode_angka'] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['hari'] + "</center>",
						"<center>" + data[i]['jam_mulai'] + "</center>",
						"<center>" + data[i]['jam_selesai'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",


					]).draw();
				}
			}
		});
	}
</script>