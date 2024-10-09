<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Config extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/config_model');
	}

	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $data['title'] = 'RDO - Relatório de Obras';
        $id = $_SESSION['backend']['id'];   





        
        $this->load->view('admin/config', $data);

        
	}
    
}

