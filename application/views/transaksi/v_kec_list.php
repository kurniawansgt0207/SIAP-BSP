<?php ini_set('display_errors','off'); ?>
<select name="kecamatan" id="kecamatan" class="form-control form-control-sm select3" onchange="list_of_kel()">
    <option></option>
    <?php
        $prefixTbl = $this->db->dbprefix;     
        $tableName = ($tipe=="A") ? $prefixTbl."data_ganda_revisi" : $prefixTbl."data_ganda_revisi_identik";
        foreach($kecamatan as $kec){
            $where = "NMPROP='$provinsi' AND NMKAB='$kabupaten' AND NMKEC='$kec->NMKECAMATAN'";
            $total_data = $this->Model_transaksi->check_data($tableName,$where)->result();
    ?>
    <option value="<?php echo $kec->NMKECAMATAN;?>"><?php echo $kec->NMKECAMATAN." (".$total_data[0]->jmldata.")";?></option>
    <?php
        }
    ?>
</select>