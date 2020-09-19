<?php ini_set('display_errors','off'); ?>
<select name="kel_desa" id="kel_desa" class="form-control form-control-sm select4" onchange="getKelurahan()">
    <option></option>
    <?php
        foreach($kelurahan as $kel_desa){
    ?>
    <option value="<?php echo $kel_desa->NMKELURAHAN;?>"><?php echo $kel_desa->NMKELURAHAN;?></option>
    <?php
        }
    ?>
</select>