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
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-control select1" onchange="list_of_kab()">  
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
                                            <!--<div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="hidden" name="kecamatanx" id="kecamatanx" value="">
                                                <div id="list_kec">--Pilih Kecamatan--</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <input type="hidden" name="kel_desax" id="kel_desax" value="">
                                                <div id="list_kel">--Pilih Kelurahan--</div>
                                            </div>-->
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <select name="ket_tambahan" id="ket_tambahan" class="form-control">
                                                    <option value="">--Semua Keterangan--</option>
                                                    <option value="CLEAN">CLEAN</option>
                                                    <option value="UNCLEAN">UNCLEAN</option>
                                                    <option value="NONAKTIF">NON AKTIF</option>
                                                </select>
                                            </div>                                            
                                            <div class="form-group">
                                                <input type="button" value="Cari Data" name="btn_submit" id="btn_submit" onclick="cari()" class="btn btn-primary btn-default">
                                                <input type="submit" value="Cetak Data" name="btn_cetak" id="btn_cetak" class="btn btn-default btn-danger">                                                
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
        $("#list_data_ganda").load("<?php echo base_url()?>transaksi/list_data");

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
            var url = "<?php echo base_url()?>transaksi/list_of_kec";

            $.ajax({
                type:"POST",
                data:{kab:kab},
                url:url,
                success:function(data){ 
                     if(data){
                     $('#list_kec').html(data); 
                     }
                }   

            });
        }

        function list_of_kel(){
            var kec = document.getElementById('kecamatan').value;
            document.getElementById('kecamatanx').value = kec;
            var url = "<?php echo base_url()?>transaksi/list_of_kel";

            $.ajax({
                type:"POST",
                data:{kec:kec},
                url:url,
                success:function(data){ 
                     if(data){
                     $('#list_kel').html(data); 
                     }
                }   

            });
        }
        
        function getKelurahan(){
            var kel = document.getElementById('kel_desa').value;
            document.getElementById('kel_desax').value = kel;
        }

        function cari(){
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;
            //var kec = document.getElementById('kecamatanx').value;
            //var kel = document.getElementById('kel_desax').value;
            var ket = document.getElementById('ket_tambahan').value;
            //var nik = document.getElementById('nik').value;
            //var nama = document.getElementById('nama').value;            
            var url = "<?php echo base_url()?>laporan/list_data";                        
            
            $.ajax({
                type:"POST",
                data:{prov:prov,kab:kab,ket:ket},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_data_ganda').html(data); 
                    }
                }   

            }); 
        }                
    </script>
</body>
</html>