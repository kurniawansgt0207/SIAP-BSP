<?php ini_set('display_errors','off'); ?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Unggah Surat Permohonan Validasi Data Ganda</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-12">                                    
                                    <div class="p-4">
                                    <div class="text-info text-center text-capitalize">
                                    <?php
                                        $message = $this->session->flashdata('pesan');
                                        echo $message;
                                    ?>
                                    </div>
                                        <form class="user" name="frmUploadSurat" enctype="multipart/form-data" action="<?php echo base_url();?>transaksi/submit_upload_surat">
                                            <div class="form-group">
                                                <label>Unggah Surat Permohonan</label>
                                                <input type="file" class="form-control" id="surat_permohonan" name="surat_permohonan" accept="application/pdf">
                                            </div>
                                            <div class="form-group">
                                                <label>Unggah Lampiran Dokumen</label>
                                                <input type="file" class="form-control" id="lampiran_dokumen" name="lampiran_dokumen" accept="application/pdf">
                                            </div>
                                            <div class="form-group">                                                
                                                <input type="submit" value="Kirim Data" name="btn_kirim" id="btn_kirim" class="btn btn-default btn-info">                                                
                                            </div>
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
    
</body>
</html>