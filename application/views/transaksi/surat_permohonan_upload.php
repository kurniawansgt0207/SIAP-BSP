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
                            <h6 class="m-0 font-weight-bold text-primary">Upload Pengesahan Validasi Data Ganda</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">                                    
                                    <div class="p-4">
                                    <div class="text-info text-center text-capitalize">
                                    </div>
                                        <form class="user" name="frmUploadSurat">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-control form-control-sm select1">  
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
                                            <input type="hidden" name="kab_kotax" id="kab_kotax" value="">                                            
                                            <div class="form-group">                                                
                                                <input type="button" value="Tampilkan Data" name="btn_tampil" id="btn_tampil" class="btn btn-sm btn-info" onclick="showData()"> 
                                                <!--<input type="button" value="Download Surat" name="btn_tampil" id="btn_tampil" class="btn btn-sm btn-warning" onclick="downloadSurat()">-->
                                                <a href="<?php echo base_url().'assets/template_doc/Template_Surat_Permohonan_SIAPBSP.docx';?>" target="_blank" class="btn btn-sm btn-warning">Download Word (.docx)</a>
                                            </div>
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div id="list_data_register_show" style="margin-top: -50px"></div>
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
        
        function showData(){
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;     
            var url = "<?php echo base_url()?>transaksi/list_register_data_perbaikan";    
            if(prov==""){
                alert("Pilih Provinsi Lebih Dulu.");
                return false;
            }            
            document.getElementById("btn_tampil").disabled=true;
            
            $.ajax({
                type:"POST",
                data:{prov:prov,kab:kab},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_data_register_show').html(data); 
                        document.getElementById("btn_tampil").disabled=false;
                    }
                }   

            }); 
        }
        
        function upload_surat_pengesahan(id){
            var url = "<?php echo base_url()?>transaksi/upload_surat_pengesahan/"+id;
            window.location = url;
        }
        
        function downloadData(id){
            var url = "<?php echo base_url()?>transaksi/download_data/"+id;
            window.open(url,'_blank');
        }       
        
        function downloadSurat(){
            var url = "<?php echo base_url()?>transaksi/download_surat_permohonan/";
            window.open(url,'_blank');
        }
    </script>
</body>
</html>