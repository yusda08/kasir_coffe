<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Temp_admin
 *
 * @author yusda08
 */
class Temp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
    }

    public function layout_admin() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $id['row_pro'] = $this->Model_setting->get_setProfil();
                $data['head'] = $this->load->view('temp_admin/head', $id, TRUE);
                $data['nav'] = $this->load->view('temp_admin/nav', NULL, TRUE);
                $data['nav_header'] = $this->load->view('temp_admin/nav_header', $id, TRUE);
                $data['footer'] = $this->load->view('temp_admin/footer', NULL, TRUE);
                return $data;
            } 
        }
    }
    
    public function layout_kasir() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 2) {
                $id['row_pro'] = $this->Model_setting->get_setProfil();
                $id['kode_order'] = "Ord-" . $this->Model_aksi->getGUID();
                $data['head'] = $this->load->view('temp_kasir/head', $id, TRUE);
                $data['nav'] = $this->load->view('temp_kasir/nav', $id, TRUE);
                $data['nav_header'] = $this->load->view('temp_kasir/nav_header', $id, TRUE);
//                $data['nav_header'] = $this->load->view('temp_kasir/nav_header', $id, TRUE);
                $data['footer'] = $this->load->view('temp_kasir/footer', NULL, TRUE);
                return $data;
            } 
        }
    }

}
