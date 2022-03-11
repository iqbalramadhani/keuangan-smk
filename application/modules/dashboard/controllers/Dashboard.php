<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
		$js = [
			"vendors/iCheck/icheck.min.js",
			"vendors/moment/min/moment.min.js",
			"vendors/bootstrap-daterangepicker/daterangepicker.js",
			"vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js",
			"vendors/jquery.hotkeys/jquery.hotkeys.js",
			"vendors/google-code-prettify/src/prettify.js",
			"vendors/jquery.tagsinput/src/jquery.tagsinput.js",
			"vendors/switchery/dist/switchery.min.js",
			"vendors/select2/dist/js/select2.full.min.js",
			"vendors/parsleyjs/dist/parsley.min.js",
			"vendors/autosize/dist/autosize.min.js",
			"vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js",
			"vendors/starrr/dist/starrr.js",
			"build/js/custom.min.js"
		];
		$this->render('dashboard/index',get_defined_vars());
	}
	
	public function form()
	{
        $this->title = 'Form Data';
		$this->render('dashboard/form',get_defined_vars());
	}
}
