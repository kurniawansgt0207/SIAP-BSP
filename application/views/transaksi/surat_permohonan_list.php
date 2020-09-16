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
                            <h6 class="m-0 font-weight-bold text-primary">Cek Surat Permohonan Validasi Data Ganda</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">                                    
                                    <div class="p-4">
                                    <div class="text-info text-center text-capitalize">
                                    <?php
                                        $message = $this->session->flashdata('pesan');
                                        echo $message;
                                        echo form_open_multipart('transaksi/submit_upload_surat');
                                    ?>
                                    </div>
                                        <form class="user" name="frmDaftarSurat">
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
                                                <input type="button" value="Tampilkan Data" name="btn_show" id="btn_show" onclick="showData()" class="btn btn-sm btn-info">
                                            </div>
                                        </form>
                                    </div>                                    
                                </div>                                
                            </div>
                        </div>
                        <div id="list_surat_permohonan" style="margin-top: -50px"></div>
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
            var prop = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;
            var url = "<?php echo base_url()?>transaksi/daftar_surat_list";

            $.ajax({
                type:"POST",
                data:{prov:prop,kab:kab},
                url:url,
                success:function(data){ 
                     if(data){
                     $('#list_surat_permohonan').html(data); 
                     }
                }   

            }); 
        }
    </script>
</body>
</html>