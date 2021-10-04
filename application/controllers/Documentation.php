<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

class Documentation extends CI_Controller {
	public function index() {
		$this->load->view("landings/documentation");
	}
}
