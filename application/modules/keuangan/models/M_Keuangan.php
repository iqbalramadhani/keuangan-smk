<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Keuangan extends CI_Model
{

	protected $table = '';
	public function __construct()
	{
		parent::__construct();
	}

	public function get_data($data=null){
		$this->db->select("pembayaran.*,CONCAT(kelas.tingkat,'-',kelas.kode_jurusan,'-',kelas.kelas) AS kelas,MONTHNAME(STR_TO_DATE(pembayaran.bulan, '%m')) AS bulan, jurusan.nama_jurusan AS jurusan");
		$this->db->from('pembayaran');
		$this->db->join('kelas','pembayaran.kelas = kelas.id_kelas');
		$this->db->join('jurusan','kelas.kode_jurusan = jurusan.kode_jurusan');
		if(!is_null($data)){
			$this->db->where('YEAR(pembayaran.tanggal_bayar)',date('Y'));
			$this->db->where('LOWER(pembayaran.nama_siswa)',$data);
			$this->db->or_where('pembayaran.nis',$data);
		}
		return $this->db->get();
	}

}