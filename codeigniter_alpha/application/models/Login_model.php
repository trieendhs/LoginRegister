<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login_model extends CI_Model {
	
		public function login($username,$password)
		{
			$this->db->select('id,username,password');
			$this->db->from('user');
			$this->db->where('username', $username);
			$this->db->where('password', MD5($password));
			$query = $this->db->get();

			if($query->num_rows()==1)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		}	

		public function register()
		{
			$username = $this->input->post('username');
       		$password  = $this->input->post('password');
        	$data = array (
            	'username' => $username,
            	'password'  => MD5($password)
            );
        	$this->db->insert('user',$data);
		}
		
	
	}
	
	/* End of file Login_model.php */
	/* Location: ./application/models/Login_model.php */
?>