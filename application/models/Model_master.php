<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_ref
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_master extends CI_Model {
    
    public function get_dataJenisMenu() {
        $query = $this->db->query("select b.*, (select count(a.id_jenis_menu) from data_menu a where a.id_jenis_menu=b.id) as jml_menu from data_jenis_menu b");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_dataMenu(){
        $query = $this->db->query("select * from data_menu");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_dataMenuWhereKode($kode_order){
        $query = $this->db->query("select * from data_menu where kode_menu='$kode_order'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function get_dataMenuJoinFoto(){
        $query = $this->db->query("select a.*, b.foto from data_menu a 
left join data_menu_foto b on a.kode_menu=b.kode_menu group by a.kode_menu");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_dataMenuFoto($kode_menu) {
        $query = $this->db->query("select * from data_menu_foto where kode_menu='$kode_menu'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_dataMenuWhereJenis($id_jenis_menu) {
        $query = $this->db->query("select a.*, b.foto  from data_menu a 
            left join data_menu_foto b on a.kode_menu=b.kode_menu where a.id_jenis_menu=$id_jenis_menu group by a.kode_menu");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
   
}

