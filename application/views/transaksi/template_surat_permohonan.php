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
                            <h6 class="m-0 font-weight-bold text-primary">Template Surat Permohonan Validasi Data Ganda</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <form class="user" name="frmSuratPermohonan" method="post" target="_blank" action="<?php echo base_url();?>transaksi/submit_surat_permohonan">                                            
                                            <div class="form-group">
                                                <label>Tanggal Permohonan</label>
                                                <input type="text" class="form-control" id="tgl_permohonanx" name="tgl_permohonanx" value="<?php echo date("d M Y");?>" disabled>
                                                <input type="hidden" class="form-control" id="tgl_permohonan" name="tgl_permohonan" value="<?php echo date("Y-m-d");?>">                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pemohon</label>
                                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Isi Nama Pemohon">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP Pemohon</label>
                                                <input type="text" class="form-control" id="nip_pemohon" name="nip_pemohon" placeholder="Isi NIP Pemohon">
                                            </div>
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
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input type="hidden" name="kecamatanx" id="kecamatanx" value="">
                                                <div id="list_kec">--Pilih Kecamatan--</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <input type="hidden" name="kel_desax" id="kel_desax" value="">
                                                <div id="list_kel">--Pilih Kelurahan--</div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Jumlah Data CLEAN</label>
                                                <input type="text" class="form-control" id="jml_clean" name="jml_clean" placeholder="Isi Jumlah Data CLEAN">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Data UNCLEAN</label>
                                                <input type="text" class="form-control" id="jml_unclean" name="jml_unclean" placeholder="Isi Jumlah Data UNCLEAN">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Data NON AKTIF</label>
                                                <input type="text" class="form-control" id="jml_nonaktif" name="jml_nonaktif" placeholder="Isi Jumlah Data NON AKTIF">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Simpan Surat Permohonan" name="btn_simpan" id="btn_simpan" class="btn btn-default btn-info">
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
                
    </script>
</body>
</html>