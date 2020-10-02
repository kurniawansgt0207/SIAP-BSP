<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ini_set('memory_limit','2048M'); 
    class Laporan extends CI_Controller {
        
        function __construct()
        {
            parent::__construct();

            $this->load->model('Model_transaksi');
            $this->load->model('Model_group_access');
            $this->load->library('pdf');
        }
        
        function index(){
            
        }
        
        function list_of_kab(){
            $postData = $this->input->post();

            $prov = isset($postData['prov'])?$postData['prov']:'';
            $result['kab_kota'] = $this->Model_transaksi->getKabKota($prov)->result();
            $this->load->view('transaksi/v_kab_list', $result);
        }        
        
        function summary_keluarga(){
            $this->report_summary("A","KEL");
        }
        
        function summary_identik(){
            $this->report_summary("B","IDT");
        }
        
        function detail_keluarga(){
            $this->report_detail("A","KEL");
        }
        
        function detail_identik(){
            $this->report_detail("B","IDT");
        }
        
        function report_summary($tipe,$label){
            if(!$this->session->userdata('logged_in'))
            {
                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pemberitahuan', $pemberitahuan);
                redirect('login');
            }
                        
            $prefixTbl = $this->db->dbprefix;
            $session_data = $this->session->userdata('logged_in');            
            $result['nama_pengguna'] = $session_data['nama_pengguna'];
            $result['username'] = $session_data['username'];
            $result['group_pengguna'] = $session_data['group_pengguna'];
            $result['provinsi_pengguna'] = $session_data['provinsi'];
            $result['kabupaten_pengguna'] = $session_data['kabupaten'];            
            
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
            
            $result['menu'] = ($tipe=='A') ? "rpt_ganda_keluarga" : "rpt_ganda_identik";
            $result['title'] = ($tipe=='A') ? "Keluarga" : "Identik";
            $result['tipe'] = $tipe;
            $result['label'] = $label;
            $result['provinsi'] = $this->Model_transaksi->getProvinsi($session_data['provinsi'])->result();
            $this->load->view('laporan/summary_data_ganda', $result);
        }
        
        function report_detail($tipe,$label){
            if(!$this->session->userdata('logged_in'))
            {
                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pemberitahuan', $pemberitahuan);
                redirect('login');
            }
                        
            $prefixTbl = $this->db->dbprefix;
            $session_data = $this->session->userdata('logged_in');            
            $result['nama_pengguna'] = $session_data['nama_pengguna'];
            $result['username'] = $session_data['username'];
            $result['group_pengguna'] = $session_data['group_pengguna'];
            $result['provinsi_pengguna'] = $session_data['provinsi'];
            $result['kabupaten_pengguna'] = $session_data['kabupaten'];            
            
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
            
            $result['menu'] = ($tipe=='A') ? "rpt_ganda_keluarga" : "rpt_ganda_identik";
            $result['title'] = ($tipe=='A') ? "Keluarga" : "Identik";
            $result['tipe'] = $tipe;
            $result['label'] = $label;
            $result['provinsi'] = $this->Model_transaksi->getProvinsi($session_data['provinsi'])->result();
            $this->load->view('laporan/rekap_data_ganda', $result);
        }
        
        function list_data_summary(){
            $postData = $this->input->post();
            $tipe = isset($postData['tipe'])?$postData['tipe']:'';
            $label = isset($postData['label'])?$postData['label']:'';
            $prov = isset($postData['prov'])?$postData['prov']:'';
            $kab = isset($postData['kab'])?$postData['kab']:'';
            
            $this->summary_data($tipe, $label, $prov, $kab);
        }
        
        function list_data_detail(){
            $postData = $this->input->post();
            $tipe = isset($postData['tipe'])?$postData['tipe']:'';
            $label = isset($postData['label'])?$postData['label']:'';
            $prov = isset($postData['prov'])?$postData['prov']:'';
            $kab = isset($postData['kab'])?$postData['kab']:'';
            
            $this->detail_data($tipe, $label, $prov, $kab);
        }
        
        function summary_data($tipe,$label,$prov,$kab){
            $prefixTbl = $this->db->dbprefix;
            if(!$this->session->userdata('logged_in'))
            {
                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pemberitahuan', $pemberitahuan);
                redirect('login');
            }
            
            $session_data = $this->session->userdata('logged_in');            
            $result['nama_pengguna'] = $session_data['nama_pengguna'];
            $result['username'] = $session_data['username'];
            $result['group_pengguna'] = $session_data['group_pengguna'];
            $result['provinsi_pengguna'] = isset($session_data['provinsi']) ? $session_data['provinsi'] : $prov;
            $result['kabupaten_pengguna'] = isset($session_data['kabupaten']) ? $session_data['kabupaten'] : $kab;
                        
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
            
            $tblName1 = ($tipe=='A') ? $prefixTbl.'data_ganda' : $prefixTbl.'data_ganda_identik';
            $tblName2 = ($tipe=='A') ? $prefixTbl.'data_ganda_revisi' : $prefixTbl.'data_ganda_revisi_identik';
            
            $result['menu'] = "rpt_data_ganda";
            $result['data_rekap'] = $this->Model_transaksi->rekap_data_per_provinsi($tblName1,$tblName2,$result['provinsi_pengguna'],$result['kabupaten_pengguna'])->result();
            $result['tipe'] = $tipe;
            $result['label'] = $label;
            $page = 'summary_data_ganda_list_prov';
            $this->load->view('laporan/'.$page, $result);
        }
        
        function detail_data($tipe,$label,$prov,$kab){
            $prefixTbl = $this->db->dbprefix;
            if(!$this->session->userdata('logged_in'))
            {
                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pemberitahuan', $pemberitahuan);
                redirect('login');
            }
            
            $session_data = $this->session->userdata('logged_in');            
            $result['nama_pengguna'] = $session_data['nama_pengguna'];
            $result['username'] = $session_data['username'];
            $result['group_pengguna'] = $session_data['group_pengguna'];
            $result['provinsi_pengguna'] = isset($session_data['provinsi']) ? $session_data['provinsi'] : $prov;
            $result['kabupaten_pengguna'] = isset($session_data['kabupaten']) ? $session_data['kabupaten'] : $kab;
                        
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
            
            $tblName1 = ($tipe=='A') ? $prefixTbl.'data_ganda' : $prefixTbl.'data_ganda_identik';
            $tblName2 = ($tipe=='A') ? $prefixTbl.'data_ganda_revisi' : $prefixTbl.'data_ganda_revisi_identik';
            
            $result['menu'] = "rpt_data_ganda";
            $result['data_rekap'] = $this->Model_transaksi->select_data($tblName,$where,$orderBy)->result();
            $result['tipe'] = $tipe;
            $result['label'] = $label;
            
            $this->load->view('laporan/rekap_data_ganda_list', $result);
        }       
        
        function export_pdf($tipe,$label,$prov,$kab){
            $prefixTbl = $this->db->dbprefix;
            if($tipe=='A' && $label=='KEL'){
                $tblName = $prefixTbl.'data_ganda';
                $label = "AWAL KELUARGA";
            } elseif($tipe=='B' && $label=='KEL'){
                $tblName = $prefixTbl.'data_ganda_revisi';
                $label = "PERBAIKAN KELUARGA";
            } elseif($tipe=='A' && $label=='IDT'){
                $tblName = $prefixTbl.'data_ganda_identik';
                $label = "AWAL IDENTIK";
            } elseif($tipe=='B' && $label=='IDT'){
                $tblName = $prefixTbl.'data_ganda_revisi_identik';
                $label = "PERBAIKAN IDENTIK";
            }                                    
            $nmProp = str_replace("%20", " ", $prov);
            $where = ($tipe=='A') ? "NMPROP='$nmProp'" : "STATUS_BARU<>''";
            $orderBy = "IDKELUARGA ASC";
            $result = $this->Model_transaksi->select_data($tblName,$where,$orderBy)->result();            
                        
            $pdf = new FPDF('L','mm','Legal');
                        
            // membuat halaman baru
            $pdf->AddPage();
            $pdf->SetLeftMargin(7);       
            $pdf->SetAutoPageBreak(20, 4);
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Courier','B',17);
            // mencetak string 
            $pdf->Cell(330,7,'DAFTAR DATA GANDA '.$label.' PENERIMA BSP',0,1,'C');         
            $pdf->Cell(10,7,'',0,1);
            $pdf->SetFont('Courier','B',12);
            $pdf->Cell(330,7,'PROVINSI: '.$nmProp,0,0,'C');        
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10,7,'',0,1);            
            
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(17,8,'NO',1,0,'C');
            $pdf->Cell(35,8,'NO KARTU',1,0,'C');
            $pdf->Cell(35,8,'NIK KTP',1,0,'C');
            $pdf->Cell(35,8,'NO KK',1,0,'C');
            $pdf->Cell(40,8,'ID KELUARGA',1,0,'C');
            $pdf->Cell(40,8,'IDARTBDT',1,0,'C');
            $pdf->Cell(65,8,'NAMA PENERIMA',1,0,'C');            
            $pdf->Cell(30,8,'STATUS',1,1,'C');
            
            $pdf->SetFont('Helvetica','',10);                                   
            $no=1;
            foreach ($result as $row){
                $pdf->Cell(17,7,$no,1,0,'C');
                $pdf->Cell(35,7,$row->NOMOR_KARTU,1,0,'C');
                $pdf->Cell(35,7,$row->NIK_KTP,1,0,'C');
                $pdf->Cell(35,7,$row->NOKK_DTKS,1,0,'C');
                $pdf->Cell(40,7,$row->IDKELUARGA,1,0,'C');
                $pdf->Cell(40,7,$row->IDARTBDT,1,0,'C');
                $pdf->Cell(65,7,$row->NAMA_PENERIMA,1,0,'L');
                if($tipe=='A'){
                    $pdf->Cell(30,7,$row->KET_TAMBAHAN,1,1,'C'); 
                } elseif($tipe=='B'){
                    $pdf->Cell(30,7,$row->STATUS_BARU,1,1,'C'); 
                }
                $no++;
            }
                                    
            $fileName = 'Daftar_Data_Ganda_' . $label . '_' . $nmProp . '.pdf';
            $pdf->Output($fileName, 'I');
        }                    
    }
    
?>