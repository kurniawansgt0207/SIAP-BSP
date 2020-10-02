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
                            <h6 class="m-0 font-weight-bold text-primary">Pembuatan Pengesahan Perbaikan Data Ganda</h6>
                        </div>                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">                                    
                                    <div class="p-4">
                                    <div class="text-info text-center text-capitalize">
                                        <?php
                                            echo $message = $this->session->flashdata('pesan');                                        
                                        ?>
                                    </div>
                                        <form class="user" name="frmUploadData">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" required class="form-control form-control-sm select1">  
                                                    <option value=""></option>
                                                    <?php
                                                        foreach($provinsi as $prov){
                                                    ?>
                                                    <option value="<?php echo $prov->NMPROVINSI;?>"><?php echo $prov->NMPROVINSI;?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="kab_kotax" id="kab_kotax">
                                            <!--<div class="form-group">
                                                <label>Kabupaten/Kota</label>
                                                <input type="hidden" name="kab_kotax" id="kab_kotax">
                                                <div id="list_kab">--Pilih Kabupaten/Kota--</div>                                              
                                            </div>-->                                         
                                            <div class="form-group">                                                
                                                <input type="button" value="Tampilkan Data" name="btn_kirim" id="btn_kirim" onclick="showData()" class="btn btn-sm btn-default btn-info">
                                            </div>
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div id="list_data_perbaikan_show" style="margin-top: -50px"></div>
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
            var menu = "permohonon";
            var url = "<?php echo base_url()?>transaksi/list_of_kab";            
            document.getElementById("btn_kirim").disabled=true;

            $.ajax({
                type:"POST",
                data:{prov:prov,menu:menu},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_kab').html(data); 
                        document.getElementById("btn_kirim").disabled=false;
                    }
                }   

            });            
        }
        
        function list_of_kec(){
            var prov = document.getElementById('provinsi').value;  
            var kab = document.getElementById('kab_kota').value;
            document.getElementById('kab_kotax').value = kab;            
        }
        
        function showData(){
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;     
            var url = "<?php echo base_url()?>transaksi/list_data_perbaikan";    
            if(prov==""){
                alert("Pilih Provinsi Lebih Dulu.");
                return false;
            }            
            document.getElementById("btn_kirim").disabled=true;
            
            $.ajax({
                type:"POST",
                data:{prov:prov,kab:kab},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_data_perbaikan_show').html(data); 
                        document.getElementById("btn_kirim").disabled=false;
                    }
                }   

            }); 
        }                
    </script>
</body>
</html>