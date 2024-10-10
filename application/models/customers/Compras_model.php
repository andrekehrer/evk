<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Compras_model extends CI_Model{
    
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		return;
	}

	public function lista_compras($id){
		$data = $this->db->order_by('id', 'DESC')->get_where('pedidos', array('usuario_id' => $id))->result();
		return $data;
	}

}
