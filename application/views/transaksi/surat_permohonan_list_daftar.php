<?php //ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th class="th-sm text-center">NAMA PEMOHON</th>                    
                    <th class="th-sm text-center">PROVINSI</th>
                    <th class="th-sm text-center">KABUPATEN/KOTA</th>
                    <th class="th-sm text-center">SURAT PERMOHONAN</th>
                    <th class="th-sm text-center">LAMPIRAN DATA</th>
                    <th class="th-sm text-center">STATUS</th>
                    <th class="th-sm text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    if(count($list_data)>0){
                    foreach($list_data as $data_surat){
                ?>
                <tr>
                    <td class="text-nowrap"><?php echo ucwords(strtolower($data_surat->nm_pemohon));?></td>                    
                    <td class="text-nowrap"><?php echo ucwords(strtolower($data_surat->nm_propinsi));?></td>
                    <td class="text-nowrap"><?php echo ucwords(strtolower($data_surat->nm_kabupaten));?></td>
                    <td class="text-nowrap">
                        <a href="<?php echo base_url()?>uploads/<?php echo $data_surat->nm_surat_permohonan;?>" target="_blank">
                            <?php echo ucwords(strtolower($data_surat->nm_surat_permohonan));?>
                        </a>
                    </td>
                    <td class="text-nowrap">
                        <a href="<?php echo base_url()?>uploads/<?php echo $data_surat->nm_lampiran_dokumen;?>" target="_blank">
                            <?php echo ucwords(strtolower($data_surat->nm_lampiran_dokumen));?>
                        </a>
                    </td>
                    <td class="text-nowrap" align="center">                        
                        <?php echo $data_surat->status_permohonan; ?>
                    </td>            
                    <td class="text-nowrap" align="center">
                        <?php
                            if($data_surat->status_permohonan=="Open"){
                        ?>
                        <?php echo anchor('transaksi/cek_data_permohonan/'.$data_surat->id.'/0','Cek Data'); ?>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                    } else {
                ?>
                <tr><td colspan="7" align="center">Data Tidak Ditemukan</td></tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>   
<?php $this->load->view("_partials/js.php") ?>