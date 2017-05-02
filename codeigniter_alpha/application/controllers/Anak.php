<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anak extends CI_Controller {

	public function index($idPegawai)
	{
		
		$this->load->model('pegawai_model');
		$data["anak_list"] = $this->pegawai_model->getAnakByPegawai($idPegawai);
		$this->load->view('anak',$data);	
	
	}

	public function create($idPegawai)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		$this->load->model('pegawai_model');	

		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_anak_view');

		}else{
			$this->pegawai_model->insertAnak($idPegawai);
			$this->load->view('tambah_anak_sukses');
		}
	}

	public function update($idAnak)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		
		$this->load->model('pegawai_model');
		
		$data["anak"] = $this->pegawai_model->getAnak($idAnak);

		if($this->form_validation->run()==FALSE){

			//var_dump($data);
			$this->load->view('edit_anak_view',$data);

		}else{
			
			//var_dump($data);
			//die;
			$this->pegawai_model->updateAnakById($idAnak);
			$this->load->view('edit_anak_sukses');
		}
	}

	public function delete($idAnak)
	{
		
		$this->load->model('pegawai_model');
		$this->pegawai_model->deleteAnakById($idAnak);
		redirect('pegawai/index/');
	}
}

/* End of file Anak.php */
/* Location: ./application/controllers/Anak.php */
 ?>