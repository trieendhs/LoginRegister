<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
		}else{
			redirect('login','refresh');
		}	
	}

	public function index()
	{
		$this->load->model('pegawai_model');
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->load->model('pegawai_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_pegawai_view');

		}else{
			$config['upload_path']		= './assets/uploads/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 100000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

			if(! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_error() );
				$this->load->view('tambah_pegawai_view',$error);
			}
			else
			{
				$this->pegawai_model->insertPegawai();
				$this->load->view('tambah_pegawai_sukses');

			}
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{

		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		
		$config['upload_path']		= './assets/uploads/';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= 100000000;
		$config['max_width']		= 10240;
		$config['max_height']		= 7680;

		$this->load->library('upload', $config);

		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('pegawai_model');
		$data['pegawai'] = $this->pegawai_model->getPegawai($id);
		$data2 = $this->pegawai_model->getPegawai($id);
		$nama = $data2[0]->foto;
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			
			//var_dump($data);
			

			$this->load->view('edit_pegawai_view',$data);

		}else{

			if(! $this->upload->do_upload('userfile'))
			{
				$error = array('error' =>$this->upload->display_errors());
				//$data['pegawai'] = $this->pegawai_model->getPegawai($id);
				$this->load->view('edit_pegawai_view',$error);
			}
			else
			{
				//$data['pegawai']->foto = $this->userfile;
				$this->pegawai_model->UpdateById($id);
				unlink ('assets/uploads/'.$nama);
				$data['pegawai'] = $this->pegawai_model->getDataPegawai();
				$this->load->view('edit_pegawai_sukses',$data);
				
				
				//unlink ('assets/uploads/'.$namaFile);
				
			}
		}
	}

	public function delete()
	{
		
		$this->load->model('pegawai_model');
		$id = $this->uri->segment(3);
		$this->pegawai_model->deleteById($id);
		redirect('pegawai/index');
	}

	public function datatable()
	{
		$this->load->model('pegawai_model');
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>