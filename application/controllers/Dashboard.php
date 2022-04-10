<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Dashboard extends MY_Controller {

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

	protected $title = 'Dashboard';
	protected $module = 'dashboard';

    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
		cek_jwt();
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
		$data = $this->keuangan->pemasukan()->result_array();
		$this->render('index',get_defined_vars());
	}
	
	public function form()
	{
        $this->title = 'Form Data';
		$this->render('form',get_defined_vars());
	}

	public function profile(){
		$this->title = 'Profile';
		$profile = $this->umum->get_where('user',['id_user'=>jwt()->id_user])->row();
		$this->render('profile',get_defined_vars());
	}

	public function detail_pemasukan($key){
		$data = $this->keuangan->pemasukan_detail($key)->result_array();
		$this->render('form',get_defined_vars());
	}
}
