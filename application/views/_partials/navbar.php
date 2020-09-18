<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas"><img src="<?php echo base_url();?>assets/img/logo_kemensos.png" width="40" height="40"></i>
    </div>
    <div class="sidebar-brand-text mx-3">
        Kementerian Sosial Republik Indonesia<br>
        <span style="font-size: 13px;">Direktorat PFM Wilayah I (<?php echo ($provinsi_pengguna!='') ? $provinsi_pengguna : "PUSAT";?>)</span>
    </div>
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">        
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $nama_pengguna;?><br>(<?php echo $group_pengguna;?>)
                </span>                
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->