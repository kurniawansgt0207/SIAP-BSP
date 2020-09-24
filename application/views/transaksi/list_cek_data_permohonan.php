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
                            <h6 class="m-0 font-weight-bold text-primary">Cek Data Permohonan Validasi Penerima Bantuan</h6>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td width="15%">PROPINSI</td>
                                            <td width="3%">:</td>
                                            <td width="82%"><?php echo $nm_propinsi;?></td>
                                        </tr>
                                        <tr>
                                            <td>KABUPATEN</td>
                                            <td>:</td>
                                            <td><?php echo $nm_kabupaten;?></td>
                                        </tr>
                                        <tr>
                                            <td>KETERANGAN</td>
                                            <td>:</td>
                                            <td>
                                                <select name="ket_tambahan" id="ket_tambahan" class="form-control">
                                                    <option value="0">--Semua Keterangan--</option>
                                                    <option value="CLEAN" <?php echo ($keterangan=="CLEAN") ? "selected" : "";?>>CLEAN</option>
                                                    <option value="UNCLEAN" <?php echo ($keterangan=="UNCLEAN") ? "selected" : "";?>>UNCLEAN</option>
                                                    <option value="NONAKTIF"  <?php echo ($keterangan=="NONAKTIF") ? "selected" : "";?>>NON AKTIF</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-info" name="btn_cari" id="btn_cari" value="Tampilkan Data" onclick="showData()">
                                                <input type="button" class="btn btn-sm btn-warning" name="btn_back" id="btn_back" value="Kembali ke Daftar" onclick="backPage()">
                                                <!--<input type="button" class="btn btn-sm btn-success" name="btn_download" id="btn_download" value="Download Data" onclick="downloadData()">
                                                <input type="button" class="btn btn-sm btn-primary" name="btn_update" id="btn_update" value="Update Status" onclick="updateStatus()">-->
                                            </td>
                                        </tr>
                                        <input type="hidden" name="propinsi" id="propinsi" value="<?php echo $nm_propinsi;?>">
                                        <input type="hidden" name="kabupaten" id="kabupaten" value="<?php echo $nm_kabupaten;?>">
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="th-sm text-center">NAMA PENERIMAN</th>
                                            <th class="th-sm text-center">NO KARTU</th>
                                            <th class="th-sm text-center">NIK KTP</th>
                                            <th class="th-sm text-center">NO KK</th>
                                            <th class="th-sm text-center">ID ART BDT</th>
                                            <th class="th-sm text-center">KECAMATAN</th>
                                            <th class="th-sm text-center">KELURAHAN</th>
                                            <th class="th-sm text-center">STATUS ASAL</th>
                                            <th class="th-sm text-center">STATUS BARU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            if(count($data_surat)>0){
                                            foreach($data_surat as $data){
                                        ?>
                                        <tr>
                                            <td><?php echo ucwords(strtolower($data->NAMA_PENERIMA));?></td>
                                            <td><?php echo $data->NOMOR_KARTU;?></td>
                                            <td><?php echo $data->NIK_KTP;?></td>
                                            <td><?php echo $data->NOKK_DTKS;?></td>
                                            <td><?php echo $data->IDARTBDT;?></td>
                                            <td><?php echo ucwords(strtolower($data->NMKEC));?></td>
                                            <td><?php echo ucwords(strtolower($data->NMKEL));?></td>
                                            <td><?php echo ucwords(strtolower($data->KET_TAMBAHAN));?></td>                    
                                            <td><?php echo ucwords(strtolower($data->STATUS_BARU));?></td>                    
                                        </tr>
                                        <?php
                                            }
                                            } else {
                                        ?>
                                        <tr><td colspan="8" align="center">Data Tidak Ditemukan</td></tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
        function showData(){            
            window.location = "<?php echo base_url()?>transaksi/cek_data_permohonan/<?php echo $id_surat;?>/<?php echo $id_upload;?>/"+document.getElementById('ket_tambahan').value;
        }
        
        function downloadData(){
            var propinsi = document.getElementById('propinsi').value;
            var kabupaten = document.getElementById('kabupaten').value;
            var keterangan = document.getElementById('ket_tambahan').value;
            var myWindow = window.open("<?php echo base_url();?>transaksi/download_data/<?php echo $id_surat;?>/"+keterangan, "_blank");
        }
        
        function updateStatus(){
            window.location = "<?php echo base_url()?>transaksi/rubah_status_permohonan/<?php echo $id_surat;?>";
        }
        
        function backPage(){
            window.location = "<?php echo base_url()?>transaksi/daftar_surat";
        }
    </script>
</body>
</html>