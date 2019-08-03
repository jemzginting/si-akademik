<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Chat Laporan Pelayanan</h1> -->
	<div class="row">
		<!-- DataTales Example -->
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Jadwal Kuliah</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2">
							<form id="jadwal_form" class="" method="POST">
								<table class="table table-bordered" id="rekap_konsultasi">
									<thead>

									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<label>Tahun Akademik : </label>
													<select class="form-control" id="tahun_akademik" name="tahun_akademik" onchange="load_data()">
														<option value="2019" selected>2019</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label>Program Studi : </label>
													<select class="form-control" id="program_studi" name="program_studi" onchange="load_data()">
														<option value="1" selected>Manajemen</option>
														<option value="2">Hukum</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label>Semester : </label>
													<select class="form-control" id="smt" name="smt" onchange="load_data()">
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

									</tbody>
								</table>
							</form>
						</div>
						<div class="col-lg-10">
							<div class="form-group">
								<button type="button" name="btn_terima" id="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#JadwalModal">Tambah Jadwal Kuliah</button>
							</div>
							<table class="table table-bordered" id="jadwal_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%">
											<center>No</center>
										</th>
										<th width="20%">
											<center>Matakuliah</center>
										</th>
										<th width="5%">
											<center>SKS</center>
										</th>
										<th width="5%">
											<center>Semester</center>
										</th>
										<th width="20%">
											<center>Prodi</center>
										</th>
										<th width="15%">
											<center>Hari</center>
										</th>
										<th width="5%">
											<center>Jam Masuk</center>
										</th>
										<th width="5%">
											<center>Jam Pulang</center>
										</th>
										<th width="5%">
											<center>Tahun</center>
										</th>
										<th width="20%">
											<center>Dosen</center>
										</th>
										<th width="5%">
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
<div class="modal fade bd-example-modal-lg" id="JadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Kuliah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h3>Input Jadwal Kuliah</h3>
					<form id="tambah_jadwal_kuliah" class="user" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Prodi : </label>
								<select class="form-control" id="prodi_id" name="prodi_id">
									<option value="">Pilih Prodi</option>
									<option value="1">Manajemen</option>
									<option value="2">Hukum</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Nama Matakuliah : </label>
								<select class="form-control" id="id_mk" name="id_mk">
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Dosen : </label>
								<select class="form-control" id="nip_dosen" name="nip_dosen">
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Tahun Akademik : </label>
								<select class="form-control" id="tahun" name="tahun">
									<option value="2019" selected>2019</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>SEMESTER : </label>
								<select class="form-control" id="semester" name="semester">
									<option selected>SEMESTER 1</option>
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

						</div>
						<div class="form-group">
							<label>Hari : </label>
							<select class="form-control" id="hari" name="hari">
								<option value="Senin" selected>Senin</option>
								<option value="Selasa">Selasa</option>
								<option value="Rabu">Rabu</option>
								<option value="Kamis">Kamis</option>
								<option value="Jumat">Jumat</option>
								<option value="Sabtu">Sabtu</option>
							</select>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Jam Masuk : </label>
								<input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
							</div>
							<div class="form-group col-md-6">
								<label>Jam Pulang : </label>
								<input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
							</div>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_simpan" id="btn_simpan">Tambah Jadwal
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

<script>
	$(document).ready(function() {
		$("#prodi_id").change(function() {
			var url = "<?php echo site_url('AdminControl/add_ajax_prodi'); ?>/" + $(this).val();
			var url2 = "<?php echo site_url('AdminControl/add_ajax_dosen'); ?>/" + $(this).val();
			$('#id_mk').load(url);
			$('#nip_dosen').load(url2);
			return false;
		})
	});
</script>

<script type="text/javascript" language="javascript">
	function load_data() {
		var c = $('#jadwal_tabel').DataTable();
		postData = $('#jadwal_form').serialize();
		$.ajax({

			url: '<?php echo site_url("AdminControl/get_all_jadwal") ?>',
			dataType: "JSON",
			type: "GET",
			data: postData,
			success: function(data) {
				c.clear().draw();
				var HTMLbuilder = "";
				for (var i = 0; i < data.length; i++) {
					//var btn1 = '<a href = "#" target="_blank" name="btn_cetak" id="' + data[i]['no_konsul'] + '" class="btn btn-xs btn-primary btn_cetak">Cetak PDF</a>';
					var btn1 = '<button type="button" name="btn_delete" id="' + data[i]['id_jadwal'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';
					//	var btn2 = '<a href="<?php echo site_url('CetakControl/generatePDFFile') ?>" target="_blank" class="pull-right btn btn-primary btn-xs" style="margin: 2px;"><i class="fa fa-plus"></i> Cetak PDF</a>';

					c.row.add([

						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",

						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + data[i]['semester'] + "</center>",
						"<center>" + data[i]['nama_prodi'] + "</center>",
						"<center>" + data[i]['hari'] + "</center>",
						"<center>" + data[i]['jam_mulai'] + "</center>",
						"<center>" + data[i]['jam_selesai'] + "</center>",
						"<center>" + data[i]['tahun'] + "</center>",
						"<center>" + data[i]['nama_dosen'] + "</center>",
						"<center>" + btn1 + "</center>",
					]).draw();
				}
			}
		});
	}



	$('#matakuliah_tabel').ready(function() {
		load_data();
		$(document).on("click", ".btn_delete", function() {
			var id = $(this).attr('id');
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
						url: "<?php echo site_url('AdminControl/hapus_jadwal'); ?>",
						method: "POST",
						data: {
							id: id
						},
						success: function(data) {
							load_data();
							swal({
								title: 'Hapus Jadwal Berhasil',
								text: '',
								type: 'success'
							});
						}
					});
				});
		});

		$('#btn_simpan').click(function() {
			var update_data = $('#tambah_jadwal_kuliah').serialize();
			console.log(update_data);
			$.ajax({
				url: "<?php echo site_url('AdminControl/input_jadwal'); ?>",
				type: "POST",
				data: update_data,

				success: function(data) {
					//console.log("data");
					load_data();
					$('JadwalModal').modal('hide');
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