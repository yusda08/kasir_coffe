<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function validate_login($username, $password) {
        $query = $this->db->query("select a.*, b.level_user as nm_level from user a 
join user_level b on a.level_user=b.id where a.username='$username' and a.password='$password'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

}
