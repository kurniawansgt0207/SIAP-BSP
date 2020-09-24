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
                            <h6 class="m-0 font-weight-bold text-primary">Upload Surat Permohonan Validasi Data Ganda</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
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
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-control form-control-sm select1" onchange="list_of_kab()">  
                                                    <option></option>
                                                    <?php
                                                        foreach($provinsi as $prov){
                                                    ?>
                                                    <option value="<?php echo $prov->NMPROVINSI;?>"><?php echo $prov->NMPROVINSI;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kabupaten/Kota</label>      
                                                <input type="hidden" name="kab_kotax" id="kab_kotax" value="">
                                                <div id="list_kab">--Pilih Kabupaten/Kota--</div>                                               
                                            </div>
                                            <div class="form-group">
                                                <label>No Register (Upload Data Perbaikan)</label>
                                                <select name="noregister" id="noregister" class="form-control form-control-sm select1">  
                                                    <option></option>
                                                    <?php
                                                        foreach($noregister as $noreg){
                                                    ?>
                                                    <option value="<?php echo $noreg->NO_REGISTER;?>"><?php echo $noreg->NO_REGISTER;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Upload Surat Permohonan</label>
                                                <input type="file" class="form-control form-control-sm" id="surat_permohonan" name="surat_permohonan" accept="application/pdf">
                                            </div>
                                            <div class="form-group">
                                                <label>Upload Lampiran Dokumen</label>
                                                <input type="file" class="form-control form-control-sm" id="lampiran_dokumen" name="lampiran_dokumen" accept="application/pdf">
                                            </div>
                                            <div class="form-group">                                                
                                                <input type="submit" value="Kirim Data" name="btn_kirim" id="btn_kirim" class="btn btn-sm btn-default btn-info">                                                
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
        function list_of_kab(){
            var prov = document.getElementById('provinsi').value;                        
            var url = "<?php echo base_url()?>transaksi/list_of_kab";

            $.ajax({
                type:"POST",
                data:{prov:prov},
                url:url,
                success:function(data){ 
                     if(data){
                     $('#list_kab').html(data); 
                     }
                }   

            });            
        }
        
        function list_of_kec(){
            var kab = document.getElementById('kab_kota').value;
            document.getElementById('kab_kotax').value = kab;            
        }
    </script>
</body>
</html>