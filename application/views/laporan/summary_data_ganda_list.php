
<div class="card-body p-4" style="margin-top:-35px">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="th-sm">NO</th>
                                    <th class="th-sm">NAMA PROPINSI</th>
                                    <th class="th-sm">TOTAL DATA</th>
                                    <th class="th-sm">CLEAN</th>
                                    <th class="th-sm">UNCLEAN</th>
                                    <th class="th-sm">NON AKTIF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                    foreach($data_rekap as $data_ganda){
                                ?>
                                <tr>
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo $data_ganda->NMPROP;?></td>
                                    <td align="right"><?php echo number_format($data_ganda->total);?></td>
                                    <td align="right"><?php echo number_format($data_ganda->clean);?></td>
                                    <td align="right"><?php echo number_format($data_ganda->unclean);?></td>
                                    <td align="right"><?php echo number_format($data_ganda->nonaktif);?></td>
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