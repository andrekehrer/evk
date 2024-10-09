<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}


	public function lista_frotas(){
		$data = $this->db->get('frotas')->result();
		return $data;
	}

	public function lista_frotas_by_rdo_id($rdo_id){
		$data = $this->db->get_where('veiculos_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
	}

	public function get_perfuratriz(){
		$data = $this->db->get_where('frotas', array('perfuratriz' => 1))->result();
		return $data;
	}

	public function lista_frotas_com_nome_by_rdo_id($rdo_id){
		$this->db->select('veiculos_rdo.*, frotas.nome');
		$this->db->from('veiculos_rdo');
		$this->db->join('frotas', 'frotas.id = veiculos_rdo.frota_id');
		$this->db->where('veiculos_rdo.rdo_id', $rdo_id);
		$data = $this->db->get()->result();

		return $data;
	}


	
}
