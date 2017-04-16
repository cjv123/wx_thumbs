<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopModel extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }	
         
    public function shop_add($name,$des)
    {
        return $this->db->query("insert into shop values('','{$name}','{$des}')");
    }

    public function shop_del($shopId)
    {
        return $this->db->query("delete from shop where id={$shopId}");
    }

    public function shop_update($shopId,$name,$des)
    {
        $sql = "update shop set name={$name},des={$des} where id={$shopId}";
        return $this->db->query($sql);
    }

    public function shop_list()
    {
        $sql = "select * from shop";
        $query = $this->db-query($sql);
        return $query->result_array();
    }
}
