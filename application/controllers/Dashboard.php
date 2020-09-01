<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {

        //Fungsi __construct akan dieksekusi terlebih dahulu saat class login di panggil
        function __construct()
        {
            parent::__construct();

            $this->load->model('Model_dashboard');
        }

    	function index() {
            //$session_data = $this->session->userdata('logged_in');
            //$result['nama_pengguna'] = $session_data['nama_pengguna'];
            $result['menu'] = 'dashboard';
            $result['data_clean'] = $this->Model_dashboard->getTotalData('data_ganda','CLEAN')->result();
            $result['data_unclean'] = $this->Model_dashboard->getTotalData('data_ganda','UNCLEAN')->result();
            $result['data_nonaktif'] = $this->Model_dashboard->getTotalData('data_ganda','NONAKTIF')->result();
            $result['total_data'] = $this->Model_dashboard->getTotalData('data_ganda','')->result();
            $result['totalperprop'] = $this->Model_dashboard->getProvinsi('data_ganda','')->result();
            $result['cleanperprop'] = $this->Model_dashboard->getProvinsi('data_ganda','CLEAN')->result();
            $result['uncleanperprop'] = $this->Model_dashboard->getProvinsi('data_ganda','UNCLEAN')->result();
            $result['nonaktifperprop'] = $this->Model_dashboard->getProvinsi('data_ganda','NONAKTIF')->result();
            $this->load->view('overview',$result);
    	}
    }
?>