<?php $date = date('Y'); ?>

<div class="container-fluid">
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-2 text-gray-800">Rekapan Konsultasi</h1> -->
	<div class="row">
		<div class="col-xl-12">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-default">DAFTAR PRESTASI AKADEMIK</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive" id="transkrip_tabel" width="100%">
							<thead>
								<tr>
									<th width="1%" rowspan="2">
										<center>No</center>
									</th>
									<th width="10%" rowspan="2">
										<center>Mata Kuliah</center>
									</th>
									<th width="5%" rowspan="2">
										<center>Kode Mata Kuliah</center>
									</th>
									<th colspan="4" width="40%">
										<center>PRESTASI</center>
									</th>
								</tr>
								<tr>
									<td width="5%">
										<center>HM</center>
									</td>
									<td width="5%">
										<center>AM</center>
									</td>
									<td width="5%">
										<center>K</center>
									</td>
									<td width="5%">
										<center>M</center>
									</td>
								</tr>
							</thead>
							<tbody>

							</tbody>

						</table>
						<p type=text id="mutu"> </p>
						<p type=text id="ipk"><b>Indeks Prestasi Kumulatif (IPK) = <?= $getInfo['ipk'] ?></b></p>
						<p type=text id="sks"><b>Jumlah Kredit Kumulatif = <?= $getInfo['sks'] ?></b></p>
						<button type="button" name="cetak_krs" id="" class="btn btn-sm btn-danger" onclick="cetak_rekap();">Cetak</button>
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

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#transkrip_tabel').DataTable();
		load_data();


	});


	function load_data() {
		var x = $('#transkrip_tabel').DataTable();

		$.ajax({

			url: '<?php echo site_url("MemberControl/get_transkrip_pribadi") ?>',
			dataType: "JSON",
			type: "GET",

			success: function(data) {
				x.clear().draw();
				var HTMLbuilder = "";
				var jlh_kxb = 0;
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

						var b = parseInt(data[i]['grade']);
						var kxb = num * b;
						jlh_kxb = jlh_kxb + kxb;
					}

					x.row.add([
						"<center>" + [i + 1] + "</center>",
						"<center>" + data[i]['nama_mk'] + "</center>",
						"<center>" + data[i]['kode_huruf'] + " " + data[i]['kode_angka'] + "</center>",
						"<center>" + nilai + "</center>",
						"<center>" + data[i]['grade'] + "</center>",
						"<center>" + data[i]['sks'] + "</center>",
						"<center>" + kxb + "</center>",
					]).draw();
				}
				$("#mutu").html("<b>Jumlah Mutu = " + jlh_kxb + "</b>");
			}
		});
	}

	function cetak_rekap() {
		id = '<?php echo $session['username'] ?>';
		window.open("<?php echo base_url(); ?>CetakControl/transkrip_pdf/" + id, '_blank');
	}
</script>