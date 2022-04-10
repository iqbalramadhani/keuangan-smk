<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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

	public function input($tgl = null)
	{
		$this->title = 'Laporan Pembayaran';
		$pembayaran = $this->keuangan->get_data()->result();
		$this->render('input', get_defined_vars());
	}

	public function form($id = null)
	{
		$kelas = $this->umum->get_data('kelas')->result();
		if (!is_null($id)) {
			$this->title = 'Laporan Pembayaran';
			$pembayaran = $this->umum->get_where('pembayaran', ['id_pembayaran' => decode_arr($id)])->row();
			$this->render('form_update', get_defined_vars());
		} else {
			$this->render('form', get_defined_vars());
		}
	}

	public function save($id = null)
	{
		$this->db->trans_begin();
		$data = $this->input->post();
		if (!is_null($id)) {
			$data['tanggal_bayar'] = date('Y-m-d', strtotime($data['tanggal_bayar']));
			$data['nominal'] = str_replace('.', '', $data['nominal']);
			$save = $this->umum->update('pembayaran', $data, ['id_pembayaran' => decode_arr($id)]);
			if ($save) {
				$this->session->set_flashdata('info', [true, 'Data berhasil disimpan']);
				$this->db->trans_commit();
			} else {
				$this->session->set_flashdata('info', [false, 'Data gagal disimpan']);
				$this->db->trans_rollback();
			}
		} else {
			if ($data['tipe_check'] == 'import') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$reader->setReadDataOnly(true);
				$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
				$excel = $spreadsheet->getSheet(0)->toArray();
				unset($excel[0]);
				$no = 1;
				$valid = false;
				try {
					foreach ($excel as $exc) {
						if (empty($exc[2]) && empty($exc[1])) {
							continue;
						}

						if (empty($exc[3])) {
							$this->session->set_flashdata('info', ['warning', 'Kelas harus diisi pada baris no ' . $no]);
							$valid = true;
							break;
						} else {
							$cek = $this->cek_kelas($exc[3]);
							if (!$cek[0]) {
								$this->session->set_flashdata('info', ['warning', $cek[1] . ' pada baris no ' . $no]);
								$valid = true;
								break;
							}
						}

						if (empty($exc[4])) {
							$this->session->set_flashdata('info', ['warning', 'Tanggal Bayar Harus Diisi pada baris no ' . $no]);
							$valid = true;
							break;
						} else if (is_string($exc[4])) {
							$this->session->set_flashdata('info', ['warning', 'Format Tanggal Bayar Tidak Sesuai pada baris no ' . $no]);
							$valid = true;
							break;
						}

						if (empty($exc[5])) {
							$this->session->set_flashdata('info', ['warning', 'Nominal Bayar Harus Diisi pada baris no ' . $no]);
							$valid = true;
							break;
						} else if (is_string($exc[5])) {
							$this->session->set_flashdata('info', ['warning', 'Format Nominal Bayar Tidak sesuai pada baris no ' . $no]);
							$valid = true;
							break;
						}

						if (empty($exc[6])) {
							$this->session->set_flashdata('info', ['warning', 'Bulan Bayar Harus Diisi pada baris no ' . $no]);
							$valid = true;
							break;
						} else {
							$bulan = $this->cek_bulan($exc[6]);
							if ($bulan[0] == false) {
								$this->session->set_flashdata('info', ['warning', $bulan[1] . ' pada baris no ' . $no]);
								$valid = true;
								echo 'salah';
								break;
							}
						}

						$save[] = [
							'kelas' => $cek,
							'nama_siswa' => $exc[2],
							'nis' => $exc[1],
							'tanggal_bayar' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($exc[4])),
							'nominal' => $exc[5],
							'bulan' => $bulan[1],
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => jwt()->id_user
						];

						$no++;
					}
				} catch (\Throwable $th) {
					$this->session->set_flashdata('info', ['warning', $cek[1] . ' pada baris no ' . $no]);
					$valid = true;
				}

				if ($valid) redirect('keuangan/form');

				$pesan = 'Input Pembayaran SPP dari Excel';
			} else {
				$save = [];
				foreach ($data['nis'] as $key => $val) {
					$save[] = [
						'kelas' => $data['kelas'][$key],
						'nama_siswa' => $data['nama'][$key],
						'nis' => $val,
						'tanggal_bayar' => date('Y-m-d', strtotime($data['tgl_bayar'][$key])),
						'nominal' => str_replace(['.', ','], '', $data['nominal'][$key]),
						'bulan' => $data['bulan'][$key],
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => jwt()->id_user

					];
				}
				$pesan = 'Input Pembayaran SPP Manual';
			}

			$insert = $this->umum->multi_insert('pembayaran', $save);
			if ($insert) {
				$this->umum->insert('log_table', ['id_log' => date('dmYHis'), 'jenis' => 'Input Pembayaran', 'pesan' => $pesan]);
				$this->session->set_flashdata('info', [true, 'Data berhasil disimpan']);
				$this->db->trans_commit();
			} else {
				$this->session->set_flashdata('info', [false, 'Data gagal disimpan']);
				$this->db->trans_rollback();
			}
		}
		redirect('keuangan/input');
	}

	private function cek_kelas($kelas)
	{
		$kelas = str_replace(' ', '', $kelas);
		$kelas = explode('-', $kelas);
		if (count($kelas) < 3) {
			return [false, 'Format Kelas Tidak Sesuai'];
		}
		$find_kelas = $this->umum->get_where('kelas', ['tingkat' => strtoupper($kelas[0]), 'kode_jurusan' => strtoupper($kelas[1]), 'kelas' => $kelas[2]]);
		if ($find_kelas->num_rows() > 0) {
			return $find_kelas->row()->id_kelas;
		} else {
			return [false, 'Data Kelas Tidak di temukan'];
		}
	}

	private function cek_bulan($bulan)
	{
		$bulan = str_replace([' '], '', $bulan);
		$index = idx_tgl_indo(strtolower($bulan));
		if (!empty($index)) {
			return [true, $index];
		} else {
			return [false, 'Bulan tidak sesuai'];
		}
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
			$sheet->setCellValue('F' . $x, date('d-m-Y', strtotime($row->tanggal_bayar)));
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

	public function hapus($id)
	{
		$this->db->trans_begin();
		$delete = $this->umum->delete('pembayaran', ['id_pembayaran' => decode_arr($id)]);
		if ($delete) {
			$this->session->set_flashdata('info', [true, 'Data berhasil dihapus']);
			$this->db->trans_commit();
		} else {
			$this->session->set_flashdata('info', [false, 'Data gagal dihapus']);
			$this->db->trans_rollback();
		}
		redirect($this->module . '/input');
	}
}
