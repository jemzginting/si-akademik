<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Chat Laporan Pelayanan</h1> -->
	<div class="row">
		<!-- DataTales Example -->
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">Kartu Rencana Studi</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2">
							<form id="krs_form" class="" method="POST">
								<table class="table table-bordered" id="rekap_konsultasi">
									<thead>

									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<label>Semester : </label>
													<select class="form-control" id="semester" name="semester" onclick="load_data()">
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
								<button type="button" name="pilih_mk" id="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#BalasModal">Pilih Mata Kuliah</button>
								<button type="button" name="cetak_krs" id="" class="btn btn-sm btn-danger" onclick="cetak_rekap()">Cetak</button>
							</div>
							<table class="table table-bordered" id="krs_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%">
											<center>No</center>
										</th>
										<th width="20%">
											<center>Matakuliah</center>
										</th>
										<th width="15%">
											<center>Hari</center>
										</th>
										<th width="5%">
											<center>SKS</center>
										</th>
										<th width="20%">
											<center>Semester</center>
										</th>
										<th width="20%">
											<center>Prodi</center>
										</th>
										<th width="5%">
											<center>Jam Masuk</center>
										</th>
										<th width="5%">
											<center>Jam Pulang</center>
										</th>
										<th width="20%">
											<center>Dosen</center>
										</th>
										<th width="10%">
											<center>Aksi</center>
										</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>

							<p type=text id="sks"> </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.container-fluid -->

<!-- Modal Reply -->
<div class="modal fade bd-example-modal-lg" id="BalasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Input Mata Kuliah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form id="pilih_form" class="user" method="POST">
						<table class="table table-bordered" id="pilih_jadwal" width="100%">
							<thead>
								<tr>
									<th width="1%">
										<center>Pilih</center>
									</th>
									<th width="1%">
										<center>No</center>
									</th>
									<th width="20%">
										<center>Matakuliah</center>
									</th>
									<th width="15%">
										<center>Hari</center>
									</th>
									<th width="5%">
										<center>SKS</center>
									</th>
									<th width="20%">
										<center>Semester</center>
									</th>
									<th width="20%">
										<center>Prodi</center>
									</th>
									<th width="5%">
										<center>Jam Masuk</center>
									</th>
									<th width="5%">
										<center>Jam Pulang</center>
									</th>
									<th width="20%">
										<center>Dosen</center>
									</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
						<button type="submit" class="btn btn-primary btn_ambil" name="ambil_mk" id="ambil_mk" onclick="insert()">Ambil Mata
							kuliah</button>
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
		$('#krs_tabel').DataTable();
		load_data();
		load_pilih();

	});




	function load_data() {
		var x = $('#krs_tabel').DataTable();
		postData = $('#krs_form').serialize();
		$.ajax({

			url: '<?php echo site_url("MemberControl/get_jadwal_pribadi") ?>',
			dataType: "JSON",
			type: "GET",
			data: postData,
			success: function(data) {
				x.clear().draw();
				var jlh_sks = 0;
				for (var i = 0; i < data.length; i++) {

					if (!data[i]['grade']) {
						var btn1 = '<button type="button" name="btn_delete" id="' + data[i]['id_ks'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';
					} else {
						var btn1 = "-";
					}

					var num = parseInt(data[i]['sks']);
					jlh_sks = jlh_sks + num;

					x.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['hari'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + data[i]['semester'] + "</center>",
						"<center>" + data[i]['nama_prodi'] + "</center>",
						"<center>" + data[i]['jam_mulai'] + "</center>",
						"<center>" + data[i]['jam_selesai'] + "</center>",
						"<center>" + data[i]['nama_dosen'] + "</center>",
						"<center>" + btn1 + "</center>",
					]).draw();
				}

				$("#sks").html("<b>Jumlah SKS Yang Diambil = " + jlh_sks + "</b>");
			}
		});
	}

	function insert() {
		postData = $('#pilih_form').serialize();
		$.ajax({

			url: '<?php echo site_url("MemberControl/ambil_mk_pilih") ?>',
			dataType: "JSON",
			type: "POST",
			data: postData,
			success: function(data) {
				load_data();
				load_pilih();
			}
		});
	}

	function cetak_rekap() {
		id = '<?php echo $session['username'] ?>';
		smt = $('#semester').val();

		window.open("<?php echo base_url(); ?>CetakControl/krs_pdf/" + id + "/" + smt, '_blank');
	}



	$('#pilih_jadwal').ready(function() {
		load_pilih();

		var c = $('#pilih_jadwal').DataTable();

		function load_pilih() {
			//	postData = $('pilih_form').serialize();
			$.ajax({

				url: '<?php echo site_url("MemberControl/get_all_jadwal") ?>',
				dataType: "JSON",
				type: "GET",
				//	data: postData,
				success: function(data) {
					c.clear().draw();
					var HTMLbuilder = "";
					for (var i = 0; i < data.length; i++) {
						//var btn1 = '<a href = "#" target="_blank" name="btn_cetak" id="' + data[i]['no_konsul'] + '" class="btn btn-xs btn-primary btn_cetak">Cetak PDF</a>';
						// var btn1 = '<button type="button" name="btn_delete" id="' + data[i]['id_jadwal'] + '" class="btn btn-xs btn-danger btn_delete">Hapus</button>';
						//	var btn2 = '<a href="<?php echo site_url('CetakControl/generatePDFFile') ?>" target="_blank" class="pull-right btn btn-primary btn-xs" style="margin: 2px;"><i class="fa fa-plus"></i> Cetak PDF</a>';

						var check = '<input type="checkbox" name="checkbox[]" id="' + data[i]['id_jadwal'] + '" value="' + data[i]['id_jadwal'] + '" class="checkitem">';
						c.row.add([
							"<center>" + check + "</center>",
							"<center>" + [i + 1] + "</center>",
							"<center>" + data[i]['nama_mk'] + "</center>",
							"<center>" + data[i]['hari'] + "</center>",
							"<center>" + data[i]['sks'] + "</center>",
							"<center>" + data[i]['semester'] + "</center>",
							"<center>" + data[i]['nama_prodi'] + "</center>",
							"<center>" + data[i]['jam_mulai'] + "</center>",
							"<center>" + data[i]['jam_selesai'] + "</center>",
							"<center>" + data[i]['nama_dosen'] + "</center>",

							//"<center>" + btn1 + "</center>",
						]).draw();
					}
				}
			});
		}



		$('#krs_tabel').ready(function() {
			load_data();

			$(document).on("click", ".btn_delete", function() {
				var id = $(this).attr('id');
				swal({
						title: "Hapus Shift",
						text: "Apakah anda yakin akan menghapus KRS ini?",
						type: "warning",
						showCancelButton: true,
						confirmButtonText: "Hapus",
						closeOnConfirm: true,
					},
					function() {
						$.ajax({
							url: "<?php echo site_url('MemberControl/hapus_krs'); ?>",
							method: "POST",
							data: {
								id: id
							},
							success: function(data) {
								//	$('#krs_tabel').html(data);
								//	$('#pilih_jadwal').html(data);
								load_data();
								load_pilih();
								swal({
									title: 'Hapus KRS Berhasil',
									text: '',
									type: 'success'
								});
							}
						});
					});
			});



		});




	});
</script>