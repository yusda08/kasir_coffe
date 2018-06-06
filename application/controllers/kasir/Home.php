<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_setting');
        $this->load->model('Model_master');
        $this->load->model('Model_aksi');
        $this->load->model('Tgl_indo');
    }

    public function index() {
        $data['head'] = $this->load->view('page/head_page', NULL, TRUE);
        $data['nav'] = $this->load->view('page/nav_page', NULL, TRUE);
        $data['footer'] = $this->load->view('page/footer_page', NULL, TRUE);
        $record['js'] = $this->load->view('page/js_page', NULL, TRUE);
        $record['get_setProfil'] = $this->Model_setting->get_setProfil();
        $record['row_text'] = $this->Model_setting->get_setSlideText();
        $record['get_setTestimoni'] = $this->Model_setting->get_setTestimoni();
        $record['get_setSlideShow'] = $this->Model_setting->get_setSlideShow();
        $data['content'] = $this->load->view('page/content/baranda', $record, TRUE);
        $this->load->view('page/layout_page', $data);
    }

    function insertTestimoni() {
        $url = $this->input->post('url');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_telpon = $this->input->post('no_tlpn');
        $isi = addslashes($this->input->post('isi'));
        $date = date('Y-m-d H:i:s');
        $data['nama'] = $nama;
        $data['email'] = $email;
        $data['no_telpon'] = $no_telpon;
        $data['isi'] = $isi;
        $data['date_time'] = $date;
        $data['status'] = 0;
        $query = $this->Model_aksi->insert('testimoni', $data);
        if ($query) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Berhasil Melakukan Testimoni');
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal');
            redirect($url);
        }
    }

}
