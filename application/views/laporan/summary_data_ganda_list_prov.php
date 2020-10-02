<div class="card-body p-4" style="margin-top:-35px">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm" id="dataTablex" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="th-sm" style="text-align:center">NO</th>
                                    <th class="th-sm" style="text-align:center">KETERANGAN</th>
                                    <th class="th-sm" style="text-align:center">TOTAL DATA</th>
                                    <th class="th-sm" style="text-align:center">CLEAN</th>
                                    <th class="th-sm" style="text-align:center">UNCLEAN</th>
                                    <th class="th-sm" style="text-align:center">NON AKTIF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;                          
                                    foreach($data_rekap as $rekap){                                        
                                        $tipenew = ($rekap->label=='Awal') ? 'A' : 'B';
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td>
                                        <a href="<?php echo base_url();?>laporan/export_pdf/<?php echo $tipenew;?>/<?php echo $label;?>/<?php echo $provinsi_pengguna;?>/<?php echo $kabupaten_pengguna;?>" target="_blank"><?php echo $rekap->label;?></a></td>
                                    <td align="center"><?php echo number_format($rekap->total);?></td>
                                    <td align="center"><?php echo number_format($rekap->clean);?></td>
                                    <td align="center"><?php echo number_format($rekap->unclean);?></td>
                                    <td align="center"><?php echo number_format($rekap->nonaktif);?></td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("_partials/js_table.php") ?>