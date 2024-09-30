<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}


	public function lista_clientes(){
		$data = $this->db->get_where('clientes', array('status' => 1))->result();
		return $data;
	}

	public function add_cliente_gravar($post){
		
		$this->db->insert('clientes', $post);
		$id_cliente = $this->db->insert_id();

        return $id_cliente;
		
	}

	public function edit_cliente($post, $id_cliente){
		$cliente = array(
		    'nome'          => $post['nome'],
		    'registro'      => $post['registro'],
			'status'        => ($post['status'] ? 1 : 0),
			'cnpj'          => $post['cnpj'],
			'contato'       => $post['contato'],
			'email'         => $post['email'],
			'razao_social'  => $post['razao_social'],
			'telefone'      => $post['telefone'],
			'cargo'         => $post['cargo'],
			'endereco'      => $post['endereco'],
			'numero'      	=> $post['numero'],
			'bairro'      	=> $post['bairro'],
			'cidade'        => $post['cidade'],
			'estado'        => $post['estado'],
			'cep'           => $post['CEP'],
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_cliente);
		$this->db->update('clientes', $cliente);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function get_cliente_by_id($viagem_id){
        $data = $this->db->get_where('clientes', array('id' => $viagem_id))->result();
		return $data;
    }

	public function alterar_imagem($post, $id_cliente){
		if($_FILES['mudar_foto']['tmp_name']){
			$foto = 'mudar_foto'.$id_cliente;
			$this->upload_image($_FILES['mudar_foto'], $id_cliente, $foto);
		}
	}
	
	public function upload_image($image,$mala_id, $foto){

		$str = $image['name'];
        $new_str = str_replace('-', '', $str);
        $new = str_replace(' ', '', $new_str);
        $newFilePath = "./assets/clientes/" . $new;

        if(move_uploaded_file($image['tmp_name'], $newFilePath)){
			$data = array('foto' => $new);
			$this->db->where('id', $mala_id);
			$this->db->update('clientes', $data);
		}
	}

	
}
