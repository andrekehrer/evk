<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frotas_model extends CI_Model
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

	public function get_veiculos(){
		$data = $this->db->get_where('frotas', array('perfuratriz' => 0))->result();
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

	public function lista_motoristas_by_rdf_id($rdo_id){
		$data = $this->db->get_where('motoristas_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
	}
	
	public function lista_funcionarios_rdo($rdo_id){
		$data = $this->db->get_where('funcionarios_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
	}

	public function lista_funcionarios_rds($rdo_id){
		$data = $this->db->get_where('funcionarios_rds', array('rds_id' => $rdo_id))->result();
		return $data;
	}

	public function carro_por_usuario_rdo($rdo_id, $funcionario_id){
		$this->db->select('veiculos_rdo.*, frotas.nome, frotas.placa');
		$this->db->from('veiculos_rdo');
		$this->db->join('frotas', 'frotas.id = veiculos_rdo.frota_id');
		$this->db->where('veiculos_rdo.rdo_id', $rdo_id);
		$this->db->where('veiculos_rdo.funcionario_id', $funcionario_id);
		return $this->db->get()->result();
	}

	public function lista_funcionarios_rdo_nome($rdo_id){

		$this->db->select('funcionarios.nome, funcionarios.id, funcionarios_rdo.*');
		$this->db->from('funcionarios_rdo');
		$this->db->join('funcionarios', 'funcionarios.id = funcionarios_rdo.funcionario_id');
		$this->db->where('funcionarios_rdo.rdo_id', $rdo_id);
		
		$data = $this->db->get()->result();
		// print_r($this->db->last_query());
		// $data = $this->db->get()->result();

		return $data;
	}


	public function lista_frotas_by_rdf_id($rdo_id){
		$data = $this->db->get_where('veiculos_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
	}

	public function lista_frotas_com_nome_by_rdf_id($rdo_id){
		$this->db->select('frotas.*');
		$this->db->from('veiculos_rdo');
		$this->db->join('frotas', 'frotas.id = veiculos_rdo.frota_id');
		$this->db->where('veiculos_rdo.rdo_id', $rdo_id);
		$data = $this->db->get()->result();

		return $data;
	}

	public function lista_motoristas_by_rdo_id($rdo_id){
		$data = $this->db->get_where('motoristas_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
	}
	public function add_frota_gravar($post){
		
		$this->db->insert('frotas', $post);
		$id_frota = $this->db->insert_id();

        return $id_frota;
		
	}

	public function edit_frota($post, $id_frota){
		$frota = array(
		    'nome'          => $post['nome'],
			'status'        	=> ($post['status'] ? 1 : 0),
			'patrimonio'        => $post['patrimonio'],
			'modelo'       		=> $post['modelo'],
			'ano'         		=> $post['ano'],
			'cor'      			=> $post['cor'],
			'placa'         	=> $post['placa'],
			'perfuratriz'       => ($post['perfuratriz'] ? 1 : 0),
			'combustivel'  		=> $post['combustivel'],
			'tipo'      		=> $post['tipo'],
			'airtag'      		=> $post['airtag'],
			'seguro'      		=> $post['seguro'],
			'numero_seguro'     => $post['numero_seguro'],
			'vigente'        	=> $post['vigente']
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_frota);
		$this->db->update('frotas', $frota);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function get_frota_by_id($viagem_id){
        $data = $this->db->get_where('frotas', array('id' => $viagem_id))->result();
		return $data;
    }

	public function alterar_imagem($post, $id_frota){
		if($_FILES['mudar_foto']['tmp_name']){
			$foto = 'mudar_foto'.$id_frota;
			$this->upload_image($_FILES['mudar_foto'], $id_frota, $foto);
		}
	}
	
	public function upload_image($image,$mala_id, $foto){

		$str = $image['name'];
        $new_str = str_replace('-', '', $str);
        $new = str_replace(' ', '', $new_str);
        $newFilePath = "./assets/frotas/" . $new;

        if(move_uploaded_file($image['tmp_name'], $newFilePath)){
			$data = array('foto' => $new);
			$this->db->where('id', $mala_id);
			$this->db->update('frotas', $data);
		}
	}

	
}
