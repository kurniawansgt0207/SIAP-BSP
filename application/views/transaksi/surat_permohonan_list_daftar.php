<?php //ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="th-sm">NAMA PEMOHON</th>
                    <th class="th-sm">TGL PERMOHONAN</th>
                    <th class="th-sm">PROVINSI</th>
                    <th class="th-sm">KABUPATEN/KOTA</th>
                    <th class="th-sm">SURAT PERMOHONAN</th>
                    <th class="th-sm">LAMPIRAN DATA</th>
                    <th class="th-sm">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    if(count($list_data)>0){
                    foreach($list_data as $data_surat){
                ?>
                <tr>
                    <td><?php echo ucwords(strtolower($data_surat->nm_pemohon));?></td>
                    <td><?php echo $data_surat->tgl_permohonan;?></td>
                    <td><?php echo ucwords(strtolower($data_surat->nm_propinsi));?></td>
                    <td><?php echo ucwords(strtolower($data_surat->nm_kabupaten));?></td>
                    <td>
                        <a href="<?php echo base_url()?>uploads/<?php echo $data_surat->nm_surat_permohonan;?>" target="_blank">
                            <?php echo ucwords(strtolower($data_surat->nm_surat_permohonan));?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url()?>uploads/<?php echo $data_surat->nm_lampiran_dokumen;?>" target="_blank">
                            <?php echo ucwords(strtolower($data_surat->nm_lampiran_dokumen));?>
                        </a>
                    </td>
                    <td align="center">
                        <?php //echo ucwords(strtolower($data_surat->status_permohonan));?>
                        <?php echo anchor('transaksi/rubah_status_permohonan/'.$data_surat->id,'['.$data_surat->status_permohonan.']'); ?>
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