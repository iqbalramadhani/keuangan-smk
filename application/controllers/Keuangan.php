<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
		if (current_url() != base_url() && $this->uri->segment(2) != 'search') {
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

	public function input($tgl=null)
	{
		$this->title = 'Laporan Pembayaran';
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
		print_r($data);
		if ($data['tipe_check'] == 'import') {
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file']['tmp_name']);
			$excel = $spreadsheet->getSheet(0)->toArray();
			unset($excel[0]);
			foreach ($excel as $exc) {
				$save[] = [
					'kelas' => $data['kelas'],
					'nama_siswa' => $exc[1],
					'nis' => $exc[2],
					'tanggal_bayar' => date('Y-m-d', strtotime($exc[4])),
					'nominal' => $exc[5],
					'bulan' => idx_tgl_indo($exc[3]),
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => jwt()->id_user
				];
			}
		} else {
			$save = [];
			foreach ($data['nis'] as $key => $val) {
				$save[] = [
					'kelas' => $data['kelas'],
					'nama_siswa' => $data['nama'][$key],
					'nis' => $val,
					'tanggal_bayar' => date('Y-m-d', strtotime($data['tgl_bayar'][$key])),
					'nominal' => str_replace(['.', ','], '', $data['nominal'][$key]),
					'bulan' => $data['bulan'][$key],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => jwt()->id_user

				];
			}
		}

		$insert = $this->umum->multi_insert('pembayaran', $save);
		if ($insert) {
			$this->umum->insert('log_table', ['id_log' => date('dmYHis'), 'jenis' => 'Input Pembayaran', 'pesan' => 'Input Pembayaran SPP']);
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
		$pembayaran = $this->keuangan->get_data(strtolower(base64_decode($data)))->result();
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

	public function filter()
	{
		$tgl = $this->input->post('tanggal');
		$filter = explode('-', $tgl);
		$start = date('y-m-d', strtotime($filter[0]));
		$end = date('y-m-d', strtotime($filter[1]));
		$pembayaran = $this->keuangan->get_data(null, $start, $end)->result();
		$tgl = encode_arr($tgl);
		$this->render('input', get_defined_vars());
	}

	public function export($tanggal = null)
	{
		if (is_null($tanggal)) {
			$pembayaran = $this->keuangan->get_data()->result();
		} else {
			$tgl = decode_arr($tanggal);
			$filter = explode('-', $tgl);
			$start = date('y-m-d', strtotime($filter[0]));
			$end = date('y-m-d', strtotime($filter[1]));
			$pembayaran = $this->keuangan->get_data(null, $start, $end)->result();
		}


		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->mergeCells('A1:G1');
		$sheet->setCellValue('A1', 'Laporan Pembayaran SPP');
		$sheet->setCellValue('A4', 'No');
		$sheet->setCellValue('B4', 'NIS');
		$sheet->setCellValue('C4', 'Nama');
		$sheet->setCellValue('D4', 'Kelas');
		$sheet->setCellValue('E4', 'Bulan');
		$sheet->setCellValue('F4', 'Tanggal Bayar');
		$sheet->setCellValue('G4', 'Nominal');

		$no = 1;
		$x = 5;
		foreach ($pembayaran as $row) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $row->nis);
			$sheet->setCellValue('C' . $x, $row->nama_siswa);
			$sheet->setCellValue('D' . $x, $row->kelas);
			$sheet->setCellValue('E' . $x, bulanIndo($row->bulan));
			$sheet->setCellValue('F' . $x, date('d-m-Y',strtotime($row->tanggal_bayar)));
			$sheet->setCellValue('G' . $x, $row->nominal);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Pembayaran SPP Siswa';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
