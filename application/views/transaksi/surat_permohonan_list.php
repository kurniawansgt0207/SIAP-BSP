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
                            <h6 class="m-0 font-weight-bold text-primary">Status Pengesahan Validasi Data Ganda</h6>
                        </div>                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">                                    
                                    <div class="p-4">
                                        <form class="user" name="frmDaftarSurat">
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
        function showData(){
            var prop = document.getElementById('provinsi').value;
            var kab = "";
            var url = "<?php echo base_url()?>transaksi/daftar_surat_list";
            document.getElementById('btn_show').disabled=true;
            $.ajax({
                type:"POST",
                data:{prov:prop,kab:kab},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_surat_permohonan').html(data); 
                        document.getElementById('btn_show').disabled=false;
                    }
                }   

            }); 
        }
        
        function exportExcel(idupload,provinsi,kabupaten){
            alert("Export to Excel File");           
            var prov = provinsi;
            var kab = kabupaten;
            var kec = "";
            var kel = "";
            var ket = "";
            var nik = "";
            var nama = "";
            
            var kab2 = (kab!="") ? kab : "0";
            var kec2 = (kec!="") ? kec : "0";
            var kel2 = (kel!="") ? kel : "0";
            var ket2 = (ket!="") ? ket : "0";
            var nik2 = (nik!="") ? nik : "0";
            var nama2 = (nama!="") ? nama : "0";
            
            var url = "<?php echo base_url()?>transaksi/exportExcel/"+prov+"/"+kab2+"/"+kec2+"/"+kel2+"/"+ket2+"/"+nik2+"/"+nama2+"/"+idupload+"/B";
            
            var myWindow = window.open(url, "_blank");            
        }
        
        function revisiPermohonan(idpermohonan){
            window.location = "<?php echo base_url()?>transaksi/revisi_surat_permohonan/"+idpermohonan;
        }
        
        function updateStatus(idsurat){            
            window.location = "<?php echo base_url()?>transaksi/rubah_status_permohonan/"+idsurat;
        }
    </script>
</body>
</html>