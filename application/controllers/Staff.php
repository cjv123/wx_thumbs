<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("StaffModel");
	}

	public function index()
	{
		echo "staff";
	}

	public function thumb($staffId)
	{
		$view_data = $this->staffmodel->staff_view();
		$this->load->view("staff_view",$view_data);
	}

	public function staffs_list($page,$searchName)
	{
		$per_page=10;

	 	$data["staff_list"] = $this->staffmodel->staff_list($page,$per_page,$searchName);
       //分页类
        $data["total"]=$total=$this->user_model->getUserCount(false);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);

		$this->load->library('Page_cjv',$params);

        $this->page_cjv->url=BASEURL."/user/user_list/";
        $data["pager"]=$this->page_cjv->show();
        $data["page"]=$page;
		
		$this->load->view("staffs_list",$data);
	}
}
