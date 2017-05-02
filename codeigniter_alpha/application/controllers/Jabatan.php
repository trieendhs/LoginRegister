<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function index($idPegawai)
	{
		$this->load->model('pegawai_model');		
		$data["jabatan_list"] = $this->pegawai_model->getJabatanByPegawai($idPegawai);
		$this->load->view('jabatan', $data);
	}

	public function create($idPegawai)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jabatan', 'Nama Jabatan', 'trim|required');
		$this->form_validation->set_rules('tanggalMulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggalSelesai', 'Tanggal Selesai', 'trim|required');
		$this->load->model('pegawai_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_jabatan_view');

		}else{
			$this->pegawai_model->insertJabatan($idPegawai);
			$this->load->view('tambah_jabatan_sukses');
		}
	}

	public function update($idJabatan)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('jabatan', 'Nama Jabatan', 'trim|required');
		$this->form_validation->set_rules('tanggalMulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggalSelesai', 'Tanggal Selesai', 'trim|required');
		
		$this->load->model('pegawai_model');
		
		$data["jabatan"] = $this->pegawai_model->getJabatan($idJabatan);

		if($this->form_validation->run()==FALSE){

			//var_dump($data);
			$this->load->view('edit_jabatan_view',$data);

		}else{
			
			//var_dump($data);
			//die;
			$this->pegawai_model->updateJabatanById($idJabatan);
			$this->load->view('edit_jabatan_sukses');
		}
	}

	public function delete($idJabatan)
	{
		
		$this->load->model('pegawai_model');
		$this->pegawai_model->deleteJabatanById($idJabatan);
		redirect('pegawai/index/');
	}

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */

 ?>