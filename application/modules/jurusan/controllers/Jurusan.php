<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends MY_Controller {

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
		$this->render('index',get_defined_vars());
	}
	
	public function form()
	{
        $this->title = 'Form Data';
		$this->render('form',get_defined_vars());
	}

	public function save(){
		$data_jurusan = [
			'nama_jurusan' => $this->input->post('nama_jurusan',true),
			'kode_jurusan' => $this->input->post('kode_jurusan',true),
		];
		$umum = $this->umum->insert('jurusan',$this->input->post());
		redirect('jurusan');
	}
}
