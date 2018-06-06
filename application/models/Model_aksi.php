<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_aksi extends CI_Model {

    public function insert($table, $data) {
        //insert $table($data) values($data);
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function insert_duplicate($table, $data) {
        $this->db->on_duplicate($table, $data);
        return $this->db->affected_rows();
    }

    public function update($column, $id, $table, $data) {
        //update $table set $data where $column = $id;
        $this->db->where($column, $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function update_multi($table, $data, $id_colum) {
        $this->db->update($table, $data, $id_colum);
        return $this->db->affected_rows();
    }

    public function model_updateQty($qty, $kd_menu, $kd_order) {
        if ($qty and $kd_menu and $kd_order) {
            $this->db->query("update temporary_order_detail a set a.qty='$qty' where a.kode_menu='$kd_menu' and a.kode_order='$kd_order'");
//            $this->db->where('kode_pengguna', $kd_pengguna);
//            $this->db->update('keranjang', $data);
        } else {
            return false;
        }
    }
    
    public function model_updateQtyTrans($qty, $kd_menu, $kd_order) {
        if ($qty and $kd_menu and $kd_order) {
            $this->db->query("update trans_order_detail a set a.qty='$qty' where a.kode_menu='$kd_menu' and a.kode_order='$kd_order'");
//            $this->db->where('kode_pengguna', $kd_pengguna);
//            $this->db->update('keranjang', $data);
        } else {
            return false;
        }
    }
    
    public function model_deleteKeranjang($kd_menu, $kd_order) {
        if ($kd_menu and $kd_order) {
            $this->db->query("delete from temporary_order_detail where kode_menu='$kd_menu' and kode_order='$kd_order'");
        } else {
            return false;
        }
    }
    
    public function model_deleteKeranjangTrans($kd_menu, $kd_order) {
        if ($kd_menu and $kd_order) {
            $this->db->query("delete from trans_order_detail where kode_menu='$kd_menu' and kode_order='$kd_order'");
        } else {
            return false;
        }
    }

    function selectPrint($id) {
        $sql = $this->db->query("select * from `order` " . $id);
        if ($sql) {
            return $sql->result();
        } else {
            return false;
        }
    }



    public function delete($column, $id, $table) {
        $this->db->where($column, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function delete_multi($table, $column) {
        $this->db->delete($table, $column);
        return $this->db->affected_rows();
    }

    function sendEmail($penerima, $tgl_posting) {
        $a = $this->session->userdata('is_login');
        $fromEmail = 'sppdhst@gmail.com';

        $body = "<body style='margin: 10px;'>
		<div style='width: 400px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
		<br>
		<strong>Pesan ini memberi tahu ada notifikasi masuk pada aplikasi sppd.hulusungaitengahkab.go.id 
                <br>" . Tgl_indo::indo(substr($tgl_posting, 0, 10)) . " At : " . substr($tgl_posting, 10, 16) . "</strong>
		<br>Mohon Untuk Tidak Membalas Email.
		<br>
		</div>
		</body>";

        $mail = new PHPMailer();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $fromEmail;
        $mail->Password = "setdaumum";
        $mail->SetFrom($fromEmail, 'Administrator SPPD HST');
        $mail->Subject = "Pemberitahuan";
        $mail->Body = $body;
        $mail->AddAddress($penerima);
        $mail->Send();
    }

    function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = md5(uniqid(rand(), true));
            $hyphen = chr(45); // "-"
            $uuid = substr($charid, 0, 6);
            return $uuid;
        }
    }

}
