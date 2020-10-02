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
                            <h6 class="m-0 font-weight-bold text-primary">Rekap Data Ganda Penduduk</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <form class="user" name="frmRekapDataGanda" method="post" target="_blank" action="<?php echo base_url();?>laporan/export_pdf">
                                            <input type="hidden" name="tipe" id="tipe" value="<?php echo $tipe;?>">
                                            <input type="hidden" name="label" id="label" value="<?php echo $label;?>">
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
                                                <label>Tipe Data Ganda</label>      
                                                <select name="tipeData" id="tipeData" class="form-control form-control-sm">
                                                    <option value="A">-- Data Ganda Awal --</option>
                                                    <option value="B">-- Data Ganda Perbaikan --</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="button" value="Lihat Data" name="btn_submit" id="btn_submit" onclick="cari()" class="btn btn-primary btn-sm">                                                
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
        function list_of_kab(){
            var prov = document.getElementById('provinsi').value;                        
            var tipe = "A";
            var menu = "rpt_ganda_keluarga";
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

        function cari(){
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;  
            var ket = "";
            var tipe = document.getElementById('tipeData').value;
            var label = document.getElementById('label').value;
            if(prov==''){
                alert('Pilih Provinsi Lebih Dulu.');
                return false;
            }
            document.getElementById('btn_submit').disabled=true;            
            var kabVal = (kab=="") ? "0" : kab;
            
            var url = "<?php echo base_url()?>laporan/export_pdf/"+tipe+"/"+label+"/"+prov+"/"+kabVal;                        
            window.open(url,'_blank');
            document.getElementById('btn_submit').disabled=false;
            
            /*$.ajax({
                type:"POST",
                data:{prov:prov,kab:kab,ket:ket,tipe:tipe,label:label},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_data_ganda').html(data); 
                    }
                }   

            });*/ 
        }                
    </script>
</body>
</html>