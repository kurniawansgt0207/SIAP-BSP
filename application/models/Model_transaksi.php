<?php
    Class Model_transaksi extends CI_Model
    {
        function showData($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){            
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT * FROM ".$prefixTbl."data_ganda_revisi "
                    . "WHERE NAMA_PENERIMA != '' AND ID_UPLOAD='' AND STATUS_DATA=''";
            $sql .= ($param1 != '') ? " AND NMPROP='".$param1."' " : "";
            $sql .= ($param2 != '') ? " AND NMKAB='".$param2."' " : "";
            $sql .= ($param3 != '') ? " AND NMKEC='".$param3."' " : "";
            $sql .= ($param5 != '') ? " AND (KET_TAMBAHAN='".$param5."' OR STATUS_BARU='".$param5."') " : "";
            //$sql .= ($param6 != '') ? " AND NIK_KTP LIKE '%".$param6."%' " : "";
            //$sql .= ($param7 != '') ? " AND NAMA_PENERIMA LIKE '%".$param7."%' " : "";
            $sql .= " ORDER BY ".$param4." ASC";
            //echo $sql;
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showDataIdentik($param1="",$param2="",$param3="",$param4="",$param5="",$param6="",$param7=""){            
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT * FROM ".$prefixTbl."data_ganda_revisi_identik "
                    . "WHERE NAMA_PENERIMA != '' AND ID_UPLOAD='' AND STATUS_DATA=''";
            $sql .= ($param1 != '') ? " AND NMPROP='".$param1."' " : "";
            $sql .= ($param2 != '') ? " AND NMKAB='".$param2."' " : "";
            $sql .= ($param3 != '') ? " AND NMKEC='".$param3."' " : "";
            $sql .= ($param5 != '') ? " AND (KET_TAMBAHAN='".$param5."' OR STATUS_BARU='".$param5."') " : "";
            //$sql .= ($param6 != '') ? " AND NIK_KTP LIKE '%".$param6."%' " : "";
            //$sql .= ($param7 != '') ? " AND NAMA_PENERIMA LIKE '%".$param7."%' " : "";
            $sql .= " ORDER BY ".$param4." ASC";
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
        
        function showDataPerbaikan($param1,$param2){
            $prefixTbl = $this->db->dbprefix;                 
            $qryKab = ($param2!="") ? " AND a.NMKAB='$param2' " : "";
            $qryGroup = ($param2!="") ? ", a.NMKAB " : "";
            $sql = "SELECT 'Ganda Keluarga' label,
            SUM(clean) clean,SUM(unclean) unclean,SUM(nonaktif) nonaktif
            FROM
            (
            SELECT COUNT(a.STATUS_BARU) clean,0 unclean, 0 nonaktif
            FROM siap_data_ganda_revisi a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='CLEAN' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA=''
            GROUP BY a.NMPROP $qryGroup
            UNION ALL
            SELECT 0 clean,COUNT(a.STATUS_BARU) unclean, 0 nonaktif
            FROM siap_data_ganda_revisi a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='UNCLEAN' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA=''
            GROUP BY a.NMPROP $qryGroup
            UNION ALL
            SELECT 0 clean,0 unclean,COUNT(a.STATUS_BARU) nonaktif
            FROM siap_data_ganda_revisi a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='NONAKTIF' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA=''
            GROUP BY a.NMPROP $qryGroup
            ) as keluarga
            UNION ALL
            SELECT 'Ganda Identik' label,
            SUM(clean) clean,SUM(unclean) unclean,SUM(nonaktif) nonaktif
            FROM
            (
            SELECT COUNT(a.STATUS_BARU) clean,0 unclean, 0 nonaktif
            FROM siap_data_ganda_revisi_identik a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='CLEAN' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA=''
            GROUP BY a.NMPROP $qryGroup
            UNION ALL
            SELECT 0 clean,COUNT(a.STATUS_BARU) unclean, 0 nonaktif
            FROM siap_data_ganda_revisi_identik a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='UNCLEAN' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA='Registered'
            GROUP BY a.NMPROP $qryGroup
            UNION ALL
            SELECT 0 clean,0 unclean,COUNT(a.STATUS_BARU) nonaktif
            FROM siap_data_ganda_revisi_identik a
            WHERE a.NMPROP='$param1' $qryKab AND a.STATUS_BARU='NONAKTIF' 
            AND a.ID_UPLOAD='' AND a.STATUS_DATA=''
            GROUP BY a.NMPROP $qryGroup
            ) as indentik";
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
            $sql = "SELECT count(*) jmldata FROM ".$table." WHERE ".$where;
            $query = $this->db->query($sql);
            return $query;
        }
        
        function select_data($table,$where,$orderby){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $this->db->order_by($orderby);
            $this->db->limit(200,0);
            $query = $this->db->get();

            if ($query && $query->num_rows() > 0) {
                return $query;
            } else {
                return false;
            }
        }
        
        function insert_data($table,$data){
            $this->db->insert($table,$data);
        }
        
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
	}	
        
        function rekap_data($table,$provinsi,$kabupaten,$kecamatan){
            $extQry1 = "";
            $extQry2 = "";
            
            if($provinsi!='' && $kabupaten !='' && $kecamatan!=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten' AND a.NMKEC='$kecamatan'";
                $extQry2 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten' AND a.NMKEC='$kecamatan'";
            } elseif($provinsi!='' && $kabupaten !='' && $kecamatan=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten'";
                $extQry2 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten'";
            } elseif($provinsi!='' && $kabupaten =='' && $kecamatan=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi'";
                $extQry2 = " AND a.NMPROP='$provinsi'";
            }
            
            $prefixTbl = $this->db->dbprefix;
            
            $sql = "SELECT NMPROP,sum(total_data) total_data,sum(jml_clean) jml_clean,sum(jml_unclean) jml_unclean,
            sum(jml_nonaktif) jml_nonaktif
            FROM
            (
            SELECT a.NMPROP,COUNT(a.IDARTBDT) total_data,0 jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a
            $extQry1
            GROUP BY NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.KET_TAMBAHAN='CLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.KET_TAMBAHAN='UNCLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$table." a 
            WHERE a.KET_TAMBAHAN='NONAKTIF' $extQry2
            GROUP BY a.NMPROP
            ) aa GROUP BY NMPROP;";
            $query = $this->db->query($sql);
            //echo $sql;
            return $query;
        }
        
        function rekap_data_revisi($table,$provinsi,$kabupaten,$kecamatan){
            $extQry1 = "";
            $extQry2 = "";
            
            if($provinsi!='' && $kabupaten !='' && $kecamatan!=''){
                $extQry1 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten' AND a.NMKEC='$kecamatan'";
                $extQry2 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten' AND a.NMKEC='$kecamatan'";
            } elseif($provinsi!='' && $kabupaten !='' && $kecamatan=''){
                $extQry1 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten'";
                $extQry2 = " AND a.NMPROP='$provinsi' AND a.NMKAB='$kabupaten'";
            } elseif($provinsi!='' && $kabupaten =='' && $kecamatan=''){
                $extQry1 = " AND a.NMPROP='$provinsi'";
                $extQry2 = " AND a.NMPROP='$provinsi'";
            }
            
            $prefixTbl = $this->db->dbprefix;
            
            $sql = "SELECT NMPROP,sum(total_data) total_data,sum(jml_clean) jml_clean,sum(jml_unclean) jml_unclean,
            sum(jml_nonaktif) jml_nonaktif
            FROM
            (
            SELECT a.NMPROP,COUNT(a.IDARTBDT) total_data,0 jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.ID_UPLOAD='' AND a.STATUS_DATA=''
            $extQry1
            GROUP BY NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.ID_UPLOAD='' AND a.STATUS_DATA=''
            AND a.STATUS_BARU='CLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.ID_UPLOAD='' AND a.STATUS_DATA=''
            AND a.STATUS_BARU='UNCLEAN' $extQry2
            GROUP BY a.NMPROP
            UNION ALL
            SELECT a.NMPROP,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$table." a 
            WHERE a.ID_UPLOAD='' AND a.STATUS_DATA=''
            AND a.STATUS_BARU='NONAKTIF' $extQry2
            GROUP BY a.NMPROP
            ) aa GROUP BY NMPROP;";
            $query = $this->db->query($sql);
            //echo $sql;
            return $query;
        }
        
        function rekap_data_per_provinsi($table1,$table2,$provinsi,$kabupaten){
            $extQry1 = "";
            $extQry2 = "";
            
            if($provinsi!='' && $kabupaten==''){
                $extQry1 = " WHERE a.NMPROP='$provinsi'";
                $extQry2 = " AND a.NMPROP='$provinsi'";
            } else if($provinsi=='' && $kabupaten!=''){
                $extQry1 = " WHERE a.NMKAB='$provinsi'";
                $extQry2 = " AND a.NMKAB='$provinsi'";
            } else if($provinsi!='' && $kabupaten!=''){
                $extQry1 = " WHERE a.NMPROP='$provinsi' AND a.MNKAB='$kabupaten'";
                $extQry2 = " AND a.NMPROP='$provinsi' AND a.MNKAB='$kabupaten'";
            }
            
            $prefixTbl = $this->db->dbprefix;
            
            $sql = "SELECT label,SUM(clean) clean,SUM(unclean) unclean,SUM(nonaktif) nonaktif,
            (SUM(clean)+SUM(unclean)+SUM(nonaktif)) total,NMPROP
            FROM
            (
            SELECT 'Awal' label,COUNT(a.KET_TAMBAHAN) clean,0 unclean,0 nonaktif,a.NMPROP 
            FROM $table1 a
            WHERE a.NMPROP='jawa barat' and a.KET_TAMBAHAN='CLEAN'
            GROUP BY a.NMPROP,a.KET_TAMBAHAN
            UNION ALL
            SELECT 'Awal' label,0 clean,COUNT(a.KET_TAMBAHAN) unclean,0 nonaktif,a.NMPROP 
            FROM $table1 a
            WHERE a.NMPROP='jawa barat' and a.KET_TAMBAHAN='UNCLEAN'
            GROUP BY a.NMPROP,a.KET_TAMBAHAN
            UNION ALL
            SELECT 'Awal' label,0 clean,0 unclean,COUNT(a.KET_TAMBAHAN) nonaktif,a.NMPROP 
            FROM $table1 a
            WHERE a.NMPROP='jawa barat' and a.KET_TAMBAHAN='NONAKTIF'
            GROUP BY a.NMPROP,a.KET_TAMBAHAN
            ) AS dtawal GROUP BY dtawal.label,dtawal.NMPROP
            UNION ALL
            SELECT label,SUM(clean) clean,SUM(unclean) unclean,SUM(nonaktif) nonaktif,
            (SUM(clean)+SUM(unclean)+SUM(nonaktif)) total,NMPROP
            FROM
            (
            SELECT 'Perbaikan' label,COUNT(a.KET_TAMBAHAN) clean,0 unclean,0 nonaktif,a.NMPROP 
            FROM $table2 a
            WHERE a.NMPROP='jawa barat' and a.STATUS_BARU='CLEAN'
            GROUP BY a.NMPROP,a.STATUS_BARU
            UNION ALL
            SELECT 'Perbaikan' label,0 clean,COUNT(a.KET_TAMBAHAN) unclean,0 nonaktif,a.NMPROP 
            FROM $table2 a
            WHERE a.NMPROP='jawa barat' and a.STATUS_BARU='UNCLEAN'
            GROUP BY a.NMPROP,a.STATUS_BARU
            UNION ALL
            SELECT 'Perbaikan' label,0 clean,0 unclean,COUNT(a.KET_TAMBAHAN) nonaktif,a.NMPROP 
            FROM $table2 a
            WHERE a.NMPROP='jawa barat' and a.STATUS_BARU='NONAKTIF'
            GROUP BY a.NMPROP,a.STATUS_BARU
            ) AS dtrevisi GROUP BY dtrevisi.label,dtrevisi.NMPROP";
            $query = $this->db->query($sql);
            //echo $sql;
            return $query;
        }
        
        function rekap_data_prop_kab($table,$prop,$kab){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT NMPROP,NMKAB,SUM(total_data) total_data,SUM(jml_clean) jml_clean,SUM(jml_unclean) jml_unclean,
            SUM(jml_nonaktif) jml_nonaktif
            FROM
            (            
            SELECT a.NMPROP,a.NMKAB,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='CLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='UNCLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.KET_TAMBAHAN='NONAKTIF'
            GROUP BY a.NMPROP,a.NMKAB
            ) aa GROUP BY aa.NMPROP,aa.NMKAB;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function rekap_data_revisi_prop_kab($table,$prop,$kab){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT NMPROP,NMKAB,SUM(total_data) total_data,SUM(jml_clean) jml_clean,SUM(jml_unclean) jml_unclean,
            SUM(jml_nonaktif) jml_nonaktif
            FROM
            (            
            SELECT a.NMPROP,a.NMKAB,0 total_data,COUNT(a.IDARTBDT) jml_clean,0 jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.STATUS_BARU='CLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,COUNT(a.IDARTBDT) jml_unclean,0 jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.STATUS_BARU='UNCLEAN'
            GROUP BY a.NMPROP,a.NMKAB
            UNION ALL
            SELECT a.NMPROP,a.NMKAB,0 total_data,0 jml_clean,0 jml_unclean,COUNT(a.IDARTBDT) jml_nonaktif 
            FROM ".$table." a 
            WHERE a.NMPROP='".$prop."' AND a.NMKAB='".$kab."' AND a.STATUS_BARU='NONAKTIF'
            GROUP BY a.NMPROP,a.NMKAB
            ) aa GROUP BY aa.NMPROP,aa.NMKAB;";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function update_status($id,$status,$tipe){
            $prefixTbl = $this->db->dbprefix;
            if($tipe=="A"){
                $table = $prefixTbl."data_ganda_revisi";
            } elseif($tipe=="B"){
                $table = $prefixTbl."data_ganda_identik_revisi";
            }
            $sql = "UPDATE ".$table." SET KET_TAMBAHAN='".$status."' WHERE NOMOR_KARTU='".$id."'";
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
            $sql = "SELECT a.*,b.ID idUpload,b.JML_CLEAN,b.JML_NONAKTIF FROM ".$prefixTbl."surat_permohonan_data_ganda a ";
            $sql .= "INNER JOIN ".$prefixTbl."register_data_ganda_revisi b ON a.no_registrasi_revisi=b.NO_REGISTER ";
            if($prop != "" && $kab == ""){
                $sql .= "WHERE a.nm_propinsi='$prop'";
            }                        
            
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
            $sql = "SELECT * FROM ".$prefixTbl."register_data_ganda_revisi $extQry ORDER BY id DESC";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function update_data_perbaikan($table,$id_register,$no_register,$where){
            $sql = "UPDATE $table SET ID_UPLOAD=$id_register, NO_REGISTER='$no_register' WHERE $where";
            $query = $this->db->query($sql);
        }
        
        function showDataAllPerbaikan($id){
            $sql = "SELECT revisi.*,c.NO_REGISTER,c.PROVINSI,c.ID_SURAT_PERMOHONAN FROM
            (
            SELECT a.ID_UPLOAD,'Ganda Keluarga' label,a.NOMOR_KARTU,a.NIK_KTP,a.NOKK_DTKS,
            a.IDKELUARGA,a.IDARTBDT,a.NAMA_PENERIMA,a.NMPROP,a.KET_TAMBAHAN,a.STATUS_BARU
            FROM siap_data_ganda_revisi a
            WHERE a.ID_UPLOAD=$id
            UNION ALL
            SELECT b.ID_UPLOAD,'Ganda Identik' label,b.NOMOR_KARTU,b.NIK_KTP,b.NOKK_DTKS,
            b.IDKELUARGA,b.IDARTBDT,b.NAMA_PENERIMA,b.NMPROP,b.KET_TAMBAHAN,b.STATUS_BARU 
            FROM siap_data_ganda_revisi_identik b
            WHERE b.ID_UPLOAD=$id
            ) AS revisi
            INNER JOIN siap_register_data_ganda_revisi c 
            ON revisi.ID_UPLOAD=c.ID ORDER BY revisi.label ASC,revisi.STATUS_BARU ASC";
            //echo $sql;
            $query = $this->db->query($sql);
            return $query;
        }
    }
?>