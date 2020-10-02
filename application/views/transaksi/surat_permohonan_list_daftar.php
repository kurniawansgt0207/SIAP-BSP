<?php //ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th class="th-sm text-center">STATUS</th>
                    <th class="th-sm text-center">NAMA PEMOHON</th>                    
                    <th class="th-sm text-center">PROVINSI<br>(KABUPATEN)</th>
                    <th class="th-sm text-center">DOKUMEN PERMOHONAN</th>
                    <th class="th-sm text-center">DATA PERBAIKAN</th>
                    <th class="th-sm text-center">CONFIRM BY PROVINSI</th>                    
                    <th class="th-sm text-center">CONFIRM BY PFM</th>                    
                    <th class="th-sm text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    if(count($list_data)>0){
                    foreach($list_data as $data_surat){
                        $tglRejected = "";
                        if($data_surat->status_permohonan=="Rejected"){
                            $tglRejected = "<br>(".$data_surat->tgl_rejected.")";
                        }
                ?>
                <tr>
                    <td class="text-nowrap" align="center"><?php echo $data_surat->status_permohonan.$tglRejected;?></td>
                    <td class="text-nowrap"><?php echo ucwords(strtolower($data_surat->nm_pemohon));?></td>                    
                    <td class="text-nowrap" align="center"><?php echo ucwords(strtolower($data_surat->nm_propinsi));?></td>                    
                    <td class="text-nowrap" align="center">
                        <a href="<?php echo base_url()?>uploads/<?php echo $data_surat->nm_surat_permohonan;?>" target="_blank" title="<?php echo $data_surat->nm_surat_permohonan;?>">
                            [Lihat Surat]
                        </a>
                    </td>
                    <td class="text-nowrap" align="center">
                        CLEAN (<?php echo number_format($data_surat->JML_CLEAN);?>)<br>
                        NON AKTIF (<?php echo number_format($data_surat->JML_NONAKTIF);?>)
                    </td>
                    <td class="text-nowrap" align="center">
                        <?php
                            $tglAccProv = ($data_surat->tgl_acc_provinsi!="1900-01-01") ? $data_surat->tgl_acc_provinsi : "-";
                            $byAccProv = ($data_surat->acc_provinsi_by!="") ? "<br>(".$data_surat->acc_provinsi_by.")" : "";                                
                            if($group_pengguna != "Korda"){
                                echo $tglAccProv.$byAccProv."";

                                if($data_surat->status_permohonan==""){
                        ?><br>
                        <a href="<?php echo base_url()?>transaksi/approve_surat_permohonan/<?php echo $data_surat->id;?>/NA" title="Lihat Data">[Lihat Data]</a>                        
                        <?php
                                }
                            } else {
                                if($data_surat->status_permohonan!="Open"){
                                    echo $tglAccProv.$byAccProv."";
                                } else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                    <td class="text-nowrap" align="center">
                        <?php
                            $tglAccPfm = ($data_surat->tgl_acc_pfm!="1900-01-01") ? $data_surat->tgl_acc_pfm : "-";
                            $byAccPfm = ($data_surat->acc_pfm_by!="") ? "<br>(".$data_surat->acc_pfm_by.")" : "";
                            if($group_pengguna != "Korda"){
                                echo $tglAccPfm.$byAccPfm."";

                                if($data_surat->status_permohonan=="Need Approve"){
                        ?><br>
                        <a href="<?php echo base_url()?>transaksi/approve_surat_permohonan/<?php echo $data_surat->id;?>/A" title="Setujui Permohonan">[Setuju]</a>
                        <a href="#" onclick="updateStatus('<?php echo $data_surat->id;?>')" title="Tolak Permohonan">[Tolak]</a>
                        <?php
                                }
                            } else {
                                if($data_surat->status_permohonan!="Open"){
                                    echo $tglAccPfm.$byAccPfm."";
                                } else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                    <td class="text-nowrap" align="center">
                        <a href="<?php echo base_url();?>transaksi/download_data/<?php echo $data_surat->idUpload;?>" target="_blank" title="Lihat Data Perbaikan">[Lihat Data]</a>
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