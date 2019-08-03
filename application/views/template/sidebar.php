<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-image: linear-gradient(to bottom right, #a41e00, #e46f27);">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <!--href="<?= base_url('auth/index'); ?>-->
                <div class="sidebar-brand-icon">
                        <img class="img-profile" src="<?= base_url('assets/'); ?>img/download.png" style="width: 50px; height: 50px;">
                        <!-- <i class="fas fa-fw fa-building"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">Universitas Palembang</div>
        </a>

        <?php if ($session['role_id'] == 1) { ?>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Nav Item - Dashboard -->
                <div class="sidebar-heading">
                        Admin
                </div>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('AdminControl/dashboard'); ?>">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('AdminControl/setting_user'); ?>">
                                <i class="fas fa-fw fa-user-plus"></i>
                                <span>Sistem Pengguna</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('AdminControl/matakuliah'); ?>">
                                <i class="fas fa-fw fa-book-open"></i>
                                <span>Mata Kuliah</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('AdminControl/input_khs'); ?>">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Kartu Hasil Studi</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('AdminControl/jadwal_kuliah'); ?>">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Jadwal Kuliah</span></a>
                </li>
        <?php } else if ($session['role_id'] == 2) { ?>


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                        User
                </div>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('MemberControl/dashboard'); ?>">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('MemberControl/myprofile'); ?>">
                                <i class="fas fa-fw fa-address-card"></i>
                                <span>My Profile</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('MemberControl/krs'); ?>">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Kartu Rencana Studi</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('MemberControl/khs'); ?>">
                                <i class="fas fa-fw fa-book"></i>
                                <span>Kartu Hasil Studi</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('MemberControl/transkrip'); ?>">
                                <i class="fas fa-fw fa-book-open"></i>
                                <span>Transkrip Nilai</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('MemberControl/setting'); ?>">
                                <i class="fas fa-fw fa-key"></i>
                                <span>Setting</span>
                        </a>
                </li>
        <?php } else if ($session['role_id'] == 3) { ?>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                        User
                </div>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('DosenControl/dashboard'); ?>">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('DosenControl/profile'); ?>">
                                <i class="fas fa-fw fa-address-card"></i>
                                <span>My Profile</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('DosenControl/jadwal_mengajar'); ?>">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Jadwal Mengajar</span>
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('DosenControl/setting'); ?>">
                                <i class="fas fa-fw fa-key"></i>
                                <span>Setting</span>
                        </a>
                </li>


        <?php  } ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
                <a class="nav-link" href="<?= base_url('MainControl/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Log Out</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->