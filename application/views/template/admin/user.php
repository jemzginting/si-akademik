<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Rekapan Konsultasi</h1> -->
	<div class="row">
		<div class="col-xl-12">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Pengguna Sistem</h4>
				</div>
				<div class="card-body">
					<div class="form-group">
						<button type="button" name="tambah" id="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#InputUser_Modal"><i class="fas fa-user-plus fa-sm text-white-100"></i>Tambah
							Pengguna</button>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive" id="tambah_pengguna" width="100%">
							<thead>
								<tr>

									<th width="1%">
										<center>No</center>
									</th>
									<th width="20%">
										<center>Nama Lengkap</center>
									</th>
									<th width="20%">
										<center>Username</center>
									</th>
									<th width="20%">
										<center>Level</center>
									</th>
									<!-- <th width="20%">
								<center>Last Login</center>
							</th> -->
									<th width="20%">
										<center>Keterangan</center>
									</th>
									<th width="10%">
										<center></center>
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
<!-- /.container-fluid -->

<!-- Modal Reply -->
<div class="modal fade bd-example-modal-xl" id="InputUser_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="col-md-12">
					<h3>Tambah Pengguna Baru</h3>
					<form id="input_user_form" class="user" method="POST">
						<div class="form-group">
							<label>Nama Lengkap : </label>
							<input type="text" class="form-control" id="name" value="" name="name">
						</div>
						<div class="form-group">
							<label>username : </label>
							<input type="text" class="form-control" id="username" value="" name="username">

						</div>
						<div class="form-group">
							<label>password : </label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
						<div class="form-group">
							<label>Level : </label>
							<select class="form-control" id="level" name="level" onchange="pilih_role()">
								<option value="1">Admin</option>
								<option value="3">Dosen</option>
								<option value="2">Mahasiswa</option>

							</select>
						</div>
						<div class="form-group">
							<label id="label_jurusan">Jurusan : </label>
							<select class="form-control" id="jurusan" name="jurusan">
								<option value="0" selected>-</option>
								<option value="1">Manajemen</option>
								<option value="2">Ilmu Hukum</option>
							</select>
						</div>
						<button type="submit" class="btn btn-danger" name="btn_simpan" id="btn_simpan">Tambah</button>
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
		$('#tambah_pengguna').DataTable();
		$('#jurusan').hide();
		$('#label_jurusan').hide();
	});



	function pilih_role() {
		var jenis_role = $('#level').val();

		if (jenis_role > 1) {
			$('#label_jurusan').show();
			$('#jurusan').show();

		} else {
			$('#label_jurusan').hide();
			$('#jurusan').hide();
		}
	}

	$('#tambah_pengguna').ready(function() {
		var c = $('#tambah_pengguna').DataTable();
		load_data();

		function load_data() {
			$.ajax({

				url: '<?php echo site_url("AdminControl/get_all_pengguna") ?>',
				dataType: "JSON",
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					for (var i = 0; i < data.length; i++) {
						//var btn1 = '<a href = "#" target="_blank" name="btn_cetak" id="' + data[i]['no_konsul'] + '" class="btn btn-xs btn-primary btn_cetak">Cetak PDF</a>';
						var btn1 = '<button type="button" name="btn_delete" id="' + data[i]['username'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';
						//	var btn2 = '<a href="<?php echo site_url('CetakControl/generatePDFFile') ?>" target="_blank" class="pull-right btn btn-primary btn-xs" style="margin: 2px;"><i class="fa fa-plus"></i> Cetak PDF</a>';

						if (data[i]['role_id'] == 1) {
							status = "Admin";
						} else if (data[i]['role_id'] == 2) {
							status = "Mahasiswa";
						} else {
							status = "Dosen";
						}
						if (!data[i]['keterangan']) {
							data[i]['keterangan'] = "-"
						}

						c.row.add([

							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['name'] + "</center>",
							"<center>" + data[i]['username'] + "</center>",
							"<center>" + status + "</center>",
							"<center>" + data[i]['keterangan'] + "</center>",
							"<center>" + btn1 + "</center>",
						]).draw();
					}
				}
			});
		}

		$(document).on("click", ".btn_delete", function() {
			var username = $(this).attr('id');
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
						url: "<?php echo site_url('AdminControl/hapus_user'); ?>",
						method: "POST",
						data: {
							username: username
						},
						success: function(data) {
							load_data();
							swal({
								title: 'Hapus Jam Kerja Berhasil',
								text: '',
								type: 'success'
							});
						}
					});
				});
		});

		$('#btn_simpan').click(function() {
			var update_data = $('#input_user_form').serialize();
			console.log(update_data);
			$.ajax({
				url: "<?php echo site_url('AuthLogin/register'); ?>",
				type: "POST",
				data: update_data,

				//  dataType : 'json', //already make by datatype                 
				success: function(data) {
					//console.log("data");
					load_data();
					$('InputUser_Modal').modal('hide');
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