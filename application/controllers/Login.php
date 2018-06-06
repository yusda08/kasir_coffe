<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Login extends Temp {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_login');
        $this->load->model('Model_aksi');
        $this->load->model('Model_setting');
    }

    public function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                redirect('home/admin');
            }else if($a['level_user'] == 2){
                redirect('home/kasir');
            }
        } else {
            $record['row_pro'] = $this->Model_setting->get_setProfil();
            $this->load->view('login', $record);
        }
    }

    function validasi() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $row = $this->Model_login->validate_login($username, $password);
        $count_row = count($row);
        if ($count_row) { // jika data user benar
            if ($row->is_active == 1) {
                $data = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'password' => $row->password,
                    'level_user' => $row->level_user,
                    'nm_level' => $row->nm_level,
                    'nama_admin' => $row->nama_admin,
                    'is_active' => $row->is_active,
                    'foto' => $row->foto,
                    'no_telpon' => $row->no_telpon,
                    'email' => $row->email
                );
                $this->session->set_userdata('is_login', $data);
//                var_dump($data);
//                return;
                echo "true";
            } else {
                echo "false";
            }
        } else {
            return false;
        }
    }

    function logout() {
        $a = $this->session->userdata('is_login');
        $this->session->unset_userdata('is_login');
        redirect('login');
    }

}

?>