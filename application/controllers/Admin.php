<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	public function index()
	{
		echo "admin";
	}

         
	public function admin_home()
	{
		$this->load->view("admin_home");
	}

	public function user_add()
	{
			
	}
}
