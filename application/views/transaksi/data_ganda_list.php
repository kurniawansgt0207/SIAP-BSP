<div class="card-body">    
    <div style="margin-top: -10px; margin-bottom: 20px">
        <div class="row">
            <div class="col-lg-6">
                <center><h6>DATA AWAL KELUARGA</h6></center>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" width="50%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">TOTAL DATA</th>
                                <th align="center">CLEAN</th>
                                <th align="center">UNCLEAN</th>
                                <th align="center">NON AKTIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo number_format($rekap[0]->total_data);?></td>
                                <td align="center"><?php echo number_format($rekap[0]->jml_clean);?></td>
                                <td align="center"><?php echo number_format($rekap[0]->jml_unclean);?></td>
                                <td align="center"><?php echo number_format($rekap[0]->jml_nonaktif);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <center><h6>DATA PERBAIKAN KELUARGA</h6></center>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" width="50%" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">TOTAL DATA</th>
                                <th align="center">CLEAN</th>
                                <th align="center">UNCLEAN</th>
                                <th align="center">NON AKTIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo number_format($rekap_revisi[0]->total_data);?></td>
                                <td align="center"><?php echo number_format($rekap_revisi[0]->jml_clean);?></td>
                                <td align="center"><?php echo number_format($rekap_revisi[0]->jml_unclean);?></td>
                                <td align="center"><?php echo number_format($rekap_revisi[0]->jml_nonaktif);?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="th-sm">NAMA PENERIMAN</th>
                    <th class="th-sm">NO KARTU</th>
                    <th class="th-sm">NIK KTP</th>
                    <th class="th-sm">ID KELURGA</th>
                    <th class="th-sm">NO KK</th>
                    <th class="th-sm">ID ART BDT</th>
                    <th class="th-sm">PROVINSI</th>
                    <th class="th-sm">KABUPATEN/KOTA</th>
                    <th class="th-sm">KETERANGAN</th>
                    <th class="th-sm">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    foreach($data as $data_ganda){
                ?>
                <tr>
                    <td><?php echo ucwords(strtolower($data_ganda->NAMA_PENERIMA));?></td>
                    <td><?php echo $data_ganda->NOMOR_KARTU;?></td>
                    <td><?php echo $data_ganda->NIK_KTP;?></td>
                    <td><?php echo $data_ganda->IDKELUARGA;?></td>
                    <td><?php echo $data_ganda->NOKK_DTKS;?></td>                    
                    <td><?php echo $data_ganda->IDARTBDT;?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMPROP));?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMKAB));?></td>
                    <td><?php echo ($data_ganda->STATUS_BARU!="") ? ucwords(strtolower($data_ganda->STATUS_BARU)) : ucwords(strtolower($data_ganda->KET_TAMBAHAN));?></td>
                    <td>
                        <?php if($data_ganda->STATUS_BARU!="NONAKTIF" && $data_ganda->KET_TAMBAHAN!="NONAKTIF"){ ?>
                        <a href="#<?php echo $data_ganda->NOMOR_KARTU;?>" id="nonaktif<?php echo $data_ganda->NOMOR_KARTU;?>" onclick="updatestatus('<?php echo $data_ganda->NOMOR_KARTU;?>','NONAKTIF','<?php echo $data_ganda->NMPROP;?>','<?php echo $data_ganda->NMKAB;?>')" title="Non Aktif">[X]</a> | 
                        <?php } ?>
                        <a href="#<?php echo $data_ganda->NOMOR_KARTU;?>" id="clean<?php echo $data_ganda->NOMOR_KARTU;?>" onclick="updatestatus('<?php echo $data_ganda->NOMOR_KARTU;?>','CLEAN','<?php echo $data_ganda->NMPROP;?>','<?php echo $data_ganda->NMKAB;?>')" title="Clean">[V]</a>                        
                        <a href="<?php echo base_url();?>transaksi/rubah_data_ganda/<?php echo $data_ganda->NOMOR_KARTU;?>/KEL" id="ubah<?php echo $data_ganda->NOMOR_KARTU;?>">[Ubah]</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view("_partials/js_table.php") ?>