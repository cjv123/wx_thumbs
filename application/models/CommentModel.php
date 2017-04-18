<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function comment_add($star,$text,$staff_id) 
    {
        $sql="insert into comment values('','{$star}','{$text}','','','{$staff_id}',".time().")";
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
        where comment.staff_id=staffs.id and comment.staff_id={$staff_id} limit ".($page-1)*$per_page.",".$per_page;;
        $query = $this->db->query($sql);
        $array =$query->result_array(); 
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

    public function comment_del($comment_id)
    {
        $sql="delete from comment where id={$comment_id}";
        $query = $this->db->query($sql);
        return $query;
    }


}