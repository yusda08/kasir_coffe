<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Laporan_pdf
 *
 * @author zaky
 */
require_once APPPATH . '/third_party/vendor/mpdf/mpdf/mpdf.php';

class Laporan_pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_aksi');
        $this->load->model('Model_transaksi');
        $this->load->model('Model_setting');
        $this->load->model('Tgl_indo');
    }

    function cetak_laporan() {

        $text = substr($text, 0, -3);
        $text = str_replace(' ', '', $text);
        $whereData = "WHERE kode_order IN ('" . $text . "')";
        $record['cetakPengiriman'] = $this->Model_transaksi->cetakPengiriman($whereData);
        $record['get_setProfil'] = $this->Model_setting->get_setProfil();
        $record['get_provinsi'] = $this->Model_login->get_provinsi();
        $record['get_kabupaten'] = $this->Model_login->get_kabupaten();
        $record['get_kecamatan'] = $this->Model_login->get_kecamatan();
        $html1 = $this->load->view('administrator/laporan/laporan_pengiriman', $record, true);
        $pdfFilePath = "cetak_pengiriman_" . date('Ymd') . ".pdf";
        $mpdf = new mPDF('utf-8', 'legal', 12, 'Arial', 3, 3, 3, 30, 15, 8, 'P');
        $mpdf->WriteHTML($html1);
        $mpdf->Output($pdfFilePath, "I");
//        }
    }

    function cetak_rekap_pendapatan_pdf() {
        $a = $this->session->userdata('is_login');

        $record['kasir'] = $this->input->post('kasir');
        $record['tgl_dari'] = $this->input->post('tgl_dari');
        $record['tgl_sampai'] = $this->input->post('tgl_sampai');
//        $record['tgl'] = $this->input->post('tgl');

        $record['get_transOrderJoinUser'] = $this->Model_transaksi->get_transOrderJoinUser();
        $html1 = $this->load->view('admin/laporan/cetak_rekap_pendapatan_pdf', $record, true);
        $pdfFilePath = "cetak_rekap_" . date('Ymd') . ".pdf";
        $mpdf = new mPDF('utf-8', 'A4-L', 12, 'Arial', 3, 3, 3, 3, 15, 8, 'L');
        $mpdf->WriteHTML($html1);
        $mpdf->Output($pdfFilePath, "I");
//        }
    }

}
