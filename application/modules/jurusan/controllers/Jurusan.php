<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends MY_Controller
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

	protected $title = 'Jurusan';
	protected $module = 'jurusan';

	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		cek_jwt();
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
		$this->title = 'Jurusan';
		$list_jurusan = $this->umum->get_data('jurusan')->result();
		$this->render('index', get_defined_vars());
	}

	public function form($id = null)
	{
		if (!is_null($id)) {
			$jurusan = $this->umum->get_where('jurusan', ['id_jurusan' => decode_arr($id)])->row();
		}
		$this->title = 'Form Jurusan';
		$this->render('form', get_defined_vars());
	}

	public function save($id = null)
	{
		$data = $this->input->post();
		$this->db->trans_begin();
		if (!is_null($id)){
			$aksi = $this->umum->update(
				'jurusan', 
				['nama_jurusan'=>$data['nama_jurusan'],'kode_jurusan'=>$data['kode_jurusan']], 
				['id_jurusan' => decode_arr($id)]);

			$aksi = $this->umum->update(
				'kelas',
				['kode_jurusan'=>$data['kode_jurusan']], 
				['kode_jurusan' => $data['kode_jurusan_old']]
			);
		}else $aksi = $this->umum->insert('jurusan', ['nama_jurusan'=>$data['nama_jurusan'],'kode_jurusan'=>$data['kode_jurusan']]);

		if ($aksi) {
			$this->session->set_flashdata('info',[true,'Data berhasil disimpan']);
			$this->db->trans_commit();
		}else{
			$this->session->set_flashdata('info',[false,'Data gagal disimpan']);
			$this->db->trans_rollback();
		} 

		redirect('jurusan');
	}
}
