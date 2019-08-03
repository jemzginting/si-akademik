<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Profil Mahasiswa</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2">
							<i class="far fa-user fa-8x text-gray-300"></i>
						</div>
						<div class="col-lg-9">
							<table cellpadding="2">
								<tr>
									<td class="h6 font-weight-bold text-primary" width="220">Nama</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['name']; ?></td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Alamat</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['alamat']; ?></td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Tempat Lahir</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['tempat_lahir']; ?> </td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Tanggal Lahir</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['tgl_lahir']; ?></td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Agama</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['agama']; ?></td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Jenis Kelamin</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['jenis_kelamin']; ?></td>
								</tr>
								<tr>
									<td class="h6 font-weight-bold text-primary">Prodi</td>
									<td class="h6 font-weight-bold text-primary">: <?= $getInfo['nama_prodi']; ?></td>
								</tr>
							</table>
							<br>
							<div class="form-group">
								<button type="button" name="pilih_mk" id="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ProfileModal">Edit Profil</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- Modal Reply -->
<div class="modal fade bd-example-modal-lg" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form id="edit_profile" class="user" method="POST">
						<table cellpadding="2">
							<tr>
								<div class="form-group">
									<label>Nama : </label>
									<input type="text" class="form-control" id="nama" value="<?= $getInfo['name']; ?>" name="name">
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<label>Alamat : </label>
									<input type="text" class="form-control" id="alamat" value="<?= $getInfo['alamat']; ?>" name="alamat">
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<label>Tempat Lahir : </label>
									<input type="text" class="form-control" id="tempat_lahir" value="<?= $getInfo['tempat_lahir']; ?> " name="tempat_lahir">
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<label>Tanggal Lahir : </label>
									<input type="date" class="form-control" id="tanggal_lahir" value="<?= $getInfo['tgl_lahir']; ?>" name="tgl_lahir">
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<label>Agama : </label>
									<select class="form-control" id="agama" name="agama">
										<option value="Islam" selected>ISLAM</option>
										<option value="Protestan">PROTESTAN</option>
										<option value="Katholik">KATHOLIK</option>
										<option value="Budha">BUDHA</option>
										<option value="Hindu">HINDU</option>
									</select>
								</div>
							</tr>
							<tr>
								<div class="form-group">
									<label>Jenis Kelamin : </label>
									<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
										<option value="Laki-laki" selected>LAKI-LAKI</option>
										<option value="Perempuan">PEREMPUAN</option>
									</select>
								</div>
							</tr>

						</table>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="btn_simpan" id="btn_simpan">Edit Profile</button>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- End of Main Content -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>


<script type="text/javascript" language="javascript">
	$('#btn_simpan').click(function() {
		var update_data = $('#edit_profile').serialize();

		$.ajax({
			url: "<?php echo site_url('MemberControl/edit_profile'); ?>",
			type: "POST",
			data: update_data,

			success: function(data) {
				//console.log("data");
				load_data();
				$('ProfileModal').modal('hide');
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
</script>