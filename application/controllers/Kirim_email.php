<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_email extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'iqbal.ramadhani55@gmail.com',
            'smtp_pass'   => 'sepedah007',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from('iqbal.ramadhani55@gmail.com', 'Iqbal Ramadhani');
        $this->email->to('tesemail@domain.com');
        $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter');
        $this->email->message("Kirim email");
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
			$myfile = fopen("application/cache/writeme.txt", "a");
			$txt = "Iqbal Ramadhani has just sent an email\n";
			fwrite($myfile, $txt);
			fclose($myfile);
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }

		$this->load->view('welcome_message');
	}
}
