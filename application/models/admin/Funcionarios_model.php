<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funcionarios_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

    public function edit_funcionario($post, $id_funcionario){
        $data = array(
			'nome'          => $post['nome'],
			'status'        => ($post['status'] ? 1 : 0),
			'motorista'     => ($post['motorista'] ? 1 : 0),
			'sobrenome'     => $post['sobrenome'],
			'telefone'      => $post['telefone'],
			'email'         => $post['email'],
			'CPF'           => $post['CPF'],
			'RG'            => $post['RG'],
			'admissao'      => strtotime($post['admissao']),
			'cargo'         => $post['cargo'],
			'CBO'           => $post['CBO'],
			'registro'      => $post['registro'],
			'aso'     	    => strtotime($post['aso']),
			'endereco'      => $post['endereco'],
			'numero'      	=> $post['numero'],
			'bairro'      	=> $post['bairro'],
			'cidade'        => $post['cidade'],
			'estado'        => $post['estado'],
			'cep'           => $post['CEP'],
			'permissao'     => $post['permissao'],
			// 'senha'         => md5($post['CEP']),
			
			'dob'           => strtotime($post['dob']),
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_funcionario);
		$this->db->update('funcionarios', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function add_funcionario_gravar($post){
		
		$this->db->insert('funcionarios', $post);
		$id_funcionario = $this->db->insert_id();

        return $id_funcionario;
		
	}

	public function resetar_senha_gravar($post, $id){
		$this->db->where('id', $id);
		$this->db->update('funcionarios', $post);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}


	public function lista_funcionarios($new_func = null){
		if($new_func){
			$this->db->select('funcionarios.*');
			$this->db->from('funcionarios');
			$this->db->where_not_in('id', $new_func);
			$this->db->order_by('nome', 'ASC');

			$data = $this->db->get()->result();
		}else{
			$data = $this->db->get('funcionarios')->result();
		}
		return $data;
	}

	public function lista_funcionarios_ativos($new_func = null){
	
		$this->db->where('status', 1);
		$data = $this->db->get('funcionarios')->result();
		return $data;
	}

	public function lista_funcionarios_desativados($new_func = null){

		$this->db->where('status', 0);
		$data = $this->db->get('funcionarios')->result();
		return $data;
	}

    public function get_funcionario_by_id($funcionario_id){
        $data = $this->db->get_where('funcionarios', array('id' => $funcionario_id))->result();
		return $data;
    }

	public function add_viagem_gravar($data){
		
		$this->db->insert('viagens', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

	public function alterar_imagem($post, $id_funcionario){
		if($_FILES['mudar_foto']['tmp_name']){
			$foto = 'mudar_foto'.$id_funcionario;
			$this->upload_image($_FILES['mudar_foto'], $id_funcionario, $foto);
		}
	}
	
}
