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
            $result['provinsi_pengguna'] = $session_data['provinsi'];
            $result['kabupaten_pengguna'] = $session_data['kabupaten'];
                        
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
                        
            $result['provinsi'] = $this->Model_transaksi->getProvinsi($session_data['provinsi'])->result();
            $result['menu'] = "rpt_data_ganda";
            $this->load->view('laporan/rekap_data_ganda', $result);
        }
        
        function list_of_kab(){
            $postData = $this->input->post();

            $prov = isset($postData['prov'])?$postData['prov']:'';
            $result['kab_kota'] = $this->Model_transaksi->getKabKota($prov)->result();
            $this->load->view('transaksi/v_kab_list', $result);
        }
        
        /*function list_of_kec(){
            $postData = $this->input->post();

            $kab = isset($postData['kab'])?$postData['kab']:'';
            $result['kecamatan'] = $this->Model_transaksi->getKecamatan($kab)->result();
            $this->load->view('transaksi/v_kec_list', $result);
        }
        
        function list_of_kel(){
            $postData = $this->input->post();

            $kec = isset($postData['kec'])?$postData['kec']:'';
            $result['kelurahan'] = $this->Model_transaksi->getKelDesa($kec)->result();
            $this->load->view('transaksi/v_kel_list', $result);
        }*/          
        
        function summary_data(){
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
            $result['provinsi_pengguna'] = $session_data['provinsi'];
            $result['kabupaten_pengguna'] = $session_data['kabupaten'];
                        
            $result['menu_group_none'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'')->result();
            $result['menu_group_transaksi'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Transaksi')->result();
            $result['menu_group_laporan'] = $this->Model_group_access->showParentMenuGroup($session_data['group_pengguna'],'Laporan')->result();
            
            $result['menu'] = "rpt_data_ganda";
            $result['data_rekap_prop'] = $this->Model_transaksi->rekap_data_per_provinsi($session_data['provinsi'])->result();
            $this->load->view('laporan/summary_data_ganda_list', $result);
        }
        
        function list_data(){
            $postData = $this->input->post();

            $prov = isset($postData['prov'])?$postData['prov']:'';
            $kab = isset($postData['kab'])?$postData['kab']:'';
            $kec = isset($postData['kec'])?$postData['kec']:'';
            $kel = isset($postData['kel'])?$postData['kel']:'';
            $ket_tambahan = isset($postData['ket'])?$postData['ket']:'';
            $nik = isset($postData['nik'])?$postData['nik']:'';
            $nama = isset($postData['nama'])?$postData['nama']:'';

            $result['data'] = $this->Model_transaksi->showData($prov,$kab,$kec,$kel,$ket_tambahan,$nik,$nama)->result();      
            $this->load->view('laporan/rekap_data_ganda_list', $result);
        }       
        
        function export_pdf(){
            $postData = $this->input->post();

            $prov = isset($postData['provinsi'])?$postData['provinsi']:'';
            $kab = isset($postData['kab_kotax'])?$postData['kab_kotax']:'';
            $kec = isset($postData['kecamatanx'])?$postData['kecamatanx']:'';
            $kel = isset($postData['kel_desax'])?$postData['kel_desax']:'';
            $ket_tambahan = isset($postData['ket_tambahan'])?$postData['ket_tambahan']:'';
            $nik = isset($postData['nik'])?$postData['nik']:'';
            $nama = isset($postData['nama'])?$postData['nama']:'';
            
            $pdf = new FPDF('L','mm','Legal');
            // membuat halaman baru
            $pdf->AddPage();
            $pdf->SetLeftMargin(5);       
            $pdf->SetAutoPageBreak(20, 4);
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial','B',16);
            // mencetak string 
            $pdf->Cell(330,7,'DATA GANDA PENDUDUK',0,1,'C');         
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10,7,'',0,1);            
            
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35,8,'NO KARTU',1,0);
            $pdf->Cell(35,8,'NIK KTP',1,0);
            $pdf->Cell(63,8,'NAMA PENERIMA',1,0);            
            $pdf->Cell(45,8,'PROPINSI',1,0);
            $pdf->Cell(45,8,'KABUPATEN',1,0);
            $pdf->Cell(45,8,'KECAMATAN',1,0);
            $pdf->Cell(50,8,'KELURAHAN',1,0);
            $pdf->Cell(27,8,'KETERANGAN',1,1);
            $pdf->SetFont('Arial','',10);
           
            $result = $this->Model_transaksi->showData($prov,$kab,$kec,$kel,$ket_tambahan,$nik,$nama)->result(); 
            foreach ($result as $row){
                $pdf->Cell(35,7,$row->NOMOR_KARTU,1,0);
                $pdf->Cell(35,7,$row->NIK_KTP,1,0);
                $pdf->Cell(63,7,$row->NAMA_PENERIMA,1,0);  
                $pdf->Cell(45,7,$row->NMPROP,1,0); 
                $pdf->Cell(45,7,$row->NMKAB,1,0); 
                $pdf->Cell(45,7,$row->NMKEC,1,0); 
                $pdf->Cell(50,7,$row->NMKEL,1,0); 
                $pdf->Cell(27,7,$row->KET_TAMBAHAN,1,1); 
            }
            $pdf->Output();
        }
    }
    
?>