<?php $date = date('Y'); ?>

<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" align="center">Kartu Rencana Studi </h1>
    <h2 align="center"> Semester - <?php echo $smt ?> </h2>

    <!-- DataTales Example -->


    <div class="table-responsive">
        <p> Nama : <?php echo $profile['name'] ?> </p>
        <p> NIM : <?php echo $profile['username'] ?> </p>
        <p> Program Studi : <?php echo $profile['nama_prodi'] ?> </p>
        <table class="table table-bordered" border="1" id="rekap_konsultasi" width="100%">
            <thead>
                <tr>
                    <td>
                        <center>No</center>
                    </td>
                    <td>
                        <center>Mata Kuliah</center>
                    </td>
                    <td>
                        <center>Kode MK </center>
                    </td>
                    <td>
                        <center>SKS</center>
                    </td>

                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                foreach ($list as $row) :

                    ?>
                    <tr>

                        <td>
                            <center><?php echo $i + 1 ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['nama_mk'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['kode_huruf'] . " " . $row['kode_angka'] ?></center>
                        </td>
                        <td>
                            <center><?php echo $row['sks'] ?></center>
                        </td>


                    </tr>
                    <?php
                    $i++;
                endforeach ?>
            </tbody>
        </table>
        <p> Jumlah SKS : <?php echo $info['jlh_sks'] ?> </p>
    </div>


</div>