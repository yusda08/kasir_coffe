<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Laporan_html
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Temp.php');

class Laporan_html extends Temp {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_aksi');
        $this->load->model('Model_transaksi');
        $this->load->model('Model_setting');
        $this->load->model('Tgl_indo');
    }

    public function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $data['name_page'] = 'Laporan';
                $data['name_page_small'] = 'Admin';
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
                $record['get_setUser'] = $this->Model_setting->get_setUser();
                $record['get_transOrderJoinUser'] = $this->Model_transaksi->get_transOrderJoinUser();
                $data['content'] = $this->load->view('admin/laporan/laporan_index', $record, TRUE);
                $this->load->view('temp_admin/layout', $data);
            } else {
                redirect('login');
            }
        }
    }
    
    function cetak_strukOrder() {
        $kode_order = $this->input->get('kode_order');
        $record['kode_order'] = $kode_order;
        $record['get_transOrderJoinUser'] = $this->Model_transaksi->get_transOrderJoinUser();
        $record['get_transOrderDetail'] = $this->Model_transaksi->get_transOrderDetail($kode_order);
        $record['row_pro'] = $this->Model_setting->get_setProfil();
        $this->load->view('admin/laporan/cetak_struk', $record);
//        $this->load->view('admin/laporan/paper', $data);
    }

}
