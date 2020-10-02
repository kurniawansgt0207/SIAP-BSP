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
                            <h6 class="m-0 font-weight-bold text-primary">Upload Surat Permohonan Pengesahan</h6>
                        </div>
                        <div class="card-body p-4" style="margin-top:-35px; margin-bottom: -35px;">
                            <div class="row">
                                <div class="col-lg-8">                                    
                                    <div class="p-4">
                                    <div class="text-info text-center text-capitalize">
                                    <?php
                                        $message = $this->session->flashdata('pesan');
                                        echo $message;
                                        echo form_open_multipart('transaksi/submit_upload_surat');
                                    ?>
                                    </div>
                                        <form class="user" name="frmUploadSurat" action="<?php echo base_url();?>transaksi/submit_upload_surat">    
                                            <input type="hidden" name="id_register" id="id_register" value="<?php echo $id;?>">
                                            <div class="form-group">
                                                <label>No. Register Pengesahan</label>
                                                <input type="text" class="form-control form-control-sm" id="no_register" name="no_register" readonly value="<?php echo $register[0]->NO_REGISTER;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Data</label>
                                                <table class="table table-striped table-sm" id="dataTablex" width="100%" cellspacing="0">
                                                    <tr>
                                                        <th style="text-align: center">Clean</th>
                                                        <th style="text-align: center">Non Aktif</th>
                                                    </tr>
                                                    <?php
                                                    
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center"><?php echo number_format($register[0]->JML_CLEAN);?></td>
                                                        <td style="text-align: center"><?php echo number_format($register[0]->JML_NONAKTIF);?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label>Surat Permohonan</label>
                                                <input type="file" class="form-control form-control-sm" id="surat_permohonan" name="surat_permohonan" accept="application/pdf" onchange="enableBtn()">
                                            </div>
                                            <div class="form-group">                                                
                                                <input type="submit" value="Simpan Data" disabled name="btn_submit" id="btn_submit" class="btn btn-sm btn-info"> 
                                                <input type="button" value="Kembali" name="btn_back" id="btn_back" class="btn btn-sm btn-success" onclick="backPage()"> 
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
    <script>
        function enableBtn(){
            var fileDoc = document.getElementById('surat_permohonan').value;
            if(fileDoc!=""){
                document.getElementById('btn_submit').disabled=false;
            }
        }
        
        function backPage(){
            window.location = "<?php echo base_url();?>transaksi/upload_pengesahan";
        }
    </script>