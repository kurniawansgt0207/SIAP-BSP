<?php
    Class Model_transaksi extends CI_Model
    {
        function showData($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){            
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT * FROM ".$prefixTbl."data_ganda WHERE NAMA_PENERIMA != ''";
            $sql .= ($param1 != '') ? " AND NMPROP='".$param1."' " : "";
            $sql .= ($param2 != '') ? " AND NMKAB='".$param2."' " : "";
            $sql .= ($param3 != '') ? " AND NMKEC='".$param3."' " : "";
            $sql .= ($param4 != '') ? " AND NMKELP='".$param4."' " : "";
            $sql .= ($param5 != '') ? " AND KET_TAMBAHAN='".$param5."' " : "";
            $sql .= ($param6 != '') ? " AND NIK_KTP LIKE '%".$param6."%' " : "";
            $sql .= ($param7 != '') ? " AND NAMA_PENERIMA LIKE '%".$param7."%' " : "";
            $sql .= " ORDER BY NOKK_DTKS,IDARTBDT ASC";
            //echo $sql;
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showDataIdentik($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){            
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT * FROM ".$prefixTbl."data_ganda_identik WHERE NAMA_PENERIMA != ''";
            $sql .= ($param1 != '') ? " AND NMPROP='".$param1."' " : "";
            $sql .= ($param2 != '') ? " AND NMKAB='".$param2."' " : "";
            $sql .= ($param3 != '') ? " AND NMKEC='".$param3."' " : "";
            $sql .= ($param4 != '') ? " AND NMKELP='".$param4."' " : "";
            $sql .= ($param5 != '') ? " AND KET_TAMBAHAN='".$param5."' " : "";
            $sql .= ($param6 != '') ? " AND NIK_KTP LIKE '%".$param6."%' " : "";
            $sql .= ($param7 != '') ? " AND NAMA_PENERIMA LIKE '%".$param7."%' " : "";
            $sql .= " ORDER BY NOKK_DTKS,IDARTBDT ASC";
            //echo $sql;
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showDataRevisi($param1="",$param2="",$param3=""){            
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT * FROM ".$prefixTbl."data_ganda_revisi WHERE ID_UPLOAD = '".$param1."'";
            $sql .= ($param2 != '') ? " AND NMPROP='".$param2."' " : "";
            $sql .= ($param3 != '') ? " AND NMKAB='".$param3."' " : "";
            $sql .= " ORDER BY NOKK_DTKS,IDARTBDT ASC";
            //echo $sql;
            $query = $this->db->query($sql);
            return $query;
        }
        
        function edit_data($where,$table){		
            return $this->db->get_where($table,$where);
        }
                
        function getProvinsi($provinsi){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT a.NMPROVINSI FROM ".$prefixTbl."m_prov_kab_kec_kel_indonesia a ";
            if($provinsi!=''){
                $sql .= "WHERE NMPROVINSI='$provinsi'";
            }
            $sql .= "GROUP BY a.NMPROVINSI ORDER BY a.NMPROVINSI";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKabKota($provinsi,$kabupaten){
            $prefixTbl = $this->db->dbprefix;
            $extQry = ($kabupaten!="") ? " AND a.NMKABKOTA='".$kabupaten."'" : "";
            $sql = "SELECT a.NMKABKOTA FROM ".$prefixTbl."m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMPROVINSI='".$provinsi."' $extQry
                    GROUP BY a.NMKABKOTA ORDER BY a.NMKABKOTA";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKecamatan($kabupaten){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT a.NMKECAMATAN FROM ".$prefixTbl."m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMKABKOTA='".$kabupaten."'
                    GROUP BY a.NMKECAMATAN ORDER BY a.NMKECAMATAN";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function getKelDesa($kecamatan){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT a.NMKELURAHAN FROM ".$prefixTbl."m_prov_kab_kec_kel_indonesia a
                    WHERE a.NMKECAMATAN='".$kecamatan."'
                    GROUP BY a.NMKELURAHAN ORDER BY a.NMKELURAHAN;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function check_data($table,$where){
            $sql = "SELECT count(*) jmldata FROM ".$table." WHERE ".$where." group by NMPROP,NMKAB";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function insert_data($table,$data){
            $this->db->insert($table,$data);
        }
        
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
	}	
        
        function rekap_data_per_provinsi($provinsi){
            $extQry1 = "";
            $extQry2 = "";
            
            if($provinsi!=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi'";
                $extQry2 = " AND a.NMPROP='$provinsi'";
            }
            
            $prefixTbl = $this->db->dbprefix;
            
            $sql = "SELECT NMPROP,sum(total_data) total_data,sum(jml_clean) jml_clean,sum(jml_unclean) jml_unclean,
            sum(jml_nonaktif) jml_nonaktif
            FROM
            (
            SELECT a.NMPROP,COUNT(a.IDARTBDT) total_data,0 jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a
            $extQry1
            GROUP BY NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.KET_TAMBAHAN='CLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.KET_TAMBAHAN='UNCLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.KET_TAMBAHAN='NONAKTIF' $extQry2
            GROUP BY a.NMPROP
            ) aa GROUP BY NMPROP;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function rekap_data_prop_kab($prop,$kab){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT NMPROP,NMKAB,SUM(total_data) total_data,SUM(jml_clean) jml_clean,SUM(jml_unclean) jml_unclean,
            SUM(jml_nonaktif) jml_nonaktif
            FROM
            (            
            SELECT a.NMPROP,a.NMKAB,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='CLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='UNCLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$prefixTbl."data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='NONAKTIF'
            GROUP BY a.NMPROP,a.NMKAB
            ) aa GROUP BY aa.NMPROP,aa.NMKAB;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function update_status($id,$status){
            $prefixTbl = $this->db->dbprefix;
            $sql = "UPDATE ".$prefixTbl."data_ganda SET KET_TAMBAHAN='".$status."' WHERE IDARTBDT='".$id."'";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function submit_surat_permohonan($data){
            $prefixTbl = $this->db->dbprefix;
            $this->db->insert($prefixTbl.'surat_permohonan', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        
        function submit_unggah_surat($data){
            $prefixTbl = $this->db->dbprefix;
            $this->db->insert($prefixTbl.'surat_permohonan_data_ganda', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
                
        function show_list_surat_permohonan($prop,$kab,$status){    
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT a.*,b.id idUpload FROM ".$prefixTbl."surat_permohonan_data_ganda a ";
            $sql .= "INNER JOIN ".$prefixTbl."upload_data_ganda_revisi b ON a.no_registrasi_revisi=b.NO_REGISTER ";
            if($prop != "" && $kab == ""){
                $sql .= "WHERE a.nm_propinsi='$prop'";
            }
            if($prop == "" && $kab != ""){
                $sql .= "WHERE a.nm_kabupaten='$kab'";
            }
            if($prop != "" && $kab != ""){
                $sql .= "WHERE a.nm_propinsi='$prop' AND a.nm_kabupaten='$kab'";
            }
            $sql .= " AND status_permohonan IN ($status)";
            
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showPermohonanById($where,$table){            
            $query = $this->db->get_where($table, $where);
            return $query;
        }
        
        function showUploadRevisiById($where){
            $prefixTbl = $this->db->dbprefix;
            $query = $this->db->get_where($prefixTbl.'upload_data_ganda_revisi', $where);
            return $query;
        }
                
        public function upload_file($filename,$nama_file){
            $this->load->library('upload'); // Load librari upload

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size']	= '2048';
            $config['overwrite'] = true;
            $config['file_name'] = $nama_file;

            $this->upload->initialize($config); // Load konfigurasi uploadnya
            if($this->upload->do_upload($filename)){ // Lakukan upload dan Cek jika proses upload berhasil
                // Jika berhasil :
                $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
                return $return;
            }else{
                // Jika gagal :
                $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
                return $return;
            }
        }                
        
        function update_data_multiple($data){
            $prefixTbl = $this->db->dbprefix;
            return $this->db->update_batch($prefixTbl.'data_ganda',$data, 'IDARTBDT');
        }                
        
        function getNoRegDataRevisi($prov,$kab){
            $prefixTbl = $this->db->dbprefix;
            $extQry = "";
            if($prov!="" && $kab==""){
                $extQry = "WHERE PROVINSI='$prov'";
            } elseif($prov=="" && $kab!=""){
                $extQry = "WHERE KABUPATEN='$kab'";
            } elseif($prov!="" && $kab!="") {
                $extQry = "WHERE PROVINSI='$prov' AND KABUPATEN='$kab'";
            }
            $sql = "SELECT * FROM ".$prefixTbl."upload_data_ganda_revisi $extQry ORDER BY id DESC";
            $query = $this->db->query($sql);
            return $query;
        }
    }
?>