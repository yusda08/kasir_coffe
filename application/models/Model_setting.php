<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_setting extends CI_Model {

    public function get_setProfil() {
        $query = $this->db->query("select * from profil");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_setUser() {
        $query = $this->db->query("select * from user");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_setUserWhereId($id) {
        $query = $this->db->query("select * from user where id='$id'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function count_lvl_user_1($level_user) {
        $query = $this->db->query("select count(id) as jml_lvl_1 from user where level_user=$level_user");
        if ($query) {
            return $query->row()->jml_lvl_1;
        } else {
            return false;
        }
    }

}
