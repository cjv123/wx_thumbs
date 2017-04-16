<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function comment_add($star,$text) 
    {
        $sql="insert into comment values('','{$star}','{$text}','','')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function comment_admin_add($comment_admin,$admin_id)
    {
        $sql="update comment set comment_admin='{$comment_admin}',admin_id='{$admin_id}'"; 
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
}