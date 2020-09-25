<?php ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="th-sm">NAMA PENERIMAN</th>
                    <th class="th-sm">NO KARTU</th>
                    <th class="th-sm">NIK KTP</th>
                    <th class="th-sm">NO KK</th>
                    <th class="th-sm">ID ART BDT</th>
                    <th class="th-sm">PROVINSI</th>
                    <th class="th-sm">KABUPATEN/KOTA</th>
                    <th class="th-sm">KECAMATAN</th>
                    <th class="th-sm">KELURAHAN</th>
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
                    <td><?php echo $data_ganda->NOKK_DTKS;?></td>
                    <td><?php echo $data_ganda->IDARTBDT;?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMPROP));?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMKAB));?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMKEC));?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->NMKEL));?></td>
                    <td><?php echo ucwords(strtolower($data_ganda->KET_TAMBAHAN));?></td>
                    <td>
                        <a href="#<?php echo $data_ganda->IDARTBDT;?>" id="nonaktif<?php echo $data_ganda->IDARTBDT;?>" onclick="updatestatus('<?php echo $data_ganda->IDARTBDT;?>','NONAKTIF','<?php echo $data_ganda->NMPROP;?>','<?php echo $data_ganda->NMKAB;?>')" title="Non Aktif">[X]</a> | 
                        <a href="#<?php echo $data_ganda->IDARTBDT;?>" id="clean<?php echo $data_ganda->IDARTBDT;?>" onclick="updatestatus('<?php echo $data_ganda->IDARTBDT;?>','CLEAN','<?php echo $data_ganda->NMPROP;?>','<?php echo $data_ganda->NMKAB;?>')" title="Clean">[V]</a>                        
                        <!--<?php echo anchor('transaksi/rubah_data_ganda/'.$data_ganda->IDARTBDT.'/IDT','[Rubah]'); ?>-->
                    </td>
                </tr>
                <?php /*<tr>
                    <td colspan="9" align="center"><div id="hasil<?php echo $data_ganda->IDARTBDT;?>">--</div></td>
                </tr> */?>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>   
<?php $this->load->view("_partials/js.php") ?>