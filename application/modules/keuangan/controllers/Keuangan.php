<?php defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	/**
	 * [__construct description]
	 *
	 * @method __construct
	 */

	protected $title = 'Keuangan';
	protected $module = 'keuangan';

	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		if (current_url() != base_url()) {
			cek_jwt();
		}
		$this->load->model('M_Keuangan', 'keuangan');
	}

	/**
	 * [index description]
	 *
	 * @method index
	 *
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->title = 'Dashboard';
		$this->load->view('keuangan/index', get_defined_vars());
	}

	public function input()
	{
		$this->title = 'Keuangan';
		$pembayaran = $this->keuangan->get_data()->result();
		$this->render('input', get_defined_vars());
	}

	public function form($id = null)
	{
		$kelas = $this->umum->get_data('kelas')->result();
		$this->render('form', get_defined_vars());
	}

	public function save($id = null)
	{
		$this->db->trans_begin();
		$data = $this->input->post();
		$save = [];
		foreach ($data['nis'] as $key => $val) {
			$save[] = [
				'kelas' => $data['kelas'],
				'nama_siswa' => $data['nama'][$key],
				'nis' => $val,
				'tanggal_bayar' => date('Y-m-d', strtotime($data['tgl_bayar'][$key])),
				'nominal' => str_replace(['.', ','], '', $data['nominal'][$key]),
				'bulan' => $data['bulan'][$key]
			];
		}

		$insert = $this->umum->multi_insert('pembayaran', $save);
		if ($insert) {
			$this->session->set_flashdata('info', [true, 'Data berhasil disimpan']);
			$this->db->trans_commit();
		} else {
			$this->session->set_flashdata('info', [false, 'Data gagal disimpan']);
			$this->db->trans_rollback();
		}
		redirect('keuangan/input');
	}

	public function search($data)
	{
		$pembayaran = $this->keuangan->get_data(strtolower($data))->result();
		if (count($pembayaran) > 0) {
			foreach ($pembayaran as $index => $pe) {
				$pembayaran[$index]->tanggal_bayar = tgl_indo($pe->tanggal_bayar);
				$pembayaran[$index]->bulan = bulanIndo($pe->bulan);
				$pembayaran[$index]->nominal = number_format($pe->nominal, 0, ',', '.');
			}
			echo json_encode([
				'status' => true,
				'data' => $pembayaran
			]);
		} else {
			echo json_encode([
				'status' => false,
				'pesan' => 'Data tidak ditemukan'
			]);
		}
	}
}
