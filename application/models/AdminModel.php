<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function admin_update($admin_id,$passwd)
    {
        $sql = "update admin_users set passwd='".md5($passwd)."'  where id = {$admin_id}";
        return $this->db->query($sql);
    }

    public function admin_info($login_name)
    {
        $sql ="select * from admin_users where login_name='{$login_name}'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }
}