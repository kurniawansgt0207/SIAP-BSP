<?php ini_set('display_errors','off'); ?>
<div class="card-body">
    <div class="table-responsive">
        <form name="frmRegister" method="post" action="<?php echo base_url();?>transaksi/register_pengesahan">
            <input type="hidden" name="provinsi" id="provinsi" value="<?php echo $provinsi;?>">
            <input type="hidden" name="kabupaten" id="kabupaten" value="<?php echo $kabupaten;?>">
        <table class="table table-striped table-hover table-sm" id="dataTablex" width="100%" cellspacing="0">
            <thead>                
                <tr>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">KETERANGAN</th>
                    <th class="th-sm" colspan="2" style="text-align: center; vertical-align: middle">STATUS DATA</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">TOTAL DATA</th>
                    <th class="th-sm" rowspan="2" style="text-align: center; vertical-align: middle">#</th>
                </tr>
                <tr>
                    <th class="th-sm" style="text-align: center; vertical-align: middle">CLEAN</th>
                    <!--<th class="th-sm" style="text-align: center; vertical-align: middle">UNCLEAN</th>-->
                    <th class="th-sm" style="text-align: center; vertical-align: middle">NON AKTIF</th>
                </tr>
            </thead>            
            <tbody>
                <?php
                    $no=1;
                    $totalrevisi = 0;
                    $totClean = 0;
                    $totUnclean = 0;
                    $totNonaktif = 0;
                    $totAll = 0;
                    $disabledBtn = "disabled";
                    foreach($data as $data_revisi){
                        $totalrevisi = ($data_revisi->clean+$data_revisi->unclean+$data_revisi->nonaktif);
                        $totClean += $data_revisi->clean;
                        $totUnclean += $data_revisi->unclean;
                        $totNonaktif += $data_revisi->nonaktif;
                        $totAll += $totalrevisi;
                ?>
                <tr>
                    <td style="text-align: center"><?php echo $data_revisi->label;?></td>
                    <td style="text-align: center"><?php echo number_format($data_revisi->clean);?></td>
                    <!--<td style="text-align: center"><?php echo number_format($data_revisi->uclean);?></td>-->
                    <td style="text-align: center"><?php echo number_format($data_revisi->nonaktif);?></td>
                    <td style="text-align: center"><?php echo number_format($totalrevisi);?></td>
                    <td style="text-align: center">
                        <?php 
                            if($totalrevisi > 0){
                                $disabledBtn = "";
                        ?>
                        <input type="checkbox" style="cursor:pointer" name="revisi[]" id="revisi<?php echo $data_revisi->label;?>" value="<?php echo $data_revisi->label;?>" onclick="activateBtn('<?php echo $data_revisi->label;?>')" checked>
                        <?php
                            }
                        ?>
                    </td>                    
                </tr>
                <?php
                        $no++;
                    }
                ?>
                <tr>
                    <td style="text-align: center">TOTAL</td>
                    <td style="text-align: center"><?php echo number_format($totClean);?></td>
                    <!--<td style="text-align: center"><?php echo number_format($totUnclean);?></td>-->
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
        <div style="text-align: right">
            <input type="submit" name="btn_proses" id="btn_proses" class="btn btn-sm btn-success" <?php echo $disabledBtn;?> value="Proses Registrasi">
        </div>
    </form>
    </div>    
    
</div>   
<?php $this->load->view("_partials/js_table.php") ?>