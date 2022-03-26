<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{

	protected $table = 'user';
	public function __construct()
	{
		parent::__construct();
	}

}