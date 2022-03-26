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
		$data = [
			[
				'label' => 'Pemasukan Hari Ini',
				'nominal' => $this->umum->get_where('pembayaran',['tanggal_bayar'=>date('Y-m-d')],'SUM(nominal) AS nominal')->row_array()['nominal'],
			],
			[
				'label' => 'Pemasukan Minggu Ini',
				'nominal' => $this->umum->get_where('pembayaran',['tanggal_bayar >= '=>date('Y-m-d',strtotime('-6 days'))],'SUM(nominal) AS nominal')->row_array()['nominal'],
			],
			[
				'label' => 'Pemasukan Bulan Ini',
				'nominal' => $this->umum->get_where('pembayaran',['MONTH(tanggal_bayar)'=>date('m')],'SUM(nominal) AS nominal')->row_array()['nominal'],
			],
			[
				'label' => 'Total Pemasukan',
				'nominal' => $this->umum->get_data('pembayaran','SUM(nominal) AS nominal')->row_array()['nominal']
			]
		];
		$this->render('index',get_defined_vars());
	}
	
	public function form()
	{
        $this->title = 'Form Data';
		$this->render('form',get_defined_vars());
	}
}
