<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("_partials/head.php") ?>    
</head>

<body id="page-top">
    <div id="wrapper">
        <?php $this->load->view("_partials/sidebar.php") ?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Main Content -->
            <div id="content">
                <?php $this->load->view("_partials/navbar.php") ?>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php
                                $titleTipe = ($tipe_data=="KEL") ? "Keluarga" : "Identik";
                            ?>
                            <h6 class="m-0 font-weight-bold text-primary">Filter Data Ganda <?php echo $titleTipe;?> Penerima Bansos Pangan</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <form class="user" name="frmEditDataGanda" method="post" action="<?php echo base_url().'transaksi/update'; ?>">
                                            <input type="hidden" name="tipe_data" id="tipe_data" value="<?php echo $tipe_data;?>">
                                            <div class="form-group">
                                                <label>NIK KTP</label>
                                                <input type="text" class="form-control form-control-sm" name="nik_ktp" id="nik_ktp" value="<?php echo $user[0]->NIK_KTP;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Penerima</label>
                                                <input type="text" class="form-control form-control-sm" name="nm_penerima" id="nm_penerima" value="<?php echo $user[0]->NAMA_PENERIMA;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Kartu</label>
                                                <input type="text" class="form-control form-control-sm" name="no_kartu" id="no_kartu" value="<?php echo $user[0]->NOMOR_KARTU;?>" readonly>
                                            </div>                                            
                                            <div class="form-group">
                                                <label>NO KK</label>
                                                <input type="text" class="form-control form-control-sm" name="no_kk" id="no_kk" value="<?php echo $user[0]->NOKK_DTKS;?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>ID Keluarga</label>
                                                <input type="text" class="form-control form-control-sm" id="idkeluarga" name="idkeluarga" value="<?php echo $user[0]->IDKELUARGA;?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>ID ART BDT</label>
                                                <input type="text" class="form-control form-control-sm" id="idartbdt" name="idartbdt" value="<?php echo $user[0]->IDARTBDT;?>" readonly>
                                            </div>
                                            <!--<div class="form-group">
                                                <label>ID Pengurus</label>
                                                <input type="text" class="form-control form-control-sm" name="id_pengurus" id="id_pengurus" value="<?php echo $user[0]->ID_PENGURUS;?>">
                                            </div>-->
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" readonly><?php echo $user[0]->ALAMAT;?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <input type="text" class="form-control form-control-sm" name="provinsi" id="provinsi" value="<?php echo $user[0]->NMPROP;?>" readonly>                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Kabupaten/Kota</label>     
                                                <input type="text" class="form-control form-control-sm" name="kab_kota" id="kab_kota" value="<?php echo $user[0]->NMKAB;?>" readonly>                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" value="<?php echo $user[0]->NMKEC;?>" readonly>
                                            </div>
                                            <!--<div class="form-group">
                                                <label>Kelurahan</label>
                                                <select name="kel_desa" id="kel_desa" class="form-control form-control-sm select4" onchange="getKelurahan()">
                                                    <option></option>
                                                    <?php
                                                        foreach($kelurahan as $kel_desa){
                                                            $selected = ($kel_desa->NMKELURAHAN==$user[0]->NMKEL) ? "selected" : "";
                                                    ?>
                                                    <option value="<?php echo $kel_desa->NMKELURAHAN;?>" <?php echo $selected;?>><?php echo $kel_desa->NMKELURAHAN;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>ID BDT</label>
                                                <input type="text" class="form-control form-control-sm" id="idbdt" name="idbdt" value="<?php echo $user[0]->IDBDT;?>">
                                            </div>-->                                            
                                            <!--<div class="form-group">
                                                <label>Nama DTKS</label>
                                                <input type="text" class="form-control form-control-sm" id="nmdtks" name="nmdtks" value="<?php echo $user[0]->NAMA_DTKS;?>">
                                            </div>-->                                                                                        
                                            <div class="form-group">
                                                <label>Keterangan Tambahan</label>
                                                <input type="text" class="form-control form-control-sm" name="ket_tambahan" id="ket_tambahan" value="<?php echo ($user[0]->STATUS_BARU!="") ? $user[0]->STATUS_BARU : $user[0]->KET_TAMBAHAN;?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Baru</label>
                                                <select name="status_baru" id="status_baru" required class="form-control form-control-sm select4">
                                                    <option></option>                                                    
                                                    <option value="CLEAN" <?php if($user[0]->STATUS_BARU=="CLEAN") echo "selected";?>>CLEAN</option>
                                                    <option value="UNCLEAN" <?php if($user[0]->STATUS_BARU=="UNCLEAN") echo "selected";?>>UNCLEAN</option>
                                                    <option value="NONAKTIF" <?php if($user[0]->STATUS_BARU=="NONAKTIF") echo "selected";?>>NON AKTIF</option>
                                                </select>
                                            </div>
                                            <?php
                                                if($tipe_data=="KEL"){
                                                    $page = "transaksi";
                                                } elseif($tipe_data=="IDT"){
                                                    $page = "transaksi/ganda_identik";
                                                }
                                            ?>
                                            <div class="form-group">                                                
                                                <a href="<?php echo base_url().$page;?>" class="btn btn-sm btn-secondary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-arrow-left"></i>
                                                    </span>
                                                    <span class="text">Kembali</span>
                                                </a>
                                                
                                                <input type="submit" value="Update Data" name="btn_submit" id="btn_submit" class="btn btn-sm btn-primary btn-default">
                                            </div>
                                            <hr>                    
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list_data_ganda" style="margin-top: -50px"></div>
                    </div>                        
                </div>
                
                <!-- Sticky Footer -->
                <?php $this->load->view("_partials/footer.php") ?>
            </div>
        </div>
    </div>
    
    <?php $this->load->view("_partials/scrolltop.php") ?>
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
    <script>                
        //$("#list_data_ganda").load("<?php echo base_url()?>transaksi/list_data");
        
    </script>
</body>
</html>