<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login extends CI_Controller {
	
		public function index()
		{

			$this->load->view('login_view');

		}

		public function cekLogin()
		{
			//melakukan validasi form
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cekDB');
			//callback_cekDB = untuk cek method cekDB ketika form validation password

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('login_view');
			}
			else
			{
				redirect('pegawai','refresh');
			}

		}

		public function cekDB($password)
		{
			//cekDB mendapatkan input $password dari input password di method cekLogin
			//cek ke database
			//input $username didapatkan dari post input seperti dibawah ini
			$username = $this->input->post('username');

			$this->load->model('Login_model');
			$result = $this->Login_model->login($username,$password);
			if($result)
			{
				$sess_array =  array();
				foreach ($result as $row) 
				{
					$sess_array = array(
						'id' => $row->id,
						'username' => $row->username);
					
					$this->session->set_userdata('logged_in',$sess_array);
				}
				return true;
			}
			else
			{
				$this->form_validation->set_message('cekDB','Login Gagal! Username dan Password salah!');
				return false;
			}
		}

		public function logout()
		{
			//logout
			$this->session->unset_userdata('logged_in');
			$this->session->sess_destroy();
			redirect('login','refresh');
		}
	}
	
	/* End of file Login.php */
	/* Location: ./application/controllers/Login.php */
?>