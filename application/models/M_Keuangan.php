<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Keuangan extends CI_Model
{

	protected $table = '';
	public function __construct()
	{
		parent::__construct();
	}

	public function get_data($data=null,$start=null,$end=null){
		$this->db->select("pembayaran.*,CONCAT(kelas.tingkat,'-',kelas.kode_jurusan,'-',kelas.kelas) AS kelas,MONTHNAME(STR_TO_DATE(pembayaran.bulan, '%m')) AS bulan, jurusan.nama_jurusan AS jurusan");
		$this->db->from('pembayaran');
		$this->db->join('kelas','pembayaran.kelas = kelas.id_kelas');
		$this->db->join('jurusan','kelas.kode_jurusan = jurusan.kode_jurusan');
		if(!is_null($data)){
			// $this->db->where('YEAR(pembayaran.tanggal_bayar)',date('Y'));
			$this->db->where('LOWER(pembayaran.nama_siswa)',$data);
			$this->db->or_where('pembayaran.nis',$data);
		}else if(!is_null($start)){
			$this->db->where('pembayaran.tanggal_bayar >=',$start);
			$this->db->where('pembayaran.tanggal_bayar <=',$end);
		}else{
			$this->db->where('DATE(pembayaran.created_at)',date('Y-m-d'));
		}
		return $this->db->get();
	}

	public function pemasukan(){
		return $this->db->query("
			SELECT 0 as id,'Pemasukan Hari Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE tanggal_bayar = '".date('Y-m-d')."' UNION
			SELECT 1 as id,'Pemasukan Minggu Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE tanggal_bayar >= '".date('Y-m-d',strtotime('-6 days'))."'
			UNION
			SELECT 2 AS id,'Pemasukan Bulan Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE MONTH(tanggal_bayar) = '".date('m')."'
			UNION
			SELECT 4 AS id,'Pemasukan Kelas X' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'X')
			UNION
			SELECT 5 AS id,'Pemasukan Kelas XI' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'XI')
			UNION
			SELECT 6 AS id,'Pemasukan Kelas XII' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'XII')
			UNION
			SELECT 3 AS id,'Total Pemasukan' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran");
	}
}