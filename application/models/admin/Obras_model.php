<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Obras_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

    public function edit_obra($post, $id_obra){
        $data = array(
			'nome'          => $post['nome'],
			'status'        => ($post['status'] ? 1 : 0),
			'numero_id'     => $post['numero_id'],
			'endereco'      => $post['endereco'],
			'numero'        => $post['numero'],
			'bairro'        => $post['bairro'],
			'tipo'          => $post['tipo'],
			'cidade'        => $post['cidade'],
			'estado'        => $post['estado'],
			'cliente'       => $post['cliente'],
			'cep'           => $post['CEP'],
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_obra);
		$this->db->update('obras', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function add_obra_gravar($post){
		
		$this->db->insert('obras', $post);
		$id_obra = $this->db->insert_id();

        return $id_obra;
		
	}


	public function lista_obras(){
		$data = $this->db->get('obras')->result();
		return $data;
	}

	public function lista_rdos($obra_id){
		$this->db->select('rdos.id, rdos.data');
		$this->db->select('funcionarios.nome as funcionario');
		$this->db->from('rdos');
		$this->db->join('funcionarios', 'funcionarios.id = rdos.funcionario_id');
		$this->db->order_by('rdos.data', 'DESC');
		$this->db->where('rdos.id_obra', $obra_id);
		$data = $this->db->get()->result();
		
		return $data;
	}

	public function lista_rdfs($obra_id){
		$this->db->select('rdfs.id, rdfs.data');
		$this->db->select('funcionarios.nome as funcionario');
		$this->db->from('rdfs');
		$this->db->join('funcionarios', 'funcionarios.id = rdfs.funcionario_id');
		$this->db->order_by('rdfs.data', 'DESC');
		$this->db->where('rdfs.id_obra', $obra_id);
		$data = $this->db->get()->result();
		return $data;
	}

    public function get_obra_by_id($obra_id){
        $data = $this->db->get_where('obras', array('id' => $obra_id))->result();
		return $data;
    }

	public function get_obra_id_usuario($usuario_id){
		$this->db->select('obras.id,obras.nome as obra_nome,obras.numero_id, obras.cidade, obras.estado');
		$this->db->select('clientes.nome as cliente_nome');
		$this->db->from('funcionarios_da_obra');
		$this->db->join('funcionarios', 'funcionarios.id = funcionarios_da_obra.id_funcionario');
		$this->db->join('obras', 'obras.id = funcionarios_da_obra.id_obra');
		$this->db->join('clientes', 'clientes.id = obras.cliente');
		$this->db->where('funcionarios_da_obra.id_funcionario', $usuario_id);
		$this->db->where('obras.status', 1);
		$data = $this->db->get()->result();
		
		return $data;
    }

	public function get_obra_id_obra($obra_id){
		$this->db->select('obras.id as id_obra,obras.nome as obra_nome,obras.numero_id, obras.endereco, obras.numero, obras.bairro, obras.cidade, obras.estado, obras.tipo');
		$this->db->select('clientes.id as cliente_id,clientes.nome as cliente_nome');
		$this->db->from('obras');
		$this->db->join('clientes', 'clientes.id = obras.cliente');
		$this->db->where('obras.id', $obra_id);
		// $this->db->where('obras.status', 1);
		$data = $this->db->get()->result();
		
		return $data;
    }

	public function get_funcionarios_nome_da_obra($obra_id){
		$this->db->select('funcionarios.id, funcionarios.nome, funcionarios.sobrenome');
		$this->db->from('funcionarios_da_obra');
		$this->db->join('funcionarios', 'funcionarios.id = funcionarios_da_obra.id_funcionario');
		$this->db->join('obras', 'obras.id = funcionarios_da_obra.id_obra');
		$this->db->where('funcionarios_da_obra.id_obra', $obra_id);
		$this->db->where('obras.status', 1);
		$data = $this->db->get()->result();
		return $data;
    }

	public function get_funcionarios_da_obra($obra_id){
		$this->db->select('funcionarios.*');
		$this->db->from('funcionarios_da_obra');
		$this->db->join('funcionarios', 'funcionarios.id = funcionarios_da_obra.id_funcionario');
		$this->db->join('obras', 'obras.id = funcionarios_da_obra.id_obra');
		$this->db->where('funcionarios_da_obra.id_obra', $obra_id);
		// $this->db->where('obras.status', 1);
		$data = $this->db->get()->result();
		return $data;
    }

	public function get_itens_da_obra($obra_id, $cat){
        $data = $this->db->get_where('itens_da_obra', array('id_obra' => $obra_id, 'categoria' => $cat))->result();
		return $data;
    }

	
	public function insere_funcionario_da_obra_gravar($data){
		
		$this->db->insert('funcionarios_da_obra', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}
	public function insere_item_obra_gravar($data){
		
		$this->db->insert('itens_da_obra', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}
	public function add_bag($post, $id_usuario, $id_viagem){
		
        $mala = array(
			'marca_mala' => $post['marca_mala'],
			'cor_mala' => $post['cor_mala'],
			'peso_mala' => $post['peso_mala'],
			'tamanho_mala' => $post['tamanho_mala'],
			'tipo_mala' => $post['tipo_mala'],
			'estilo_mala' => $post['estilo_mala'],
			'conteudo_mala' => $post['conteudo_mala'],
			'valor_mala' => $post['valor_mala'],
        );
		$this->db->insert('malas', $mala);
		$mala_id = $this->db->insert_id();

		$mala_usuario = array(
			'id_usuario' => $id_usuario,
			'id_mala' => $mala_id,
			'id_viagem' => $id_viagem
        );
		$this->db->insert('malas_obras', $mala_usuario);

		if($_FILES['foto_mala_fechada']['tmp_name']){
			$foto = 'foto_mala_fechada';
			$this->upload_image($_FILES['foto_mala_fechada'], $mala_id, $foto);
		}
		if($_FILES['nota_fiscal_bagagem']['tmp_name']){
			$foto = 'foto_fiscal';
			$this->upload_image($_FILES['nota_fiscal_bagagem'], $mala_id, $foto);
		}
		if($_FILES['foto_mala_pronta']['tmp_name']){
			$foto = 'foto_mala_pronta';
			$this->upload_image($_FILES['foto_mala_pronta'], $mala_id, $foto);
		}
	}
	public function edit_bag($post, $id_usuario, $id_mala){
		
        $mala = array(
			'marca_mala' => $post['marca_mala'],
			'cor_mala' => $post['cor_mala'],
			'peso_mala' => $post['peso_mala'],
			'tamanho_mala' => $post['tamanho_mala'],
			'tipo_mala' => $post['tipo_mala'],
			'estilo_mala' => $post['estilo_mala'],
			'conteudo_mala' => $post['conteudo_mala'],
			'valor_mala' => $post['valor_mala'],
        );
		$this->db->where('id', $id_mala);
		$this->db->update('malas', $mala);

		if($_FILES['foto_mala_fechada']['tmp_name']){
			$foto = 'foto_mala_fechada';
			$this->upload_image($_FILES['foto_mala_fechada'], $id_mala, $foto);
		}
		if($_FILES['nota_fiscal_bagagem']['tmp_name']){
			$foto = 'foto_fiscal';
			$this->upload_image($_FILES['nota_fiscal_bagagem'], $id_mala, $foto);
		}
		if($_FILES['foto_mala_pronta']['tmp_name']){
			$foto = 'foto_mala_pronta';
			$this->upload_image($_FILES['foto_mala_pronta'], $id_mala, $foto);
		}
	}
	
	public function upload_image($image,$mala_id, $foto){

		$str = $image['name'];
        $new_str = str_replace('-', '', $str);
        $new = str_replace(' ', '', $new_str);
        $newFilePath = "./assets/malas/" . $new;

        if(move_uploaded_file($image['tmp_name'], $newFilePath)){
			$data = array(
				$foto        => $new
			);
			$this->db->where('id', $mala_id);
			$this->db->update('malas', $data);
		}
	}

    public function proxima_viagem($user_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('viagens', array('id_usuario' => $user_id))->result();
		return $data;
    }
	// public function check_user_exist($email){
	// 	$query = $this->db->get_where('obras', array('email' => $email))->num_rows();
	// 	return $query;
	// }

	
}
