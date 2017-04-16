<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	public function index()
	{
		echo "admin";
	}
         
	public function admin_home()
	{
	}

	public function staff_add()
	{
			
		$this->load->view("staff_add");
	}

	public function staff_add_req()
	{
		$name=$this->input->post("name");
		$des = $this->input->post("des");
		$job=$this->input->post("job");
		$shopId=$this->input->post("shopId");

		$this->load->model("staffmodel");
		return $this->staffmodel->staff_add($name,$des,$job,$shopId);
	}

	public function staff_view_qrcode($id)	
	{
		$url = "http://".$_SERVER['SERVER_NAME']."/staff/thumb/".$id;

		require_once ("phpqrcode.php");  
		$value=$url;  
		$errorCorrectionLevel = "L";  
		$matrixPointSize = "10";  
		QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);  	
	}
}
