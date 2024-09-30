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
		$this->db->insert('malas_funcionarios', $mala_usuario);

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
	
	public function upload_image($image,$funcionario_id, $foto){

		// $str = $image['name'];
        // $new_str = str_replace('-', '', $str);
        // $new = str_replace(' ', '', $new_str);
		p($image);
		
		$config['allowed_types'] 	= 'jpg|png|gif';
		$config['upload_path'] 		= "./assets/funcionarios/";
		$config['encrypt_name']		= TRUE;
		$config['max_size'] 		= 100;
		$config['max_width']        = 800;
		$config['height']       	= 700;

		$this->load->library('upload', $config);

		if($this->upload->do_upload($image)){
				p($this->upload->data());
		}else{
			p($this->upload->display_errors());
		}
		// $this->image_lib->resize();

		// $str = $image['name'];
        // $new_str = str_replace('-', '', $str);
        // $new = str_replace(' ', '', $new_str);
        // $newFilePath = "./assets/funcionarios/" . $new;

        // if(move_uploaded_file($image['tmp_name'], $newFilePath)){
		// 	$data = array(
		// 		'foto'   => $new
		// 	);
		// 	$this->db->where('id', $funcionario_id);
		// 	$this->db->update('funcionarios', $data);
		// }
	}

    public function proxima_viagem($user_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('viagens', array('id_usuario' => $user_id))->result();
		return $data;
    }
	// public function check_user_exist($email){
	// 	$query = $this->db->get_where('funcionarios', array('email' => $email))->num_rows();
	// 	return $query;
	// }

	
}
