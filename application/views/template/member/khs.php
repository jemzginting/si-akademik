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
						<div class="col-lg-2">
							<form id="khs_form" class="" method="POST">
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

								<button type="button" name="cetak_krs" id="" class="btn btn-sm btn-danger" onclick="cetak_rekap();">Cetak</button>
							</div>
							<table class="table table-bordered" id="khs_tabel" width="100%">
								<thead>
									<tr>
										<th width="1%" rowspan="2">
											<center>No</center>
										</th>
										<th width="40%" colspan="2">
											<center>Mata Kuliah</center>
										</th>
										<th width="5%" rowspan="2">
											<center>Jumlah Kredit (K)</center>
										</th>
										<th width="5%" rowspan="2">
											<center>Nilai</center>
										</th>
										<th width="5%" rowspan="2">
											<center>Bobot (B)</center>
										</th>
										<th width="5%" rowspan="2">
											<center>K x B</center>
										</th>
									</tr>
									<tr>
										<th width="15%">
											<center>Kode</center>
										</th>
										<th width="25%">
											<center>Nama</center>
										</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
							<p type=text id="sks"> </p>
							<p type=text id="kxb"> </p>
							<p type=text id="ip"> </p>
							<p type=text id="ipk"><b>Indeks Prestasi Kumulatif (IPK) = <?= $getInfo['ipk'] ?></b></p>
							<p type=text id="sks"><b>Jumlah SKS Yang Telah Ditempuh = <?= $getInfo['sks'] ?></b></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /.container-fluid -->

<!-- Modal Reply -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#khs_tabel').DataTable();
		load_data();


	});


	function load_data() {
		var x = $('#khs_tabel').DataTable();
		postData = $('#khs_form').serialize();
		$.ajax({

			url: '<?php echo site_url("MemberControl/get_khs_pribadi") ?>',
			dataType: "JSON",
			type: "GET",
			data: postData,
			success: function(data) {
				x.clear().draw();
				var HTMLbuilder = "";
				var jlh_sks = 0;
				var jlh_kxb = 0;
				var ip = 0;
				for (var i = 0; i < data.length; i++) {

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

					if (!data[i]['grade']) {
						data[i]['grade'] = "-";
						var kxb = "-";
					} else {
						var num = parseInt(data[i]['sks']);
						jlh_sks = jlh_sks + num;
						var b = parseInt(data[i]['grade']);
						var kxb = num * b;
						jlh_kxb = jlh_kxb + kxb;
					}


					x.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['kode_huruf'] + " " + data[i]['kode_angka'] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + nilai + "</center>",
						"<center>" + data[i]['grade'] + "</center>",
						"<center>" + kxb + "</center>",

					]).draw();
				}
				ip = jlh_kxb / jlh_sks;
				if (!ip) {
					ip = 0;
				}
				$("#sks").html("<b>Jumlah SKS = " + jlh_sks + "</b>");
				$("#kxb").html("<b>Total K x B = " + jlh_kxb + "</b>");
				$("#ip").html("<b>Indeks Prestasi (IP) = " + ip + "</b>");
			}
		});
	}

	function cetak_rekap() {
		id = '<?php echo $session['username'] ?>';
		smt = $('#semester').val();

		window.open("<?php echo base_url(); ?>CetakControl/khs_pdf/" + id + "/" + smt, '_blank');
	}
</script>