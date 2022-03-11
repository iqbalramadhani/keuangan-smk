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
		//
		$this->load->view('auth/login');
	}

	public function css(){
		$this->load->view('auth/css');
	}

	public function cetak_value($value=''){
		var_dump($value);
	}

	public function ambil_kata($kalimat="(23 Maret 2018) Some string is below here (please note below): The dummy formula is a=(x+y)-100."){
		$kurung = true;
		$mulai=0;
		while($kurung){
			$cari_kurung = strpos($kalimat,'(',$mulai);
			if($cari_kurung !== false){
				$kata = true;
				$kalimat_baru = '';
				$no = 1;
				while($kata){
					if($kalimat[$cari_kurung+$no] == ')'){
						$kalimat_baru .= '<br>';
						$mulai = $cari_kurung+$no;
						break;
					}
					$kalimat_baru .= $kalimat[$cari_kurung+$no];
					$no++;
				}
				print_r($kalimat_baru);
			}else{
				break;
			}
		}
	}
}

$auth = new Auth;
// $auth->ambil_kata("(23 Maret 2018) Some string is below here (please note below): The dummy formula is a=(x+y)-100.");
