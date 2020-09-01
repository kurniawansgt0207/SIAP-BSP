<?php
    Class Model_transaksi extends CI_Model
    {
        function showData($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){
            $this->db->select('*');
            $this->db->from('data_ganda');
            if($param1!=''){
                $this->db->where('NMPROP',$param1);
            }
            if($param2!=''){
                $this->db->where('NMKAB',$param2);
            }
            if($param3!=''){
                $this->db->where('NMKEC',$param3);
            }
            if($param4!=''){
                $this->db->where('NMKEL',$param4);
            }
            if($param5!=''){
                $this->db->where('KET_TAMBAHAN',$param5);
            }
            if($param6!=''){
                $this->db->like('NIK_KTP',$param6);
            }
            if($param7!=''){
                $this->db->like('NAMA_PENERIMA',$param7);
            }
            $this->db->limit(500);
            
            $query = $this->db->get();
            return $query;
        }
        
        function edit_data($where,$table){		
            return $this->db->get_where($table,$where);
        }
                
        function getProvinsi(){
            $sql = "SELECT a.NMPROVINSI FROM m_prov_kab_kec_kel_indonesia a
                    GROUP BY a.NMPROVINSI ORDER BY a.NMPROVINSI";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKabKota($provinsi){
            $sql = "SELECT a.NMKABKOTA FROM m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMPROVINSI='".$provinsi."'
                    GROUP BY a.NMKABKOTA ORDER BY a.NMKABKOTA";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKecamatan($kabupaten){
            $sql = "SELECT a.NMKECAMATAN FROM m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMKABKOTA='".$kabupaten."'
                    GROUP BY a.NMKECAMATAN ORDER BY a.NMKECAMATAN";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKelDesa($kecamatan){
            $sql = "SELECT a.NMKELURAHAN FROM m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMKECAMATAN='".$kecamatan."'
                    GROUP BY a.NMKELURAHAN ORDER BY a.NMKELURAHAN;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
	}	
        
        function rekap_data_per_provinsi(){
            $sql = "SELECT NMPROP,sum(total_data) total_data,sum(jml_clean) jml_clean,sum(jml_unclean) jml_unclean,
            sum(jml_nonaktif) jml_nonaktif
            FROM
            (
            SELECT NMPROP,COUNT(IDARTBDT) total_data,0 jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM data_ganda 
            GROUP BY NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='CLEAN'
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='UNCLEAN'
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='NONAKTIF'
            GROUP BY a.NMPROP
            ) aa GROUP BY NMPROP;";
            $query = $this->db->query($sql);
            return $query;
        }
    }
?>