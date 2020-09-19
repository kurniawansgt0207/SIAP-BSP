<?php
    Class Model_transaksi extends CI_Model
    {
        function showData($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){
            /*$this->db->select('*');
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
            $this->db->order_by('NOKK_DTKS, IDARTBDT','ASC');            
            $this->db->limit(500);
            
            $query = $this->db->get();*/
            
            $sql = "SELECT TOP 50 * FROM data_ganda WHERE NAMA_PENERIMA != ''";
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
        
        function edit_data($where,$table){		
            return $this->db->get_where($table,$where);
        }
                
        function getProvinsi($provinsi){
            $sql = "SELECT a.NMPROVINSI FROM m_prov_kab_kec_kel_indonesia a ";
            if($provinsi!=''){
                $sql .= "WHERE NMPROVINSI='$provinsi'";
            }
            $sql .= "GROUP BY a.NMPROVINSI ORDER BY a.NMPROVINSI";
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
        
        function rekap_data_per_provinsi($provinsi){
            $extQry1 = "";
            $extQry2 = "";
            
            if($provinsi!=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi'";
                $extQry2 = " AND a.NMPROP='$provinsi'";
            }
            
            $sql = "SELECT NMPROP,sum(total_data) total_data,sum(jml_clean) jml_clean,sum(jml_unclean) jml_unclean,
            sum(jml_nonaktif) jml_nonaktif
            FROM
            (
            SELECT a.NMPROP,COUNT(a.IDARTBDT) total_data,0 jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM data_ganda a
            $extQry1
            GROUP BY NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='CLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='UNCLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM data_ganda a 
            WHERE a.KET_TAMBAHAN='NONAKTIF' $extQry2
            GROUP BY a.NMPROP
            ) aa GROUP BY NMPROP;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function rekap_data_prop_kab($prop,$kab){
            $sql = "SELECT NMPROP,NMKAB,SUM(total_data) total_data,SUM(jml_clean) jml_clean,SUM(jml_unclean) jml_unclean,
            SUM(jml_nonaktif) jml_nonaktif
            FROM
            (            
            SELECT a.NMPROP,a.NMKAB,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='CLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='UNCLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM data_ganda a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='NONAKTIF'
            GROUP BY a.NMPROP,a.NMKAB
            ) aa GROUP BY aa.NMPROP,aa.NMKAB;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function update_status($id,$status){
            $sql = "UPDATE data_ganda SET KET_TAMBAHAN='".$status."' WHERE IDARTBDT='".$id."'";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function submit_surat_permohonan($data){
            $this->db->insert('surat_permohonan', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        
        function submit_unggah_surat($data){
            $this->db->insert('surat_permohonan_data_ganda', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
                
        function show_list_surat_permohonan($prop,$kab){            
            $sql = "SELECT * FROM surat_permohonan_data_ganda a ";
            if($prop != "" && $kab == ""){
                $sql .= "WHERE a.nm_propinsi='$prop'";
            }
            if($prop == "" && $kab != ""){
                $sql .= "WHERE a.nm_kabupaten='$kab'";
            }
            if($prop != "" && $kab != ""){
                $sql .= "WHERE a.nm_propinsi='$prop' AND a.nm_kabupaten='$kab'";
            }
            
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showPermohonanById($where,$table){            
            $query = $this->db->get_where($table, $where, 100, 0);
            return $query;
        }
                
        public function upload_file($filename){
            $this->load->library('upload'); // Load librari upload

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size']	= '2048';
            $config['overwrite'] = true;
            $config['file_name'] = $filename;

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
            return $this->db->update_batch('data_ganda',$data, 'IDARTBDT');
        }
    }
?>