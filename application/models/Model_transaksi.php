<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_transaksi
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaksi extends CI_Model {

    public function get_transOrderJoinUser() {
        $query = $this->db->query("select a.*, b.nama_admin, aa.ttl_pembayaran from trans_order a 
join user b on a.id_user=b.id
left join (select sum(harga_menu*qty) as ttl_pembayaran, kode_order  from trans_order_detail group by kode_order) 
aa on aa.kode_order=a.kode_order order by a.tanggal desc, jam desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_transOrderJoinUserTgl($tgl_dari, $tgl_sampai) {
        $query = $this->db->query("select a.*, b.nama_admin, aa.ttl_pembayaran from trans_order a 
join user b on a.id_user=b.id
left join (select sum(harga_menu*qty) as ttl_pembayaran, kode_order  from trans_order_detail group by kode_order) 
aa on aa.kode_order=a.kode_order where a.tanggal BETWEEN '$tgl_dari' and '$tgl_sampai' order by a.tanggal desc, jam desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_transOrderDetail($kode_order) {
        $query = $this->db->query("select * from trans_order_detail where kode_order='$kode_order'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_transOrder($kode_order) {
        $query = $this->db->query("select * from trans_order where kode_order='$kode_order'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function get_transOrderJoinDetailWhereTgl($date) {
        $query = $this->db->query("select sum(ceil(a.harga_menu*a.qty)) as total_hari from trans_order_detail a join trans_order b on a.kode_order=b.kode_order where b.tanggal='$date'");
        if ($query) {
            return $query->row()->total_hari;
        } else {
            return false;
        }
    }
    public function get_transPengeluaranWhereTgl($date) {
        $query = $this->db->query("select sum(a.harga) as ttl_pengeluaran_hr from trans_pengeluaran a where a.tanggal='$date'");
        if ($query) {
            return $query->row()->ttl_pengeluaran_hr;
        } else {
            return false;
        }
    }
    
    public function get_transOrderJoinDetail() {
        $query = $this->db->query("select sum(ceil(a.harga_menu*a.qty)) as total from trans_order_detail a join trans_order b on a.kode_order=b.kode_order");
        if ($query) {
            return $query->row()->total;
        } else {
            return false;
        }
    }
    public function get_transPengeluaran() {
        $query = $this->db->query("select sum(a.harga) as ttl_pengeluaran from trans_pengeluaran a");
        if ($query) {
            return $query->row()->ttl_pengeluaran;
        } else {
            return false;
        }
    }
    
    public function get_transTemporaryDetail($kode_order) {
        $query = $this->db->query("select * from temporary_order_detail where kode_order='$kode_order'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_transTemporaryDetailWhereKd($kode_menu, $kode_order) {
        $query = $this->db->query("select * from temporary_order_detail where kode_menu='$kode_menu' and kode_order='$kode_order' ");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function get_transOrderDetailWhereKd($kode_menu, $kode_order) {
        $query = $this->db->query("select * from trans_order_detail where kode_menu='$kode_menu' and kode_order='$kode_order' ");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function get_transPengeluaranJoinUser() {
        $query = $this->db->query("select a.*, b.nama_admin from trans_pengeluaran a join user b on a.id_user=b.id order by tanggal desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
