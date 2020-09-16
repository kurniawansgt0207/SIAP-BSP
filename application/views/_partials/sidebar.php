<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url();?>">
        <div class="sidebar-brand-icon rotate-n-15" style="margin-top:20px">
            <i class="fas"><img src="<?php echo base_url();?>assets/img/logo_kemensos.png" width="40" height="40"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kementerian Sosial RI</div>        
    </a>
    <div class="sidebar-brand-text" style="text-align: center; color: white; font-size: 12px; margin-top: -10px; margin-left: 40px; padding-bottom: 5px">
        <span>Direktorat PFM Wilayah I</span>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($menu=="dashboard") echo "active";?>">
        <a class="nav-link" href="<?php echo base_url();?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Transaksi
    </div>
    
    <li class="nav-item <?php if ($menu=="transaksi") echo "active";?>">
        <a class="nav-link" href="<?php echo base_url();?>transaksi">
            <i class="fas fa-fw fa-folder"></i>
            <span>Filter Data Ganda</span>
        </a>
    </li>
    <?php
        $classActive_1 = ($menu=="download" || $menu=="upload") ? "active" : "";
        $classActive_2 = ($menu=="laporan" || $menu=="summary") ? "active" : "";
        $classCollapsed_1 = ($menu=="download" && $menu=="upload") ? "" : "collapsed";
        $classCollapsed_2 = ($menu=="laporan" && $menu=="summary") ? "" : "collapsed";
        $classExpand_1 = ($menu=="download" && $menu=="upload") ? "false" : "true";
        $classExpand_2 = ($menu=="laporan" && $menu=="summary") ? "false" : "true";
        $classCollapseShow_1 = ($menu=="download" || $menu=="upload") ? "collapse show" : "collapse";
        $classCollapseShow_2 = ($menu=="laporan" || $menu=="summary") ? "collapse show" : "collapse";
    ?>
    <li class="nav-item <?php echo $classActive_1;?>">
        <a class="nav-link <?php echo $classCollapsed_1;?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?php echo $classExpand_1;?>" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file"></i>
            <span>Surat Permohonan</span>
        </a>
        <div id="collapseTwo" class="<?php echo $classCollapseShow_1;?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">            
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/download_surat">Unduh Template</a>
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/upload_surat">Unggah Permohonan</a>
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/daftar_surat">Cek Permohonan</a>
            </div>
        </div>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Laporan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    
    <li class="nav-item <?php echo $classActive_2;?>">
        <a class="nav-link <?php echo $classCollapsed_2;?>" href="#" data-toggle="collapse" data-target="#collapseTwox" aria-expanded="<?php echo $classCollapsed_2;?>" aria-controls="collapseTwox">
            <i class="fas fa-fw fa-bars"></i>
            <span>Data Ganda Penduduk</span>
        </a>
        <div id="collapseTwox" class="<?php echo $classCollapseShow_2;?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">            
                <a class="collapse-item" href="<?php echo base_url();?>laporan/summary_data">Summary</a>
                <a class="collapse-item" href="<?php echo base_url();?>laporan">Detail</a>
            </div>
        </div>
    </li>        

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->