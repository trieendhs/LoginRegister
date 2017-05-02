<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataPegawai()
		{
			$this->db->select("id,nama,nip,DATE_FORMAT(tanggalLahir,'%d-%m-%Y') as tanggalLahir,foto");
			$query = $this->db->get('pegawai');
			return $query->result();
		}

		public function getJabatanByPegawai($idPegawai)
		{
			$this->db->select("jabatan_pegawai.id, pegawai.nama as namaPegawai, namaJabatan,DATE_FORMAT(tanggalMulai,'%d-%m-%Y') as tanggalMulai,DATE_FORMAT(tanggalSelesai,'%d-%m-%Y') as tanggalSelesai");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = jabatan_pegawai.fk_pegawai', 'left');	
			$query = $this->db->get('jabatan_pegawai');
			return $query->result();
		}
		public function getAnakByPegawai($idPegawai)
		{
			$this->db->select("anak.id, pegawai.nama as namaPegawai, anak.nama as namaAnak,DATE_FORMAT(anak.tanggalLahir,'%d-%m-%Y') as tanggalLahir");
			$this->db->where('fk_pegawai', $idPegawai);	
			$this->db->join('pegawai', 'pegawai.id = anak.fk_pegawai', 'left');	
			$query = $this->db->get('anak');
			return $query->result();
		}


		public function insertPegawai()
		{

			$nama = $this->input->post('nama');
       		$nip  = $this->input->post('nip');
        	$tanggalLahir = $this->input->post('tanggalLahir');
			$date = date('Y-m-d', strtotime($tanggalLahir));
        	$alamat = $this->input->post('alamat');
        	$foto = $this->upload->data('file_name');
        	$data = array (
            	'nama' => $nama,
            	'nip'  => $nip,
            	'tanggalLahir'=> $date,
            	'alamat' => $alamat,
            	'foto' => $foto
            );
        	$this->db->insert('pegawai',$data);
		}

		public function insertJabatan($idPegawai)
		{

			$jabatan = $this->input->post('jabatan');
			$tanggalMulai = $this->input->post('tanggalMulai');
			$date = date('Y-m-d', strtotime($tanggalMulai));
			$tanggalSelesai = $this->input->post('tanggalSelesai');
			$date2 = date('Y-m-d', strtotime($tanggalSelesai));
        	$data = array (
            	'namaJabatan' => $jabatan,
            	'tanggalMulai' => $date,
            	'tanggalSelesai' => $date2,
            	'fk_pegawai'  => $idPegawai
            );
        	$this->db->insert('jabatan_pegawai',$data);
		}

		public function insertAnak($idPegawai)
		{

			$nama = $this->input->post('nama');
			$tanggalMulai = $this->input->post('tanggalLahir');
			$date = date('Y-m-d', strtotime($tanggalMulai));
        	$data = array (
            	'nama' => $nama,
            	'tanggalLahir' => $date,
            	'fk_pegawai'  => $idPegawai
            );
        	$this->db->insert('anak',$data);
		}

		public function getPegawai($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('pegawai',1);
			return $query->result();
		}

		public function getJabatan($idJabatan)
		{
			$this->db->where('id',$idJabatan);
			$query = $this->db->get('jabatan_pegawai', 1);
			return $query->result();
			//idpegawai = idjabatan
		}

		public function getAnak($idAnak)
		{
			$this->db->where('id',$idAnak);
			$query = $this->db->get('anak', 1);
			return $query->result();
			//idpegawai = idjabatan
		}

		public function updateById($id)
		{
			$nama = $this->input->post('nama');
       		$nip  = $this->input->post('nip');
        	$tanggalLahir = $this->input->post('tanggalLahir');
			$date = date('Y-m-d', strtotime($tanggalLahir));
        	$alamat = $this->input->post('alamat');
        	$foto = $this->upload->data('file_name');
        	$data = array (
            	'nama' => $nama,
            	'nip'  => $nip,
            	'tanggalLahir'=> $date,
            	'alamat' => $alamat,
            	'foto' => $foto
        	); 
			$this->db->where('id', $id);
			$this->db->update('pegawai', $data);
		}

		public function updateJabatanById($idJabatan)
		{
			$jabatan = $this->input->post('jabatan');
       		$tanggalMulai  = $this->input->post('tanggalMulai');
       		$date = date('Y-m-d', strtotime($tanggalMulai));
        	$tanggalSelesai = $this->input->post('tanggalSelesai');
			$tanggal = date('Y-m-d', strtotime($tanggalSelesai));
        	$data = array (
            	'namaJabatan' => $jabatan,
            	'tanggalMulai'  => $date,
            	'tanggalSelesai'=> $tanggal
        	); 
        	$this->db->where('id', $idJabatan);
			$this->db->update('jabatan_pegawai', $data);
		}


		public function updateAnakById($idAnak)
		{
			$nama = $this->input->post('nama');
			$tanggalMulai = $this->input->post('tanggalLahir');
			$date = date('Y-m-d', strtotime($tanggalMulai));
        	$data = array (
            	'nama' => $nama,
            	'tanggalLahir' => $date
            );
        	$this->db->where('id', $idAnak);
			$this->db->update('anak', $data);
		}

		public function deleteById($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('pegawai');
		}

		public function deleteJabatanById($idJabatan)
		{
			$this->db->where('id', $idJabatan);
			$this->db->delete('jabatan_pegawai');
		}

		public function deleteAnakById($idAnak)
		{
			$this->db->where('id', $idAnak);
			$this->db->delete('anak');
		}
}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>