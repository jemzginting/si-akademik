<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Chat Laporan Pelayanan</h1> -->
	<div class="row">
		<!-- DataTales Example -->
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Kartu Hasil Studi</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="khs_form" class="">
								<div class="form-group col-md-2 btn-sm">
									<select class="form-control" id="prodi_id" name="prodi_id" onclick="load_data();">
										<option value="1">Manajemen</option>
										<option value="2">Hukum</option>
									</select>
								</div>
								<div class="form-group col-md-2 btn-sm">
									<select class="form-control" id="semester" name="semester" onclick="load_data();">
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
							</form>
							<table class="table table-bordered table-responsive" id="khs_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%">
											<center>No</center>
										</th>
										<th width="20%">
											<center>NIM </center>
										</th>
										<th width="20%">
											<center>Nama Mahasiswa </center>
										</th>
										<th width="20%">
											<center>Matakuliah</center>
										</th>
										<th width="5%">
											<center>SKS</center>
										</th>
										<th width="5%">
											<center>Semester </center>
										</th>
										<th width="20%">
											<center>Nama Prodi </center>
										</th>
										<th width="20%">
											<center>Nama Dosen</center>
										</th>
										<th width="20%">
											<center>Grade</center>
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
<div class="modal fade bd-example-modal-xl" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<h3>Input Nilai KHS</h3>
					<form id="nilai_form" class="user" method="POST">


						<input type="hidden" class="form-control" id="id_ks" name="id_ks" value="">


						<div class="form-group">
							<label for="nama_permohonan">Grade : </label>
							<select class="form-control" id="grade" name="grade">
								<option value="" selected> Pilih Grade</option>
								<option value="4">A</option>
								<option value="3">B</option>
								<option value="2">C</option>
								<option value="1">D</option>
								<option value="0">E</option>

							</select>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_update" id="btn_update" onclick="update();">Update Nilai</button>
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
		$('#rekap_konsultasi').DataTable();
		$('#rekap_konsultasi1').DataTable();
	});
</script>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#khs_tabel').DataTable();
		load_data();


	});


	function load_data() {
		var x = $('#khs_tabel').DataTable();
		postData = $('#khs_form').serialize();
		$.ajax({

			url: '<?php echo site_url("AdminControl/get_all_khs") ?>',
			dataType: "JSON",
			type: "GET",
			data: postData,
			success: function(data) {
				x.clear().draw();

				for (var i = 0; i < data.length; i++) {
					//var btn1 = '<a href = "#" target="_blank" name="btn_cetak" id="' + data[i]['no_konsul'] + '" class="btn btn-xs btn-primary btn_cetak">Cetak PDF</a>';
					var btn1 = '<button type="button" name="btn_edit" id="' + data[i]['id_ks'] + '" class="btn btn-xs btn-primary btn_edit" data-toggle="modal" data-target="#EditModal">Edit</button>';
					//	var btn2 = '<a href="<?php echo site_url('CetakControl/generatePDFFile') ?>" target="_blank" class="pull-right btn btn-primary btn-xs" style="margin: 2px;"><i class="fa fa-plus"></i> Cetak PDF</a>';
					if (!data[i]['grade']) {
						nilai = "F";
					} else if (data[i]['grade'] == 0) {
						nilai = "E";
					} else if (data[i]['grade'] == 1) {
						nilai = "D";
					} else if (data[i]['grade'] == 2) {
						nilai = "C";
					} else if (data[i]['grade'] == 3) {
						nilai = "B";
					} else if (data[i]['grade'] == 4) {
						nilai = "A";
					}

					x.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nim'] + "</center>",
						"<center>" + data[i]['nama_mhs'] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + data[i]['semester'] + "</center>",
						"<center>" + data[i]['nama_prodi'] + "</center>",
						"<center>" + data[i]['nama_dosen'] + "</center>",
						"<center>" + nilai + " " + btn1 + "</center>",

					]).draw();
				}
			}
		});
	}

	function update() {
		postData = $('#nilai_form').serialize();
		$.ajax({

			url: '<?php echo site_url("AdminControl/update_nilai") ?>',
			dataType: "JSON",
			type: "POST",
			data: postData,
			success: function(data) {
				load_data();
				swal({
					title: 'Update Nilai Berhasil',
					text: '',
					type: 'success'
				});
			}
		});
	}



	$('#khs_tabel').ready(function() {
		load_data();

		$(document).on("click", ".btn_edit", function() {
			var id = $(this).attr('id');
			$('#id_ks').val(id);

		});



	});
</script>