<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	function  __construct() {
        parent::__construct();
		$this->load->model('carrinho_model');
    }

	public function index()
	{   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
			redirect(base_url().'admin/login');
        }
		$user_id = $_SESSION['backend']['id'];
		$data['title'] = 'Minha conta';
		

        $this->load->view('admin/dashboard', $data);
	}

}
