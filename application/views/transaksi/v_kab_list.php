<?php ini_set('display_errors','off'); ?>
<select name="kab_kota" id="kab_kota" class="form-control form-control-sm select2" onchange="list_of_kec()">
    <option></option>
    <?php
        foreach($kab_kota as $kab){
            $jmlData = ($menu=="transaksi") ? " (".number_format($total_data[0]->jmldata).")" : "";
    ?>
    <option value="<?php echo $kab->NMKABKOTA;?>"><?php echo $kab->NMKABKOTA. $jmlData;?></option>
    <?php
        }
    ?>
</select>