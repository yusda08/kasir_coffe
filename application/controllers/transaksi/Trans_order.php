<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trans_order
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Temp.php');

class Trans_order extends Temp {

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
            $data = $this->layout_admin();
            $data['name_page'] = 'Transaksi';
            $data['name_page_small'] = 'Order';
            $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
            $record['kode_order'] = "Ord-" . $this->Model_aksi->getGUID();
            $record['get_transOrderJoinUser'] = $this->Model_transaksi->get_transOrderJoinUser();
            $data['content'] = $this->load->view('transaksi/order', $record, TRUE);
            $this->load->view('temp_admin/layout', $data);
        } else {
            redirect('login');
        }
    }

    public function tambah_transaksi() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
            } else {
                $data = $this->layout_kasir();
                $record['javasc'] = $this->load->view('kasir/js', NULL, TRUE);
            }
            $kode_order = $this->input->get('kode_order');
            $data['name_page'] = 'Transaksi';
            $data['name_page_small'] = 'Tambah Order';
            $record['kode_order'] = $kode_order;
            $record['get_dataMenuJoinFoto'] = $this->Model_master->get_dataMenuJoinFoto();
            $record['row_pro']= $this->Model_setting->get_setProfil();
            $record['get_dataJenisMenu'] = $this->Model_master->get_dataJenisMenu();
            $record['get_transTemporaryDetail'] = $this->Model_transaksi->get_transTemporaryDetail($kode_order);
            $data['content'] = $this->load->view('transaksi/tambah_transaksi', $record, TRUE);
            if ($a['level_user'] == 1) {
                $this->load->view('temp_admin/layout', $data);
            } else {
                $this->load->view('temp_kasir/layout', $data);
            }
        } else {
            redirect('login');
        }
    }

    public function edit_transaksi() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
            } else {
                $data = $this->layout_kasir();
                $record['javasc'] = $this->load->view('kasir/js', NULL, TRUE);
            }
            $kode_order = $this->input->get('kode_order');
            $data['name_page'] = 'Transaksi';
            $data['name_page_small'] = 'Edit Order';
            $record['kode_order'] = $kode_order;
            $record['row_pro']= $this->Model_setting->get_setProfil();
            $record['get_dataMenuJoinFoto'] = $this->Model_master->get_dataMenuJoinFoto();
            $record['get_dataJenisMenu'] = $this->Model_master->get_dataJenisMenu();
            $record['get_transOrderDetail'] = $this->Model_transaksi->get_transOrderDetail($kode_order);
            $record['row_ord'] = $this->Model_transaksi->get_transOrder($kode_order);
            $data['content'] = $this->load->view('transaksi/edit_transaksi', $record, TRUE);
            if ($a['level_user'] == 1) {
                $this->load->view('temp_admin/layout', $data);
            } else {
                $this->load->view('temp_kasir/layout', $data);
            }
        } else {
            redirect('login');
        }
    }

    function lihat_menu() {
        $id_jenis_menu = $this->input->post('id_jenis_menu');
        $record['get_dataMenuJoinFoto'] = $this->Model_master->get_dataMenuWhereJenis($id_jenis_menu);
        $get_page = $this->load->view('transaksi/ajax/ajax_lihatMenu', $record, true);
        echo $get_page;
    }

    function ajax_tblKeranjang($kode_order) {
        $record['get_transTemporaryDetail'] = $this->Model_transaksi->get_transTemporaryDetail($kode_order);
        $record['row_pro']= $this->Model_setting->get_setProfil();
        $data = $this->load->view('transaksi/ajax/tabel_keranjang', $record);
//        echo $data;
    }

    function ajax_tblKeranjangEdit($kode_order) {
        $row_ord = $this->Model_transaksi->get_transOrder($kode_order);
        $record['tunai'] = $row_ord->tunai;
        $record['row_pro']= $this->Model_setting->get_setProfil();
        $record['get_transOrderDetail'] = $this->Model_transaksi->get_transOrderDetail($kode_order);
        $data = $this->load->view('transaksi/ajax/tabel_keranjang_edit', $record);
    }

    function insertMenuTempo() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        $row = $this->Model_master->get_dataMenuWhereKode($kode_menu);
        $row_krj = $this->Model_transaksi->get_transTemporaryDetailWhereKd($kode_menu, $kode_order);
        $qty = 0;
        $kode_barang = 0;
        if (!is_null($row_krj)) {
            $qty = $row_krj->qty;
            $kd_menu = $row_krj->kode_menu;
        }
        $harga_menu = @($row->harga_menu - ($row->harga_menu * $row->diskon_menu / 100));
        $data['kode_menu'] = $kode_menu;
        $data['kode_order'] = $kode_order;
        $data['harga_menu'] = $harga_menu;
        $data['nama_menu'] = $row->nama_menu;
        $data['satuan'] = $row->satuan;
        if ($kode_menu == $kd_menu) {
            $data['qty'] = $qty + 1;
        } else {
            $data['qty'] = 1;
        }
        $query = $this->Model_aksi->insert_duplicate('temporary_order_detail', $data);
        if ($query) {
            $this->ajax_tblKeranjang($kode_order);
        } else {
            echo 'gagal';
        }
    }

    function insertMenuTrans() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        $row = $this->Model_master->get_dataMenuWhereKode($kode_menu);
        $row_krj = $this->Model_transaksi->get_transOrderDetailWhereKd($kode_menu, $kode_order);
        $qty = 0;
        $kode_barang = 0;
        if (!is_null($row_krj)) {
            $qty = $row_krj->qty;
            $kd_menu = $row_krj->kode_menu;
        }
        $harga_menu = @($row->harga_menu - ($row->harga_menu * $row->diskon_menu / 100));
        $data['kode_menu'] = $kode_menu;
        $data['kode_order'] = $kode_order;
        $data['harga_menu'] = $harga_menu;
        $data['nama_menu'] = $row->nama_menu;
        $data['satuan'] = $row->satuan;
        if ($kode_menu == $kd_menu) {
            $data['qty'] = $qty + 1;
        } else {
            $data['qty'] = 1;
        }
        $query = $this->Model_aksi->insert_duplicate('trans_order_detail', $data);
        if ($query) {
            $this->ajax_tblKeranjangEdit($kode_order);
        } else {
            echo 'gagal';
        }
    }

    function updateQty() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        $aksi = $this->input->post('aksi');
        $qty = $this->input->post('qty');
        if ($aksi == 'min') {
            $qty_aksi = $qty - 1;
        } elseif ($aksi == 'plus') {
            $qty_aksi = $qty + 1;
        }
        if ($kode_menu and $qty_aksi and $kode_order) {
            $this->Model_aksi->model_updateQty($qty_aksi, $kode_menu, $kode_order);
            echo 'true';
        } else {
            echo 'gagal';
        }
    }

    function updateQtyEdit() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        $aksi = $this->input->post('aksi');
        $qty = $this->input->post('qty');
        if ($aksi == 'min') {
            $qty_aksi = $qty - 1;
        } elseif ($aksi == 'plus') {
            $qty_aksi = $qty + 1;
        }
        if ($kode_menu and $qty_aksi and $kode_order) {
            $this->Model_aksi->model_updateQtyTrans($qty_aksi, $kode_menu, $kode_order);
            echo 'true';
        } else {
            echo 'gagal';
        }
    }

    function insertOrder() {
        $kode_order = $this->input->post('kode_order');
        $tanggal = $this->input->post('tanggal');
        $jam = $this->input->post('jam');
        $no_meja = $this->input->post('no_meja');
        $id_user = $this->input->post('id_user');
        $diskon = $this->input->post('diskon_order');
        $ppn = $this->input->post('ppn');
        $tunai = str_replace('.', '', $this->input->post('tunai'));
        $data['kode_order'] = $kode_order;
        $data['diskon'] = $diskon;
        $data['no_meja'] = $no_meja;
        $data['id_user'] = $id_user;
        $data['tanggal'] = $tanggal;
        $data['tunai'] = $tunai;
        $data['jam'] = $jam;
        $data['ppn'] = $ppn;
        $query = $this->Model_aksi->insert('trans_order', $data);
        if ($query) {
            $value = $this->Model_transaksi->get_transTemporaryDetail($kode_order);
            foreach ($value as $row) {
                $data1['kode_order'] = $kode_order;
                $data1['kode_menu'] = $row->kode_menu;
                $data1['nama_menu'] = $row->nama_menu;
                $data1['harga_menu'] = $row->harga_menu;
                $data1['qty'] = $row->qty;
                $data1['satuan'] = $row->satuan;
                $qry = $this->Model_aksi->insert('trans_order_detail', $data1);
            }
            if ($qry) {
                $this->Model_aksi->delete('kode_order', $kode_order, 'temporary_order_detail');
                echo 'true';
            }
        } else {
            echo 'gagal';
        }
    }

    function updateOrder() {
        $kode_order = $this->input->post('kode_order');
        $tanggal = $this->input->post('tanggal');
        $jam = $this->input->post('jam');
        $no_meja = $this->input->post('no_meja');
        $id_user = $this->input->post('id_user');
        $diskon = $this->input->post('diskon_order');
        $ppn = $this->input->post('ppn');
        $tunai = str_replace('.', '', $this->input->post('tunai'));
        $data['diskon'] = $diskon;
        $data['ppn'] = $ppn;
        $data['tanggal'] = $tanggal;
        $data['tunai'] = $tunai;
        $data['jam'] = $jam;
        $query = $this->Model_aksi->update('kode_order', $kode_order, 'trans_order', $data);
        if ($query) {
            echo 'true';
        } else {
            echo 'gagal';
        }
    }

    function deleteOrder() {
        $url = $this->input->post('url');
        $kode_order = $this->input->post('kode_order');
        $query = $this->Model_aksi->delete('kode_order', $kode_order, 'trans_order');
        if ($query) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Berhasil Dihapus');
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Hapus data');
            redirect($url);
        }
    }

    function deleteKeranjang() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        if ($kode_menu and $kode_order) {
            $this->Model_aksi->model_deleteKeranjang($kode_menu, $kode_order);
            echo 'true';
        } else {
            echo 'gagal';
        }
    }

    function deleteKeranjangEdit() {
        $kode_menu = $this->input->post('kode_menu');
        $kode_order = $this->input->post('kode_order');
        if ($kode_menu and $kode_order) {
            $this->Model_aksi->model_deleteKeranjangTrans($kode_menu, $kode_order);
            echo 'true';
        } else {
            echo 'gagal';
        }
    }

}
