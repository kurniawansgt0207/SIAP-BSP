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
                            <h6 class="m-0 font-weight-bold text-primary">Filter Data Ganda Identik Penerima Bansos Pangan</h6>
                        </div>
                        
                        <div class="card-body p-4" style="margin-top:-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <form class="user" name="frmDataGandaIdentik" method="post" target="_blank" action="<?php echo base_url();?>transaksi/export_pdf">                                            
                                            <input type="hidden" name="tipe" id="tipe" value="B">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-control form-control-sm select1" onchange="list_of_kab()">  
                                                    <option></option>
                                                    <?php
                                                        foreach($provinsi as $prov){
                                                            
                                                    ?>
                                                    <option value="<?php echo $prov->NMPROVINSI;?>"><?php echo $prov->NMPROVINSI." (".number_format($total_data[0]->jmldata).")";?></option>
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
                                                <label>Keterangan</label>
                                                <select name="ket_tambahan" id="ket_tambahan" class="form-control form-control-sm">
                                                    <option value="">--Semua Keterangan--</option>
                                                    <option value="CLEAN">CLEAN</option>
                                                    <option value="UNCLEAN">UNCLEAN</option>
                                                    <option value="NONAKTIF">NON AKTIF</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Urutkan berdasarkan</label>
                                                <select name="orderby" id="orderby" class="form-control form-control-sm">                                                    
                                                    <option value="NAMA_PENERIMA">NAMA PENERIMAN</option>
                                                    <option value="NOMOR_KARTU">NO KARTU</option>
                                                    <option value="NIK_KTP">NIK KTP</option>
                                                    <option value="IDKELUARGA">ID KELUARGA</option>
                                                    <option value="KET_TAMBAHAN">STATUS</option>
                                                </select>
                                            </div>
                                            <!--<div class="form-group">
                                                <label>NIK Penerima</label>
                                                <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="NIK KTP">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Penerima</label>
                                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Penerima">
                                            </div>-->
                                            <div class="form-group">
                                                <input type="button" value="Cari Data" name="btn_submit" id="btn_submit" onclick="cari()" class="btn btn-sm btn-primary">
                                                <input type="submit" value="Cetak Data" name="btn_cetak" id="btn_cetak" class="btn btn-sm btn-default btn-danger">                                                
                                                <!--<input type="button" value="Export CSV" name="btn_csv" id="btn_csv" onclick="exportCSV()" class="btn btn-sm btn-default btn-success">-->
                                                <input type="button" value="Export Excel" name="btn_excel" id="btn_excel" onclick="exportExcel()" class="btn btn-sm btn-default btn-dark">
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
        //$("#list_data_ganda").load("<?php echo base_url()?>transaksi/list_data");

        function list_of_kab(){
            var tipe = document.getElementById('tipe').value;
            var prov = document.getElementById('provinsi').value;    
            var menu = "transaksi";
            var tipe = "B";
            var url = "<?php echo base_url()?>transaksi/list_of_kab";

            $.ajax({
                type:"POST",
                data:{tipe:tipe,prov:prov,menu:menu},
                url:url,
                success:function(data){ 
                     if(data){
                     $('#list_kab').html(data); 
                     }
                }   

            });            
        }

        function list_of_kec(){
            var tipe = document.getElementById('tipe').value;
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kota').value;
            document.getElementById('kab_kotax').value = kab;
            var url = "<?php echo base_url()?>transaksi/list_of_kec";

            $.ajax({
                type:"POST",
                data:{tipe:tipe,prov:prov,kab:kab},
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
            var tipe = document.getElementById('tipe').value;
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;
            var kec = document.getElementById('kecamatanx').value;
            var order = document.getElementById('orderby').value;
            var ket = document.getElementById('ket_tambahan').value;
            var nik = "";
            var nama = "";
            var url = "<?php echo base_url()?>transaksi/list_data_identik";
            
            $.ajax({
                type:"POST",
                data:{tipe:tipe,prov:prov,kab:kab,kec:kec,order:order,ket:ket,nik:nik,nama:nama},
                url:url,
                success:function(data){ 
                    if(data){
                        $('#list_data_ganda').html(data);
                    }
                }   

            }); 
        }      
        
        function updatestatus(id,status,prop,kab){            
            var tipe = document.getElementById('tipe').value;
            var url = "<?php echo base_url();?>transaksi/update_status";                        
            
            $.ajax({
                type:"POST",
                data:{id:id,status:status,prop:prop,kab:kab,tipe:tipe},
                url:url,
                success:function(data){ 
                    if(data){
                        var pesan = data.split('~');                        
                        //$('#hasil'+id).html(pesan[0]); 
                        alert(pesan[0]+"\n\n"+pesan[1]);
                        document.getElementById('nonaktif'+id).innerHTML = "";
                        document.getElementById('clean'+id).innerHTML = "";
                    }
                }   

            }); 
        }
        
        function exportCSV(){
            alert("Export to CSV File");
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;
            var kec = document.getElementById('kecamatanx').value;
            var kel = document.getElementById('kel_desax').value;
            var ket = document.getElementById('ket_tambahan').value;
            var nik = document.getElementById('nik').value;
            var nama = document.getElementById('nama').value; 
            
            var kab2 = (kab!="") ? kab : "0";
            var kec2 = (kec!="") ? kec : "0";
            var kel2 = (kel!="") ? kel : "0";
            var ket2 = (ket!="") ? ket : "0";
            var nik2 = (nik!="") ? nik : "0";
            var nama2 = (nama!="") ? nama : "0";
            
            var url = "<?php echo base_url()?>transaksi/exportCSV/"+prov+"/"+kab2+"/"+kec2+"/"+kel2+"/"+ket2+"/"+nik2+"/"+nama2;
            
            var myWindow = window.open(url, "_blank");            
        }
        
        function exportExcel(){
            alert("Export to Excel File");
            var tipe = document.getElementById('tipe').value;
            var prov = document.getElementById('provinsi').value;
            var kab = document.getElementById('kab_kotax').value;
            var kec = document.getElementById('kecamatanx').value;
            var order = document.getElementById('orderby').value;
            var ket = document.getElementById('ket_tambahan').value;
            var nik = "";
            var nama = ""; 
            alert(tipe);
            var kab2 = (kab!="") ? kab : "0";
            var kec2 = (kec!="") ? kec : "0";
            var order2 = (order!="") ? order : "0";
            var ket2 = (ket!="") ? ket : "0";
            var nik2 = (nik!="") ? nik : "0";
            var nama2 = (nama!="") ? nama : "0";
            
            var url = "<?php echo base_url()?>transaksi/exportExcel/"+prov+"/"+kab2+"/"+kec2+"/"+order2+"/"+ket2+"/"+nik2+"/"+nama2+"/0/"+tipe;
            
            var myWindow = window.open(url, "_blank");             
        }
    </script>
</body>
</html>