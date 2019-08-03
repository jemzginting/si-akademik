<?php $date = date('Y'); ?>

<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" align="center">DAFTAR PRESTASI AKADEMIK </h1>


    <!-- DataTales Example -->


    <div class="table-responsive">
        <p> Nama : <?php echo $profile['name'] ?> </p>
        <p> NIM : <?php echo $profile['username'] ?> </p>
        <p> Program Studi : <?php echo $profile['nama_prodi'] ?> </p>
        <table class="table table-bordered" border="1" width="100%">
            <thead>
                <tr>
                    <th rowspan="2" align="center">No</th>
                    <th rowspan="2" align="center">Mata Kuliah</th>
                    <th rowspan="2" align="center">Kode Mata Kuliah</th>
                    <th colspan="4" align="center">Prestasi</th>
                </tr>
                <tr>
                    <td align="center">HM</td>
                    <td align="center">AM</td>
                    <td align="center">K</td>
                    <td align="center">M</td>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                $jlh_kxb = 0;

                foreach ($list as $row) :

                    if (empty($row['grade'])) {
                        $nilai = "F";
                    } else if ($row['grade'] == 4) {
                        $nilai = "A";
                    } else if ($row['grade'] == 3) {
                        $nilai = "B";
                    } else if ($row['grade'] == 2) {
                        $nilai = "C";
                    } else if ($row['grade'] == 1) {
                        $nilai = "D";
                    } else if ($row['grade'] == 0) {
                        $nilai = "E";
                    }

                    if (empty($row['grade'])) {
                        $row['grade'] = "-";
                        $kxb = "-";
                    } else {

                        $kxb = $row['sks'] * $row['grade'];
                        $jlh_kxb = $jlh_kxb + $kxb;
                    }

                    ?>
                    <tr>

                        <td align="center">
                            <center><?php echo $i + 1 ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $row['kode_huruf'] . " " . $row['kode_angka'] ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $row['nama_mk'] ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $row['sks'] ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $nilai ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $row['grade'] ?></center>
                        </td>
                        <td align="center">
                            <center><?php echo $kxb ?></center>
                        </td>


                    </tr>
                    <?php
                    $i++;
                endforeach ?>
            </tbody>
        </table>

        <p> Jumlah Mutu: <?php echo  $jlh_kxb ?> </p>

        <p><b> Indeks Prestasi Kumulatif (IPK) : <?php echo $info['ipk'] ?> </b> </p>
        <p> Jumlah SKS Yang Telah Ditempuh: <?php echo $info['sks'] ?> </p>

    </div>


</div>