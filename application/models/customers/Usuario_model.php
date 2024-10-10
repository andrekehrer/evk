<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

	public function lista_usuario(){
		return 'here';
	}

	public function add_user($data){
		
		$this->db->insert('usuarios', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}
	public function check_user_exist($email){
		$query = $this->db->get_where('usuarios', array('email' => $email))->num_rows();
		return $query;
	}

	
}
