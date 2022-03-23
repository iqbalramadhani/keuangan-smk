<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {

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

	protected $title = 'Kelas';
	protected $module = 'kelas';

    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
		cek_jwt();
		$this->load->model('M_Umum','umum');
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
        $this->title = 'Kelas';
		$kelas = $this->umum->get_data('kelas')->result();
		$this->render('index',get_defined_vars());
	}
	
	public function form($id=null)
	{
        $this->title = 'Form Data';
		if(!is_null($id)){
			$kelas = $this->umum->get_where('kelas',['id_kelas'=>decode_arr($id)])->row();
		}
		$jurusan = $this->umum->get_data('jurusan')->result();
		$this->render('form',get_defined_vars());
	}

	public function save($id=null)
	{
		$this->db->trans_begin();
		if(!is_null($id)){
			$save = $this->umum->update('kelas',$this->input->post(),['id_kelas'=>decode_arr($id)]);
		}else{
			$save = $this->umum->insert('kelas',$this->input->post());
		}

		if ($save) {
			$this->umum->insert('log_table',['id_log'=>date('dmYHis'),'jenis'=>'Update Kelas','pesan'=>'Perubahan Data Kelas']);
			$this->session->set_flashdata('info',[true,'Data berhasil disimpan']);
			$this->db->trans_commit();
		}else{
			$this->session->set_flashdata('info',[false,'Data gagal disimpan']);
			$this->db->trans_rollback();
		} 
		
		redirect($this->module);
	}

	public function hapus($id){
		$this->db->trans_begin();
		$delete = $this->umum->delete('kelas',['id_kelas' => decode_arr($id)]);
		if($delete){
			$this->session->set_flashdata('info',[true,'Data berhasil dihapus']);
			$this->db->trans_commit();
		}else{
			$this->session->set_flashdata('info',[false,'Data gagal dihapus']);
			$this->db->trans_rollback();
		}
		redirect($this->module);
	}
}
