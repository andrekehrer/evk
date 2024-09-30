<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('customers/viagem_model');
	}
	public function index()
	{   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('customers');
        }
		$user_id = $_SESSION['backend']['id'];
		$data['title'] = 'Minha conta';
		
		$proxima_viagem = $this->viagem_model->proxima_viagem($user_id);
		$hoje = strtotime(date("Y/m/d"));
		$prox = null;
		$prox_viagem = 0;
		if(count($proxima_viagem)>0){
			foreach($proxima_viagem as $trip){
				if($prox == null){
					if($trip->data >= $hoje){
						$prox_viagem = array($trip);
					}
				}else{
					if($trip->data >= $hoje && $trip->data <= $prox){
						$prox_viagem = array($trip);
					}
				}
				
			}
		}
		
		$data['proxima_viagem'] = $prox_viagem;
        $this->load->view('customers/dashboard', $data);
	}
    
}

