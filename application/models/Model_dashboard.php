<?php
    Class Model_dashboard extends CI_Model
    {
        function getTotalData($table,$where){
            $sql = "SELECT COUNT(a.IDARTBDT) jml FROM ".$table." a";
            if($where!=''){
                $sql .= " WHERE a.KET_TAMBAHAN='".$where."'";
            }
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getProvinsi($table,$where){            
            $sql = "SELECT NMPROP,COUNT(IDARTBDT) jml FROM ".$table;
            if($where!=''){
                $sql .= " WHERE KET_TAMBAHAN='".$where."'";
            }
            $sql .= " GROUP BY NMPROP";
            $query = $this->db->query($sql);
            return $query;
        }
    }
?>