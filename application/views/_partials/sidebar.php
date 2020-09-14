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
    <li class="nav-item <?php if($menu=="download" || $menu=="upload") echo "active";?>">
        <a class="nav-link <?php if($menu!="download" && $menu!="upload") echo "collapsed";?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?php if($menu=="laporan" && $menu=="summary") echo "false"; else echo "true";?>" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file"></i>
            <span>Surat Permohonan</span>
        </a>
        <div id="collapseTwo" class="<?php if($menu=="download" || $menu=="upload") echo "collapse show"; else echo "collapse";?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">            
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/download_surat">Unduh Template</a>
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/upload_surat">Unggah Permohonan</a>
                <a class="collapse-item" href="<?php echo base_url();?>transaksi/daftar_surat">Daftar Permohonan</a>
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
    
    <li class="nav-item <?php if ($menu=="laporan" || $menu=="summary") echo "active";?>">
        <a class="nav-link <?php if($menu!="laporan" && $menu!="summary") echo "collapsed";?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?php if($menu=="laporan" && $menu=="summary") echo "false"; else echo "true";?>" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-bars"></i>
            <span>Data Ganda Penduduk</span>
        </a>
        <div id="collapseTwo" class="<?php if($menu=="laporan" || $menu=="summary") echo "collapse show"; else echo "collapse";?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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