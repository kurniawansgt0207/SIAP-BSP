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
                                        <form class="user" name="frmEditPermohonan" method="post" action="<?php echo base_url().'transaksi/update_status_surat'; ?>">
                                            <input type="hidden" name="id_surat" id="id_surat" value="<?php echo $data_surat[0]->id;?>">
                                            <div class="form-group">
                                                <label>Nama Pemohon</label>
                                                <input type="text" class="form-control" name="nm_pemohon" id="nm_pemohon" readonly value="<?php echo $data_surat[0]->nm_pemohon;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Permohonan</label>
                                                <input type="text" class="form-control" name="tgl_permohonan" readonly id="tgl_permohonan" value="<?php echo $data_surat[0]->tgl_permohonan;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <input type="text" class="form-control" name="nm_propinsi" id="nm_propinsi" readonly value="<?php echo $data_surat[0]->nm_propinsi;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Kabupaten/Kota</label>      
                                                <input type="text" class="form-control" name="nm_kabupaten" id="nm_kabupaten" readonly value="<?php echo $data_surat[0]->nm_kabupaten;?>">
                                            </div>                                            
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="radio">
                                                    <label style="cursor: pointer"><input type="radio" name="status_surat" id="status_surat" value="1" style="cursor: pointer" onclick="activeAlasan('1')">&nbsp;Terima</label>
                                                </div>
                                                <div class="radio">
                                                    <label style="cursor: pointer"><input type="radio" name="status_surat" id="status_surat" value="0" style="cursor: pointer" onclick="activeAlasan('0')">&nbsp;Tolak</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alasan ditolak</label>
                                                <textarea class="form-control" id="alasan_tolak" name="alasan_tolak" disabled cols="20" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pengecek</label>
                                                <input type="text" class="form-control" id="nm_pengecek" name="nm_pengecek" value="">
                                            </div>
                                            <div class="form-group">                                                
                                                <a href="<?php echo base_url().'transaksi/daftar_surat';?>" class="btn btn-secondary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-arrow-left"></i>
                                                    </span>
                                                    <span class="text">KEMBALI</span>
                                                </a>
                                                
                                                <input type="submit" value="Update Status" name="btn_submit" id="btn_submit" class="btn btn-primary btn-default">
                                            </div>
                                            <hr>                    
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>                
                <?php $this->load->view("_partials/footer.php") ?>
            </div>
        </div>
    </div>
    
    <?php $this->load->view("_partials/scrolltop.php") ?>
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
    <script>
        function activeAlasan(val){
            if(val == 1){
                document.getElementById('alasan_tolak').disabled = true;
            } else {
                document.getElementById('alasan_tolak').disabled = false;                
            }
        }
    </script>
</body>
</html>