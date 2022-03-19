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
		$pembayaran = $this->umum->get_data('pembayaran')->result();
		$this->render('input', get_defined_vars());
	}

	public function form($id=null){
		$kelas = $this->umum->get_data('kelas')->result();
		$this->render('form',get_defined_vars());
	}

	public function save($id=null){
		$this->db->trans_begin();
		$data = $this->input->post();
		$save = [];
		foreach($data['nis'] as $key => $val){
			$save[] = [
				'kelas' => $data['kelas'],
				'nama_siswa' => $data['nama'][$key],
				'nis' => $val,
				'tanggal_bayar' => date('Y-m-d',strtotime($data['tgl_bayar'][$key])),
				'nominal' => str_replace(['.',','],'',$data['nominal'][$key]),
				'bulan' => $data['bulan'][$key]
			];
		}

		$insert = $this->umum->multi_insert('pembayaran',$save);
		if($insert){
			$this->db->trans_commit();
		}else{
			$this->db->trans_roll();
		}
	
	}
}
