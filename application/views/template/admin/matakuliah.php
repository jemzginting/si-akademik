<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Chat Laporan Pelayanan</h1> -->
	<div class="row">
		<!-- DataTales Example -->
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Mata Kuliah</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							<form id="matakuliah_form" class="" method="POST">
								<table class="table table-bordered" id="rekap_konsultasi">
									<thead>

									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<label for="nama_permohonan">Program Studi : </label>
													<select class="form-control" id="prodi" name="prodi" onchange="load_data()">
														<option value="1" selected>Manajemen</option>
														<option value="2">Hukum</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label for="nama_permohonan">Semester : </label>
													<select class="form-control" id="smt" name="smt" onclick="load_data()">
														<option value="1" selected>SEMESTER 1</option>
														<option value="2">SEMESTER 2</option>
														<option value="3">SEMESTER 3</option>
														<option value="4">SEMESTER 4</option>
														<option value="5">SEMESTER 5</option>
														<option value="6">SEMESTER 6</option>
														<option value="7">SEMESTER 7</option>
														<option value="8">SEMESTER 8</option>
													</select>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<div class="form-group">
													<button type="button" name="btn_terima" id="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Mk_Modal">Input Data</button>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
						<div class="col-lg-9">

							<table class="table table-bordered" id="matakuliah_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%">
											<center>No</center>
										</th>
										<th width="20%">
											<center>Kode Huruf</center>
										</th>
										<th width="20%">
											<center>Kode Angka</center>
										</th>
										<th width="20%">
											<center>Nama Matakuliah</center>
										</th>
										<th width="20%">
											<center>SKS</center>
										</th>
										<th width="20%">
											<center>Program Studi</center>
										</th>
										<th width="20%">
											<center>Semester</center>
										</th>
										<th width="20%">
											<center>Aksi</center>
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

<!-- Modal Reply -->
<div class="modal fade bd-example-modal-xl" id="Mk_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Matakuliah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h3>Input Mata Kuliah</h3>
					<form id="mk_form" class="user" method="POST">
						<div class="form-group">
							<label for="nama_permohonan">Kode Huruf Mata Kuliah : </label>
							<input type="text" class="form-control" id="kode_huruf" value="" name="kode_huruf">
						</div>
						<div class="form-group">
							<label for="nama_permohonan">Kode Angka Mata Kuliah : </label>
							<input type="number" class="form-control" id="kode_angka" value="" name="kode_angka">
						</div>
						<div class="form-group">
							<label>Nama Mata Kuliah : </label>
							<input type="text" class="form-control" id="nama_mk" name="nama_mk">
						</div>
						<div class="form-group">
							<label>SKS : </label>
							<input type="number" class="form-control" id="sks" name="sks">
						</div>
						<div class="form-group">
							<label for="nama_permohonan">Program Studi : </label>
							<select class="form-control" id="prodi_id" name="prodi_id">
								<option value="1" selected>Manajemen</option>
								<option value="2">Hukum</option>
							</select>
						</div>
						<div class="form-group">
							<label for="nama_permohonan">Semester : </label>
							<select class="form-control" id="semester" name="semester">
								<option value="1" selected>SEMESTER 1</option>
								<option value="2">SEMESTER 2</option>
								<option value="3">SEMESTER 3</option>
								<option value="4">SEMESTER 4</option>
								<option value="5">SEMESTER 5</option>
								<option value="6">SEMESTER 6</option>
								<option value="7">SEMESTER 7</option>
								<option value="8">SEMESTER 8</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_simpan" id="btn_simpan">Tambah Mata
							Kuliah</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#matakuliah_tabel').DataTable();

	});



	function load_data() {
		var c = $('#matakuliah_tabel').DataTable();
		postData = $('#matakuliah_form').serialize();
		$.ajax({

			url: '<?php echo site_url("AdminControl/get_all_matakuliah") ?>',
			dataType: "JSON",
			type: "GET",
			data: postData,
			success: function(data) {
				c.clear().draw();
				var HTMLbuilder = "";
				for (var i = 0; i < data.length; i++) {
					//var btn1 = '<a href = "#" target="_blank" name="btn_cetak" id="' + data[i]['no_konsul'] + '" class="btn btn-xs btn-primary btn_cetak">Cetak PDF</a>';
					var btn1 = '<button type="button" name="btn_delete" id="' + data[i]['id_mk'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';
					//	var btn2 = '<a href="<?php echo site_url('CetakControl/generatePDFFile') ?>" target="_blank" class="pull-right btn btn-primary btn-xs" style="margin: 2px;"><i class="fa fa-plus"></i> Cetak PDF</a>';

					c.row.add([

						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['kode_huruf'] + "</center>",
						"<center>" + data[i]['kode_angka'] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + data[i]['nama_prodi'] + "</center>",
						"<center>" + data[i]['semester'] + "</center>",
						"<center>" + btn1 + "</center>",
					]).draw();
				}
			}
		});
	}



	$('#matakuliah_tabel').ready(function() {
		load_data();
		$(document).on("click", ".btn_delete", function() {
			var id_mk = $(this).attr('id');
			swal({
					title: "Hapus Shift",
					text: "Apakah anda yakin akan menghapus data shift ini?",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: "Hapus",
					closeOnConfirm: true,
				},
				function() {
					$.ajax({
						url: "<?php echo site_url('AdminControl/hapus_mk'); ?>",
						method: "POST",
						data: {
							id_mk: id_mk
						},
						success: function(data) {
							load_data();
							swal({
								title: 'Hapus Mata Kuliah Berhasil',
								text: '',
								type: 'success'
							});
						}
					});
				});
		});

		$('#btn_simpan').click(function() {
			var update_data = $('#mk_form').serialize();
			console.log(update_data);
			$.ajax({
				url: "<?php echo site_url('AdminControl/input_matakuliah'); ?>",
				type: "POST",
				data: update_data,

				success: function(data) {
					//console.log("data");
					load_data();
					$('Mk_Modal').modal('hide');
					//	load_data();
					swal({
						title: 'Berhasil Disimpan',
						text: '',
						type: 'success'
					});

				},
				error: function(status) {
					swal({
						title: 'Gagal',
						text: '',
						type: 'danger'
					});
				}
			});
		});

	});
</script>