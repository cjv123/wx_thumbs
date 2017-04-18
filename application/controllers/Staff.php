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
		$this->load->model("staffmodel");
		$this->load->model("commentmodel");
		$info = $this->staffmodel->staff_info($staff_id);
		$data=$info;
		$data["staff_id"]=$staff_id;
		$data["list"]=$this->commentmodel->comment_list($staff_id);
		$this->load->view("thumb",$data);
	}
	
	public function thumb_req($staff_id)
	{
		if (!$staff_id)
		{
			return;
		}

		$star = $this->input->post("star");
		$text = $this->input->post("text");
		$this->load->model("commentmodel");
		$ret = $this->commentmodel->comment_add($star,$text,$staff_id);
		$data["ret"]=$ret;
		$this->load->view("thumb_res",$data);
	}


	public function staff_list($page=1)
	{
		$shop_id=$this->input->get("shop");
		$per_page=10;

		$this->load->model("staffmodel");
		$this->load->model("shopmodel");
	 	$data["staff_list"] = $this->staffmodel->staff_list($page,1000,"",$shop_id);
        $data["shop_list"] = $this->shopmodel->shop_list(1,100);
		$data["shop_id"]=$shop_id;
		$this->load->view("public_staff_list",$data);
	}

}
