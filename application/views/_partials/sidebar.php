<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url();?>dashboard">
        <div class="sidebar-brand-icon rotate-n-15" style="margin-top:20px">
            <i class="fas"><img src="<?php echo base_url();?>assets/img/logo_kemensos.png" width="40" height="40"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kementerian Sosial RI</div>        
    </a>
    <div class="sidebar-brand-text" style="text-align: center; color: white; font-size: 12px; margin-top: -10px; margin-left: 40px; padding-bottom: 5px">
        <span>Direktorat PFM Wilayah I</span>
    </div>

    <?php
        foreach ($menu_group_none as $mparent_none){
            $m_name = $mparent_none->module_name;
            $m_title = $mparent_none->module_title;
            $m_class = $mparent_none->class_icon;
            $m_group = $mparent_none->module_group;    
            $m_url = $mparent_none->module_url;
            $m_parent = $mparent_none->is_parent;
            
            $activeClass = ($menu==$m_name) ? "active" : "";
    ?>
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item <?php echo $activeClass;?>">
        <a class="nav-link" href="<?php echo base_url().$m_url;?>">
            <i class="fas fa-fw <?php echo $m_class;?>"></i>
            <span><?php echo $m_title;?></span>
        </a>
    </li>    
    <?php
        }
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
    <?php echo $menu_group_transaksi[0]->module_group;?>
    </div>
    <?php            
        foreach ($menu_group_transaksi as $mparent_trn){
            $m_name_trn = $mparent_trn->module_name;
            $m_title_trn = $mparent_trn->module_title;
            $m_class_trn = $mparent_trn->class_icon;
            $m_group_trn = strtolower($mparent_trn->module_group);  
            $m_url_trn = $mparent_trn->module_url;
            $m_parent_trn = $mparent_trn->is_parent;            
                    
            $child_menu = $this->Model_group_access->showChildMenuGroup($group_pengguna,$mparent_trn->id)->result();
            
            $classActive_1 = ($menu==$m_name_trn) ? "active" : "";            
            $classCollapsed_1 = (($menu==$m_name_trn)) ? "" : "collapsed";            
            $classExpand_1 = (($menu==$m_name_trn)) ? "false" : "true";            
            $classCollapseShow_1 = (($menu==$m_name_trn)) ? "collapse show" : "collapse";            
            $class_child = count($child_menu)>0 ? 'data-toggle="collapse" data-target="#collapseTwo" aria-expanded="'.$classExpand_1.'" aria-controls="collapseTwo"' : "";
            
    ?>
    <li class="nav-item <?php echo $classActive_1;?>">
        <a class="nav-link <?php echo $classCollapsed_1;?>" href="<?php echo base_url().$m_url_trn;?>" <?php echo $class_child;?>>
            <i class="fas fa-fw <?php echo $m_class_trn;?>"></i>
            <span><?php echo $m_title_trn;?></span>
        </a>
        <?php
            if(count($child_menu)>0){
        ?>
        <div id="collapseTwo" class="<?php echo $classCollapseShow_1;?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <?php
                foreach($child_menu as $c_trans){
                    $c_title_trn = $c_trans->module_title;
                    $c_class_trn = $c_trans->class_icon;                    
                    $c_url_trn = $c_trans->module_url;
            ?>
                <a class="collapse-item" href="<?php echo base_url().$c_url_trn;?>"><?php echo $c_title_trn;?></a>
            <?php
                }
            ?>
            </div>
        </div>
        <?php
            }
        ?>
    </li>    
    <?php
        }
    ?>        
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
    <?php echo $menu_group_laporan[0]->module_group;?>
    </div>
    <?php    
        foreach ($menu_group_laporan as $mparent_rpt){
            $m_name_rpt = $mparent_rpt->module_name;
            $m_title_rpt = $mparent_rpt->module_title;
            $m_class_rpt = $mparent_rpt->class_icon;
            $m_group_rpt = strtoupper($mparent_rpt->module_group);  
            $m_url_rpt = $mparent_rpt->module_url;
            $m_parent_rpt = $mparent_rpt->is_parent;
                        
            
                    
            $child_menu = $this->Model_group_access->showChildMenuGroup($group_pengguna,$mparent_rpt->id)->result();
            
            $classActive_2 = ($menu==$m_name_rpt) ? "active" : "";            
            $classCollapsed_2 = ($menu==$m_name_rpt) ? "" : "collapsed";            
            $classExpand_2 = ($menu==$m_name_rpt) ? "false" : "true";            
            $classCollapseShow_2 = ($menu==$m_name_rpt) ? "collapse show" : "collapse";            
            $class_child = count($child_menu) >0 ? 'data-toggle="collapse" data-target="#collapseTwo'.$mparent_rpt->id.'" aria-expanded="'.$classExpand_1.'" aria-controls="collapseTwo"' : "";
    ?>
    <li class="nav-item <?php echo $classActive_2;?>">
        <a class="nav-link <?php echo $classCollapsed_2;?>" href="<?php echo base_url().$m_url_rpt;?>" <?php echo $class_child;?>>
            <i class="fas fa-fw <?php echo $m_class_rpt;?>"></i>
            <span><?php echo $m_title_rpt;?></span>
        </a>
        <?php
            if(count($child_menu)>0){
        ?>
        <div id="collapseTwo<?php echo $mparent_rpt->id;?>" class="<?php echo $classCollapseShow_2;?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <?php
                foreach($child_menu as $c_report){
                    $c_title_rpt = $c_report->module_title;
                    $c_class_rpt = $c_report->class_icon;                    
                    $c_url_rpt = $c_report->module_url;
            ?>
                <a class="collapse-item" href="<?php echo base_url().$c_url_rpt;?>"><?php echo $c_title_rpt;?></a>
            <?php
                }
            ?>
            </div>
        </div>
        <?php
            }
        ?>
    </li>    
    <?php
        }
    ?>                 

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->