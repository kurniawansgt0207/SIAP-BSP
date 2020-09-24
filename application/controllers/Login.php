<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller {

        //Fungsi __construct akan dieksekusi terlebih dahulu saat class login di panggil
        function __construct()
        {
            parent::__construct();

            $this->load->model('Model_login');
        }

        // fungsi utama pada class login
        function index()
        {            
            if ($this->input->post('tombol_login')){

                $this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

                if($this->form_validation->run() == FALSE)
                {
                    $this->load->view('v_login');
                }
                else
                {
                    redirect('dashboard');
                }

            } else {

                $this->load->helper(array('form'));
                $this->load->view('v_login');
            }
        }

        // fungsi untuk mengecek ke database, username dan password yang diinputkan oleh user 
        function check_database($password)
        {

            $username = $this->input->post('username');

            $result = $this->Model_login->user($username,$password);

            if($result)
            {
                $sess_array = array();
                foreach($result as $row)
                {
                    $sess_array = array(
                        'id' => $row->id,
                        'username' => $row->username,
                        'nama_pengguna' => $row->fullname,
                        'group_pengguna' => $row->group_user,
                        'provinsi' => $row->provinsi,
                        'kabupaten' => $row->kabupaten
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                }
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('check_database', 'Username atau Password salah');
                return false;
            }
        }

        //fungsi untuk logout
        function logout_proses(){
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('login');
        }
    }
?>