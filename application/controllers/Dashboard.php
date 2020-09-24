<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {

        //Fungsi __construct akan dieksekusi terlebih dahulu saat class login di panggil
        function __construct()
        {
            parent::__construct();

            $this->load->model('Model_dashboard');
            $this->load->model('Model_group_access');
        }

    	function index() {
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
            
            $result['menu'] = $result['menu_group_none'][0]->module_name;
            $prefixTbl = $this->db->dbprefix;
            
            $result['data_clean'] = $this->Model_dashboard->getTotalData($prefixTbl.'data_ganda','CLEAN',$session_data['provinsi'])->result();
            $result['data_unclean'] = $this->Model_dashboard->getTotalData($prefixTbl.'data_ganda','UNCLEAN',$session_data['provinsi'])->result();
            $result['data_nonaktif'] = $this->Model_dashboard->getTotalData($prefixTbl.'data_ganda','NONAKTIF',$session_data['provinsi'])->result();
            $result['total_data'] = $this->Model_dashboard->getTotalData($prefixTbl.'data_ganda','',$session_data['provinsi'])->result();
            $result['totalperprop'] = $this->Model_dashboard->getProvinsi($prefixTbl.'data_ganda','',$session_data['provinsi'])->result();
            $result['cleanperprop'] = $this->Model_dashboard->getProvinsi($prefixTbl.'data_ganda','CLEAN',$session_data['provinsi'])->result();
            $result['uncleanperprop'] = $this->Model_dashboard->getProvinsi($prefixTbl.'data_ganda','UNCLEAN',$session_data['provinsi'])->result();
            $result['nonaktifperprop'] = $this->Model_dashboard->getProvinsi($prefixTbl.'data_ganda','NONAKTIF',$session_data['provinsi'])->result();
            $this->load->view('overview',$result);
    	}
    }
?>