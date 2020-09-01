<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller {

        function index()
        {
            if(!$this->session->userdata('logged_in'))
            {
                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pemberitahuan', $pemberitahuan);
                redirect('login');
            }

            $session_data = $this->session->userdata('logged_in');
            $sesi['nama_pengguna'] = $session_data['nama_pengguna'];
            $sesi['username'] = $session_data['username'];            
            //$this->load->view('v_user',$sesi);
            $this->load->view('overview',$sesi);
        }
    }
?>