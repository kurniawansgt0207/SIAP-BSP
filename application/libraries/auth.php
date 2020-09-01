<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Auth {
        public function cek_auth()
        {
            $this->ci =& get_instance();
            $sesi  = $this->ci->session->userdata('login');
            if($sesi != true){
                redirect('login','refresh');
                exit();
            }
        }
    }
?>