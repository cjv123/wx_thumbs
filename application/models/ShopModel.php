<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopModel extends CI_Model{
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

    public function shop_update($shopId,$name,$des="")
    {
        $sql = "update shop set name='{$name}',des='{$des}' where id={$shopId}";
        return $this->db->query($sql);
    }

    public function shop_list($page=1,$per_page=20,$search_name="")
    {
        $search_sql="";
        if($search_name!="") 
        {
            $search_sql="where name like '%{$search_name}%' ";
        }
        $sql = "select * from shop ".$search_sql." order by id desc limit ".($page-1)*$per_page.",".$per_page;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function shop_count($search_name)
    {
        $search_sql="";
        if($search_name!="") 
        {
            $search_sql="where name like '%{$search_name}%' ";
        }
        $sql =" select count(*) from shop ".$search_sql;
        $query = $this->db->query($sql);
        $row=$query->row_array();
        return $row["count(*)"];
    }
    
    public function shop_info($id)
    {
        $sql="select * from shop where id='{$id}'";
        $query = $this->db->query($sql);
        return $query->row_array(); 
    }
}
