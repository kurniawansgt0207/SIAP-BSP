<?php
    Class Model_dashboard extends CI_Model
    {
        function getTotalData($table,$where,$provinsi){
            $sql = "SELECT COUNT(a.IDARTBDT) jml FROM ".$table." a";
            if($where!=''){
                if($provinsi!=''){            
                    $sql .= " WHERE a.KET_TAMBAHAN='".$where."' AND a.NMPROP='$provinsi'";
                } else {
                    $sql .= " WHERE a.KET_TAMBAHAN='".$where."'";
                }
            } else {
                if($provinsi!=''){
                    $sql .= " WHERE a.NMPROP='$provinsi'";
                }
            }
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getProvinsi($table,$where,$provinsi){            
            $sql = "SELECT NMPROP,COUNT(IDARTBDT) jml FROM ".$table;
            if($where!=''){
                if($provinsi!=''){
                    $sql .= " WHERE KET_TAMBAHAN='".$where."' AND NMPROP='$provinsi'";
                } else {
                    $sql .= " WHERE KET_TAMBAHAN='".$where."'";
                }
            } else {
                if($provinsi!=''){
                    $sql .= " WHERE NMPROP='".$provinsi."'";
                }
            }
            $sql .= " GROUP BY NMPROP";
            $query = $this->db->query($sql);
            return $query;
        }
    }
?>