<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trans_pengeluaran
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Temp.php');

class Trans_pengeluaran extends Temp {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_aksi');
        $this->load->model('Model_transaksi');
        $this->load->model('Model_master');
        $this->load->model('Tgl_indo');
    }

    public function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
            } else {
                $data = $this->layout_kasir();
                $record['javasc'] = $this->load->view('kasir/js', NULL, TRUE);
            }
            $data['name_page'] = 'Transaksi';
            $data['name_page_small'] = 'Pengeluaran';
            $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
            $record['get_transPengeluaranJoinUser'] = $this->Model_transaksi->get_transPengeluaranJoinUser();
            $data['content'] = $this->load->view('transaksi/pengeluaran', $record, TRUE);
            if ($a['level_user'] == 1) {
                $this->load->view('temp_admin/layout', $data);
            } else {
                $this->load->view('temp_kasir/layout', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function insertPengeluaran() {
        $data['tanggal'] = $this->input->post('tanggal');
        $data['harga'] = str_replace('.', '', $this->input->post('harga'));
        $data['id_user'] = $this->input->post('id_user');
        $data['nama_belanja'] = $this->input->post('nama_belanja');
        $query = $this->Model_aksi->insert('trans_pengeluaran', $data);
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    public function updatePengeluaran() {
        $id = $this->input->post('id');
        $data['tanggal'] = $this->input->post('tanggal');
        $data['harga'] = str_replace('.', '', $this->input->post('harga'));
        $data['id_user'] = $this->input->post('id_user');
        $data['nama_belanja'] = $this->input->post('nama_belanja');
        $query = $this->Model_aksi->update('id',$id,'trans_pengeluaran', $data);
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    public function deletePengeluaran() {
        $id = $this->input->post('id');
        $query = $this->Model_aksi->delete('id',$id,'trans_pengeluaran');
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
