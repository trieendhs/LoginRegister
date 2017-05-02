<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Register extends CI_Controller {
	
		public function index()
		{

			$this->load->view('register_view');

		}

		public function cekRegister()
		{
			$this->load->model('Login_model');
			//melakukan validasi form
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			//callback_cekDB = untuk cek method cekDB ketika form validation password

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('register_view');
			}
			else
			{
				$this->Login_model->register();
				$this->load->view('login_view');
			}
		}
		
		
	}
	
	/* End of file Register.php */
	/* Location: ./application/controllers/Register.php */
