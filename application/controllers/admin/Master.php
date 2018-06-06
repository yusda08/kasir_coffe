<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Temp.php');

class Master extends Temp {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_ref');
        $this->load->model('Model_aksi');
        $this->load->model('Model_master');
    }

    public function jenis_menu() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $data['name_page'] = 'Administrator';
                $data['name_page_small'] = 'Menu';
                $record['get_dataJenisMenu'] = $this->Model_master->get_dataJenisMenu();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
                $data['content'] = $this->load->view('admin/master/jenis_menu', $record, TRUE);
                $this->load->view('temp_admin/layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    public function menu() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $data['name_page'] = 'Administrator';
                $data['name_page_small'] = 'Jenis Menu';
                $record['get_dataMenu'] = $this->Model_master->get_dataMenu();
                $record['get_dataJenisMenu'] = $this->Model_master->get_dataJenisMenu();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
                $data['content'] = $this->load->view('admin/master/menu', $record, TRUE);
                $this->load->view('temp_admin/layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    public function lihat_foto_menu() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 1) {
                $data = $this->layout_admin();
                $data['name_page'] = 'Administrator';
                $data['name_page_small'] = 'Foto Menu';
                $kode_menu = $this->input->get('kode');
                $record['kode_menu'] = $kode_menu;
                $record['get_dataMenu'] = $this->Model_master->get_dataMenu();
                $record['get_dataMenuFoto'] = $this->Model_master->get_dataMenuFoto($kode_menu);
//                $record['get_dataJenisMenu'] = $this->Model_master->get_dataJenisMenu();
                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
                $data['content'] = $this->load->view('admin/master/foto_menu', $record, TRUE);
                $this->load->view('temp_admin/layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    function insertFotoMenu() {
        $url = $this->input->post('url');
        $imageName = $this->input->post('foto');
        $kode_menu = $this->input->post('kode_menu');
        if ($imageName != '') {
            rename('assets/img/tampungan/' . $imageName, 'assets/img/menu/' . $imageName);
            $path = '././assets/img/menu/';
            $data['kode_menu'] = $kode_menu;
            $data['foto'] = $imageName;
            $query = $this->Model_aksi->insert('data_menu_foto', $data);
            if ($query) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Berhasil Disimpan');
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menambahkan data');
                redirect($url);
            }
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Pilih terlebih dahulu Foto');
            redirect($url);
        }
    }

    function deleteFotoMenu() {
        $url = $this->input->post('url');
        $imageName = $this->input->post('foto');
        $id = $this->input->post('id');
        $path = '././assets/img/menu/';
        @unlink($path . $imageName);
        $query = $this->Model_aksi->delete('id', $id, 'data_menu_foto');
        if ($query) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Berhasil Menghapus Foto');
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Menghapus Foto');
            redirect($url);
        }
    }

    function insertJnsMenu() {
        $data['nama_jenis_menu'] = $this->input->post('nama_jenis_menu');
        $qry = $this->Model_aksi->insert('data_jenis_menu', $data);
        if ($qry) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function insertMenu() {
        $data['kode_menu'] = $this->input->post('kode_menu');
        $data['id_jenis_menu'] = $this->input->post('id_jenis_menu');
        $data['nama_menu'] = $this->input->post('nama_menu');
        $data['diskon_menu'] = $this->input->post('diskon_menu');
        $data['satuan'] = $this->input->post('satuan');
        $data['harga_menu'] = str_replace('.', '', $this->input->post('harga_menu'));
        $qry = $this->Model_aksi->insert('data_menu', $data);
        if ($qry) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    function updateMenu() {
        $kode_menu = $this->input->post('kode_menu');
        $data['id_jenis_menu'] = $this->input->post('id_jenis_menu');
        $data['nama_menu'] = $this->input->post('nama_menu');
        $data['diskon_menu'] = $this->input->post('diskon_menu');
        $data['harga_menu'] = str_replace('.', '', $this->input->post('harga_menu'));
        $qry = $this->Model_aksi->update('kode_menu',$kode_menu,'data_menu', $data);
        if ($qry) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    function deleteMenu() {
        $kode_menu = $this->input->post('kode_menu');
        $qry = $this->Model_aksi->delete('kode_menu', $kode_menu,'data_menu');
        if ($qry) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function deleteJnsMenu() {
        $id = $this->input->post('id');
        $qry = $this->Model_aksi->delete('id', $id, 'data_jenis_menu');
        if ($qry) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

//    function deleteMenu() {
//        $id = $this->input->post('id');
//        $qry = $this->Model_aksi->delete('kode_menu', $id, 'data_menu');
//        if ($qry) {
//            echo 'true';
//        } else {
//            echo 'false';
//        }
//    }

    function updateJnsMenu() {
        $id = $this->input->post('name');
        $nama = $this->input->post('value');
        $data['nama_jenis_menu'] = $nama;
        $query = $this->Model_aksi->update('id', $id, 'data_jenis_menu', $data);
        $yes = array('success' => true, 'msg' => 'true', 'ket' => 'Edit');
        $no = array('success' => false, 'msg' => 'false', 'ket' => 'Edit');
        if ($query) {
            echo json_encode($yes);
        } else {
            echo json_encode($no);
        }
    }

    function lihat_menu() {
        $id_jenis_menu = $this->input->post('id_jenis_menu');
        $record['get_dataMenuWhereJenis'] = $this->Model_master->get_dataMenuWhereJenis($id_jenis_menu);
        $get_page = $this->load->view('admin/master/ajax_data/ajax_lihatMenu', $record, true);
        echo $get_page;
    }

}
