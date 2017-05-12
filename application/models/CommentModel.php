<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function comment_add($star,$text,$staff_id,$wx_name,$replay="0",$wx_openid="") 
    {
        $sql="insert into comment values('','{$star}','{$text}','','','{$staff_id}','{$replay}','{$wx_name}',".time().",{$wx_openid})";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function comment_admin_add($comment_id,$comment_admin,$admin_id)
    {
        $sql="update comment set comment_admin='{$comment_admin}',admin_id='{$admin_id}' where id={$comment_id}"; 
        $query= $this->db->query($sql);
        return $query;
    }
    
    public function get_staff_star_avg($staff_id)
    {
        $sql="select avg(comment.star) star_avg,staffs.* from comment,staffs where staffs.id={$staff_id} and comment.staff_id=staffs.id";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return ($row["star_avg"])?$row["star_avg"]:0;
    }

    public function comment_list($staff_id,$page=1,$per_page=100)
    {
        $sql ="select comment.*,staffs.name staff_name from comment,staffs  
        where comment.staff_id=staffs.id and comment.staff_id={$staff_id} order by comment.id desc limit ".($page-1)*$per_page.",".$per_page;
        // echo $sql;
        $query = $this->db->query($sql);
        $array =$query->result_array(); 
        return $array;
    }
    
    public function reply_list($reply_id)
    {
        $sql ="select * from comment where reply = {$reply_id}";
        $query =$this->db->query($sql);
        $array = $query->result_array();
        return $array;
    }

    public function comment_count($staff_id)
    {
        $sql ="select count(*) from comment,staffs 
        where comment.staff_id=staffs.id and comment.staff_id={$staff_id}";
        $query =$this->db->query($sql);
        $row=$query->row_array();
        return $row["count(*)"];
    }

    public function comment_info($comment_id)
    {
        $sql = "select * from comment where id='{$comment_id}'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    public function comment_del($comment_id)
    {
        $this->db->query("delete from comment where reply={$comment_id}"); 

        $sql="delete from comment where id={$comment_id}";
        $query = $this->db->query($sql);
        return $query;
    }


    public function comment_replay($text,$wx_name,$replay)
    {
        $sql="insert into comment values('','','{$text}','','','0','{$replay}','{$wx_name}',".time().")";
        $query = $this->db->query($sql);
        return $query;
    }

    public function check_comment_limit($wx_openid,$staff_id)
    {
        $sql="select count(*) from comment where wx_openid='{$wx_openid}' and staff_id='{$staff_id}'";
        $query=$this->db->query($sql);
        $row = $query->row_array();
        $count = $row["count"];

        $this->load->model("AdminModel");
        $setting = $this->AdminModel->get_setting();
        if($count>=$setting["thumb_limit"])
        {
            return false;
        }
        return true;
    }
}