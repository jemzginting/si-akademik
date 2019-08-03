<?php $date = date('Y'); ?>

<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" align="center">Kartu Hasil Studi </h1>
    <h2 align="center"> Semester - <?php echo $smt ?> </h2>

    <!-- DataTales Example -->


    <div class="table-responsive">
        <p> Nama : <?php echo $profile['name'] ?> </p>
        <p> NIM : <?php echo $profile['username'] ?> </p>
        <p> Program Studi : <?php echo $profile['nama_prodi'] ?> </p>
        <table class="table table-bordered" border="1" id="rekap_konsultasi" width="100%">
            <thead>
                <tr>
                    <td align="center" rowspan="2">No</td>
                    <td align="center" colspan="2">Mata Kuliah</td>
                    <td align="center" rowspan="2">Jumlah Kredit (K)</td>
                    <td align="center" rowspan="2">Nilai (A-E)</td>
                    <td align="center" rowspan="2">Bobot (B) (0-4)</td>
                    <td align="center" rowspan="2">K x B</td>

                </tr>
                <tr>
                    <td align="center">Kode</td>
                    <td align="center">Nama</td>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                $jlh_kxb = 0;
                $jlh_sks = 0;
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
                        $jlh_sks = $jlh_sks +  $row['sks'];
                        $kxb = $row['sks'] * $row['grade'];
                        $jlh_kxb = $jlh_kxb + $kxb;
                    }

                    ?>
                    <tr>

                        <td>
                            <center><?php echo $i + 1 ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['kode_huruf'] . " " . $row['kode_angka'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['nama_mk'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['sks'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $nilai ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['grade'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $kxb ?></center>
                        </td>


                    </tr>
                    <?php
                    $i++;
                endforeach ?>
            </tbody>
        </table>
        <?php $ip = $jlh_kxb / $jlh_sks; ?>
        <p> Jumlah SKS : <?php echo $jlh_sks ?> </p>
        <p> Total K x B: <?php echo  $jlh_kxb ?> </p>
        <p><b> Indeks Prestasi (IP) : <?php echo $ip ?> </b> </p>
        <p><b> Indeks Prestasi Kumulatif (IPK) : <?php echo $info['ipk'] ?> </b> </p>
        <p> Jumlah SKS Yang Telah Ditempuh: <?php echo $info['sks'] ?> </p>

    </div>


</div>