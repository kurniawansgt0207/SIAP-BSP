<?php ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <form name="frmRegister" method="post" action="<?php echo base_url();?>transaksi/register_pengesahan">
            <input type="hidden" name="provinsi" id="provinsi" value="<?php echo $provinsi;?>">
            <input type="hidden" name="kabupaten" id="kabupaten" value="<?php echo $kabupaten;?>">
        <table class="table table-striped table-hover table-sm" id="dataTablex" width="100%" cellspacing="0">
            <thead>                
                <tr>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">NO</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">NO REGISTER</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">TANGGAL</th>
                    <th class="th-sm" colspan="2" style="text-align: center; vertical-align: middle">JUMLAH DATA</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">TOTAL DATA</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">AKSI</th>
                </tr>
                <tr>
                    <th class="th-sm" style="text-align: center; vertical-align: middle">CLEAN</th>
                    <th class="th-sm" style="text-align: center; vertical-align: middle">NON AKTIF</th>
                </tr>
            </thead>            
            <tbody>
                <?php
                    $no=1;
                    $totClean = 0;
                    $totNonaktif = 0;
                    $totAll = 0;
                    foreach($register as $data_register){
                        $totalData = ($data_register->JML_CLEAN+$data_register->JML_NONAKTIF);
                        $totClean += $data_register->JML_CLEAN;
                        $totNonaktif += $data_register->JML_NONAKTIF;
                        $totAll += $totalData;
                ?>
                <tr>
                    <td style="text-align: center"><?php echo $no;?></td>
                    <td style="text-align: center"><?php echo $data_register->NO_REGISTER;?></td>
                    <td style="text-align: center"><?php echo date("d M Y",strtotime($data_register->TGL_UPLOAD));?></td>
                    <td style="text-align: center"><?php echo number_format($data_register->JML_CLEAN);?></td>
                    <td style="text-align: center"><?php echo number_format($data_register->JML_NONAKTIF);?></td>
                    <td style="text-align: center"><?php echo number_format($totalData);?></td>
                    <td style="text-align: center">
                        <?php
                            if($data_register->ID_SURAT_PERMOHONAN==''){
                        ?>
                        <input type="button" value="Upload" class="btn btn-sm btn-danger" onclick="upload_surat_pengesahan('<?php echo $data_register->ID;?>')">
                        <?php
                            } else {
                                echo "Sudah di upload";
                            }
                            ?><br>
                        <input type="button" value="Download Data" class="btn btn-sm btn-warning" style="margin-top: 5px" onclick="downloadData('<?php echo $data_register->ID;?>')">
                    </td>                    
                </tr>
                <?php
                        $no++;
                    }
                ?>
                <tr>
                    <td style="text-align: center" colspan="3">TOTAL</td>
                    <td style="text-align: center"><?php echo number_format($totClean);?></td>
                    <td style="text-align: center"><?php echo number_format($totNonaktif);?></td>
                    <td style="text-align: center"><?php echo number_format($totAll);?></td>
                    <td></td>
                </tr>
                <input type="hidden" name="jmlclean" id="jmlclean" value="<?php echo $totClean;?>">
                <input type="hidden" name="jmlunclean" id="jmlunclean" value="<?php echo $totUnclean;?>">
                <input type="hidden" name="jmlnonaktif" id="jmlnonaktif" value="<?php echo $totNonaktif;?>">
                <input type="hidden" name="jmltotal" id="jmltotal" value="<?php echo $totAll;?>">
            </tbody>
        </table>
        <hr>        
    </form>
    </div>    
    
</div>   
<?php $this->load->view("_partials/js_table.php") ?>