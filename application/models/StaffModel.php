<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaffModel extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function staff_add($name,$des,$job,$shopId)
    {
        return $this->db->query("insert into staffs values('','{$name}','{$des}','{$job}','{$shopId}')");
    }
    
    public function staff_list($page=1,$per_page=20,$searchName="")
    {
        $searchSql = "";
        if ($searchName!="")
        {
            $searchSql="where name={$searchName}";
        }
        $sql = "select * from staffs where ".$searchSql." order by id desc limit ".($page-1)*$per_page.",".$per_page;
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function staff_list_count($seachName="")
    {
        $searchSql = "";
        if ($searchName!="")
        {
            $searchSql="where name={$searchName}";
        }
        $sql = "select count(*) from staffs where ".$searchSql;
        $query=$this->db->query($sql);
        $row=$query->row_array();
        return $row["count(*)"];
    }
    
    public function staff_view($staffId)
    {
        $sql = "select * from staffs where id='{$staffId}'";
        $query=$this->db->query(sql);
        return $query->row_array();
    }
    
    public function staff_update($staffId,$name,$des,$job,$shopId)
    {
        $sql ="update staffs set name='{$name}',des='{$des}',job='{$job},shopId='{$shopId}' where id={$staffId}";
        return $this->db->query($sql);
    }
    
    public function staff_del($staffId)
    {
        $sql ="delete from staffs where id={$staffId}";
        return $this->db->query($sql);
    }
}