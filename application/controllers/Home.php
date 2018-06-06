<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Home extends Temp {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_aksi');
        $this->load->model('Model_transaksi');
        $this->load->model('Tgl_indo');
    }

    public function admin() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $data['name_page'] = 'Dasboard';
                $data['name_page_small'] = 'Admin';
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
                $record['ttl_hr'] = $this->Model_transaksi->get_transOrderJoinDetailWhereTgl(date('Y-m-d'));
                $record['total'] = $this->Model_transaksi->get_transOrderJoinDetail();
                $record['ttl_pengeluaran_hr'] = $this->Model_transaksi->get_transPengeluaranWhereTgl(date('Y-m-d'));
                $record['ttl_pengeluaran'] = $this->Model_transaksi->get_transPengeluaran();
                $data['content'] = $this->load->view('admin/dasboard', $record, TRUE);
                $this->load->view('temp_admin/layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    public function kasir() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 2) {
                $data = $this->layout_kasir();
//                $data['name_page'] = 'ada';
//                $data['name_page_small'] = 'Kasir';
                $record['javasc'] = $this->load->view('kasir/js', NULL, TRUE);
                $record['kode_order'] = "Ord-" . $this->Model_aksi->getGUID();
                $record['get_transOrderJoinUser'] = $this->Model_transaksi->get_transOrderJoinUser();
                $data['content'] = $this->load->view('kasir/baranda', $record, TRUE);
                $this->load->view('temp_kasir/layout', $data);
            } else {
                redirect('login');
            }
        }
    }

}
