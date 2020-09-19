<?php ini_set('display_errors','off'); ?>
<select name="kecamatan" id="kecamatan" class="form-control form-control-sm select3" onchange="list_of_kel()">
    <option></option>
    <?php
       foreach($kecamatan as $kec){
    ?>
    <option value="<?php echo $kec->NMKECAMATAN;?>"><?php echo $kec->NMKECAMATAN;?></option>
    <?php
        }
    ?>
</select>