<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
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
	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		$this->load->model('M_Auth','auth');
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
		if(isset($_POST['submit'])){
			$username = $this->input->post('username');
			$cek_user = $this->umum->get_where('user',['username'=>$username]);
			if($cek_user->num_rows()>0){
				$data_user = $cek_user->row_array();
				if(hash_verified($this->input->post('password'),$data_user['password'])){
					$this->session->set_userdata($data_user);
					redirect('dashboard');

				}
			}
			// dd(var_dump(hash_verified('admin','$2y$05$9AcH394kH.hSeVmPfKqxD.N.rj8XIeh7Iywv7IBaxvo/C4Pxpn4Li')));
			// dd(get_hash($this->input->post('password')));
		}
		$this->load->view('auth/login');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('atuh');
	}

}