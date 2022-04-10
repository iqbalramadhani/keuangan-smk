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
			SELECT 0 as id,null AS tingkat,'Pemasukan Hari Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE tanggal_bayar = '".date('Y-m-d')."' UNION
			SELECT 1 as id,null AS tingkat,'Pemasukan Minggu Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE tanggal_bayar >= '".date('Y-m-d',strtotime('-6 days'))."'
			UNION
			SELECT 2 AS id,null AS tingkat,'Pemasukan Bulan Ini' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE MONTH(tanggal_bayar) = '".date('m')."' AND YEAR(tanggal_bayar) = '".date('Y')."'
			UNION
			SELECT 4 AS id,'X' AS tingkat,'Pemasukan Kelas X' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'X')
			UNION
			SELECT 5 AS id,'XI' AS tingkat,'Pemasukan Kelas XI' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'XI')
			UNION
			SELECT 6 AS id,'XII' AS tingkat,'Pemasukan Kelas XII' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran
			WHERE kelas in (SELECT id_kelas FROM kelas WHERE tingkat = 'XII')
			UNION
			SELECT 3 AS id,null AS tingkat,'Total Pemasukan' AS label,COALESCE(SUM(nominal),0) as nominal FROM pembayaran");
	}

	public function pemasukan_detail($tingkat = null){
		return $this->db->query("SELECT CONCAT(kelas.tingkat,'-',kelas.kode_jurusan,'-',kelas.kelas) AS kelasnya,
		(SELECT COALESCE(SUM(pm.nominal),0)
		FROM pembayaran as pm
		JOIN kelas as ks ON ks.id_kelas = pm.kelas
		WHERE ks.tingkat = '".$tingkat."' and ks.kode_jurusan = kelas.kode_jurusan and ks.kelas = kelas.kelas and pm.tanggal_bayar = '".date('Y-m-d')."') AS nominal_hariini,
		(SELECT COALESCE(SUM(pm.nominal),0)
		FROM pembayaran as pm
		JOIN kelas as ks ON ks.id_kelas = pm.kelas
		WHERE ks.tingkat = '".$tingkat."' and ks.kode_jurusan = kelas.kode_jurusan and ks.kelas = kelas.kelas and pm.tanggal_bayar >= '".date('Y-m-d',strtotime('-6 days'))."') AS nominal_minggu,
		(SELECT COALESCE(SUM(pm.nominal),0)
		FROM pembayaran as pm
		JOIN kelas as ks ON ks.id_kelas = pm.kelas
		WHERE ks.tingkat = '".$tingkat."' and ks.kode_jurusan = kelas.kode_jurusan and ks.kelas = kelas.kelas and MONTH(pm.tanggal_bayar) = '".date('m')."' AND YEAR(tanggal_bayar) = '".date('Y')."') AS nominal_bulan,
		COALESCE(SUM(pembayaran.nominal),0) AS total_nominal
		FROM pembayaran
		JOIN kelas ON kelas.id_kelas = pembayaran.kelas
		WHERE kelas.tingkat = '".$tingkat."'
		GROUP BY kode_jurusan,kelas.kelas");
	}
}