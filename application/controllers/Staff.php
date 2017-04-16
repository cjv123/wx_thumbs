<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "staff";
	}

	public function thumb($staff_id)
	{
		if ($staff_id=="")
		{
			return;
		}
		$this->load->model("StaffModel");
		// $view_data = $this->staffmodel->staff_view();
		$this->load->view("staff_public_view");
	}
	
	public function thumb_req()
	{
		$star = $this->input->post("star");
		$text = $this->input->post("text");
		$this->load->model("commentmodel");
		$ret = $this->commentmodel->comment_add($star,$text);
		echo $ret;
	}

	public function staff_list($page,$searchName)
	{
		$per_page=10;

	 	$data["staff_list"] = $this->staffmodel->staff_list($page,1000,$searchName);
       
		$this->load->view("staff_public_list");
	}
}
