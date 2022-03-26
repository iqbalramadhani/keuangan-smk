<?php defined('BASEPATH') or exit('No direct script access allowed');

use Firebase\JWT\JWT;

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
					$jwt = JWT::encode($data_user,PUBLIC_KEY_JWT,'HS256');
					$this->session->set_userdata(['token'=>$jwt]);
					$this->umum->insert('log_table',['id_log'=>date('dmYHis'),'jenis'=>'Login','pesan'=>'user login']);
					redirect('dashboard');

				}
			}else{
				$this->session->set_flashdata('info','Usernamd atau Passowrd salah');
			}
		}
		$this->load->view('auth/login');
	}

	public function logout(){
		$this->umum->insert('log_table',['id_log'=>date('dmYHis'),'jenis'=>'Login','pesan'=>'user logout']);
		$this->session->sess_destroy();
		redirect('auth');
	}

}