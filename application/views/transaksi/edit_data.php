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
                            <h6 class="m-0 font-weight-bold text-primary">Filter Data Ganda Penerima Bansos Pangan</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <form class="user" name="frmEditDataGanda" method="post" action="<?php echo base_url().'transaksi/update'; ?>">                                            
                                            <div class="form-group">
                                                <label>Nama Penerima</label>
                                                <input type="text" class="form-control" name="nm_penerima" id="nm_penerima" value="<?php echo $user[0]->NAMA_PENERIMA;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Kartu</label>
                                                <input type="text" class="form-control" name="no_kartu" id="no_kartu" value="<?php echo $user[0]->NOMOR_KARTU;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK KTP</label>
                                                <input type="text" class="form-control" name="nik_ktp" id="nik_ktp" value="<?php echo $user[0]->NIK_KTP;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>ID Pengurus</label>
                                                <input type="text" class="form-control" name="id_pengurus" id="id_pengurus" value="<?php echo $user[0]->ID_PENGURUS;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat"><?php echo $user[0]->ALAMAT;?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-control select1" onchange="list_of_kab()">  
                                                    <option></option>
                                                    <?php
                                                        foreach($provinsi as $prov){
                                                            $selected = ($prov->NMPROVINSI==$user[0]->NMPROP) ? "selected" : "";
                                                    ?>
                                                    <option value="<?php echo $prov->NMPROVINSI;?>" <?php echo $selected;?>><?php echo $prov->NMPROVINSI;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kabupaten/Kota</label>      
                                                <select name="kab_kota" id="kab_kota" class="form-control select2" onchange="list_of_kec()">
                                                    <option></option>
                                                    <?php
                                                        foreach($kab_kota as $kab){
                                                            $selected = ($kab->NMKABKOTA==$user[0]->NMKAB) ? "selected" : "";
                                                    ?>
                                                    <option value="<?php echo $kab->NMKABKOTA;?>" <?php echo $selected;?>><?php echo $kab->NMKABKOTA;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select name="kecamatan" id="kecamatan" class="form-control select3" onchange="list_of_kel()">
                                                    <option></option>
                                                    <?php
                                                       foreach($kecamatan as $kec){
                                                           $selected = ($kec->NMKECAMATAN == $user[0]->NMKEC) ? "selected" : "";
                                                    ?>
                                                    <option value="<?php echo $kec->NMKECAMATAN;?>" <?php echo $selected;?>><?php echo $kec->NMKECAMATAN;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <select name="kel_desa" id="kel_desa" class="form-control select4" onchange="getKelurahan()">
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
                                                <input type="text" class="form-control" id="idbdt" name="idbdt" value="<?php echo $user[0]->IDBDT;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>ID ART BDT</label>
                                                <input type="text" class="form-control" id="idartbdt" name="idartbdt" value="<?php echo $user[0]->IDARTBDT;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama DTKS</label>
                                                <input type="text" class="form-control" id="nmdtks" name="nmdtks" value="<?php echo $user[0]->NAMA_DTKS;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>ID Keluarga</label>
                                                <input type="text" class="form-control" id="idkeluarga" name="idkeluarga" value="<?php echo $user[0]->IDKELUARGA;?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Keterangan Tambahan</label>
                                                <select name="ket_tambahan" id="ket_tambahan" class="form-control select4">
                                                    <option></option>                                                    
                                                    <option value="CLEAN" <?php if($user[0]->KET_TAMBAHAN=='CLEAN') echo "selected";?>>CLEAN</option>
                                                    <option value="UNCLEAN" <?php if($user[0]->KET_TAMBAHAN=='UNCLEAN') echo "selected";?>>UNCLEAN</option>
                                                    <option value="NONAKTIF" <?php if($user[0]->KET_TAMBAHAN=='NONAKTIF') echo "selected";?>>NON AKTIF</option>                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">                                                
                                                <a href="<?php echo base_url().'transaksi';?>" class="btn btn-secondary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-arrow-left"></i>
                                                    </span>
                                                    <span class="text">KEMBALI</span>
                                                </a>
                                                
                                                <input type="submit" value="Update Data" name="btn_submit" id="btn_submit" class="btn btn-primary btn-default">
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