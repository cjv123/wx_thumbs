<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaffModel extends CI_Model{
	public $wx_appid="wxbf6521c0bb17feef";
	public $wx_appsecret="ab4e6a8fdd5d2107e4aecbcb3ea74e4a";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_qrcode2page_url()
    {
        $url = "";
        if ($this->wx_appid=="")
        {
            $url = "http://".$_SERVER['SERVER_NAME']."/staff/thumb/"; 
        }
        else
        {
            $url = "http://".$_SERVER['SERVER_NAME']."/staff/qrcode2Page/"; 
        }
        return $url;
    }
    
    public function staff_add($name,$des,$job,$shopId,$headerFilename,$sex=0)
    {
        return $this->db->query("insert into staffs values('','{$name}','{$des}','{$job}','{$shopId}','{$headerFilename}','{$sex}')");
    }
    
    public function staff_list($page=1,$per_page=20,$searchName="",$search_shop_id="")
    {
        $searchSql = "";
        if ($searchName!="")
        {
            $searchSql="where staffs.name like '%{$searchName}%'";
        }
        if ($search_shop_id!="")
        {
            if ($searchSql=="")
                $searchSql.="where shop.id ='{$search_shop_id}'";
            else
                $searchSql.="and shop.id ='{$search_shop_id}'";
        }
        
        $this->load->model("CommentModel");
        $sql = "select staffs.*,shop.name shop_name from staffs left join shop on staffs.shop_id=shop.id ".$searchSql." order by id desc limit ".($page-1)*$per_page.",".$per_page;
        $query=$this->db->query($sql);
        $array = $query->result_array();
        foreach($array as $key=>$row)
        {
            $avg = $this->CommentModel->get_staff_star_avg($row["id"]);
            $array[$key]["star_avg"]=$avg;
        }
        return $array;
    }
    
    public function staff_list_count($searchName="",$search_shop_id)
    {
        $searchSql = "";
        if ($searchName!="")
        {
            $searchSql="where name like '%{$searchName}%'";
        }
        if ($search_shop_id!="")
        {
            if ($searchSql=="")
                $searchSql.="where shop_id ='{$search_shop_id}'";
            else
                $searchSql.="and shop_id ='{$search_shop_id}'";
        }
        
        $sql = "select count(*) from staffs ".$searchSql;
        $query=$this->db->query($sql);
        $row=$query->row_array();
        return $row["count(*)"];
    }
    
    public function staff_info($staffId)
    {
        $sql = "select staffs.*,shop.id shop_id,shop.name shop_name from staffs left join shop on staffs.shop_id=shop.id where staffs.id='{$staffId}'";
        $query=$this->db->query($sql);
        return $query->row_array();
    }
    
    public function staff_update($staffId,$name,$des,$job,$shopId,$headerFilename="",$sex="0")
    {
        $headerUpdateSql="";
        if ($headerFilename)
        {
            $headerUpdateSql=",header='{$headerFilename}'";
        }
        $sql ="update staffs set name='{$name}',des='{$des}',job='{$job}',sex='{$sex}',shop_id='{$shopId}'{$headerUpdateSql} where id={$staffId}";
        return $this->db->query($sql);
    }
    
    public function staff_del($staffId)
    {
        $staffInfo = $this->staff_info($staffId);
        if ($staffInfo && $staffInfo["header"])
        {
            @unlink("header/".$staffInfo["header"]);
        }

        $sql ="delete from staffs where id={$staffId}";
        $this->db->query($sql);
        $sql ="delete from comment where staff_id={$staffId}";
        return $this->db->query($sql);
    }
    
}