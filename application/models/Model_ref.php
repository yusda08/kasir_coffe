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
class Model_ref extends CI_Model {
    
    public function get_refLevelUser() {
        $query = $this->db->query("select * from user_level");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    

}

