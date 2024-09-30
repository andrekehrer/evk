<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('customers/usuario_model');
	}
	public function index()
	{
		// $this->load->view('index');
	}
	public function listar(){
		$usuarios = $this->usuario_model->lista_usuario();
		return $usuarios;

	}
	public function active_user($has){

		$query = $this->db->get_where('usuarios', array('hash' => $has))->num_rows();
		if($query == 0){
			$data['title'] = 'Ative seu Cadastro';
			$data['resultado'] = 'Não encontramos seu usuário.';
			
			$this->load->view('active_user', $data);
		}else{

			$data['title'] = 'Ative seu Cadastro';
			$data['resultado'] = 'Não encontramos seu usuário.';

			$data_  = array('status' =>  1);
			$this->db->where('hash', $has);
			$this->db->update('usuarios', $data_);
			if ($this->db->affected_rows() == 1) {
				
				$query = $this->db->get_where('usuarios', array('hash' => $has))->result();

				if (isset($query[0]->id)) {
					$currentSession = session_id();
					$currentTime = time();

					$session_data = array(
						'userid' => $query[0]->id,
						'nome' => $query[0]->nome,
						'email' => $query[0]->email,
						'currentSessionId' => $currentSession,
						'currentTime' => $currentTime,
					);

					$this->session->set_userdata('backend', $session_data);
					
				}
				// $this->load->view('active_user', $data);
			}else{
				$data['title'] = 'Ative seu Cadastro';
				$data['resultado'] = 'Seu usuário já foi ativado, faça seu login.';
			
				$this->load->view('active_user', $data);
			}
		}
		
		
	}
    
}