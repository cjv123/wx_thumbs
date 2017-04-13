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
}
