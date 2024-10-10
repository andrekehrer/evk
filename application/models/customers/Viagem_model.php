<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Viagem_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

	public function get_mala_by_id($id){
		$data = $this->db->get_where('malas', array('id' => $id))->result();
		return $data;
	}

	public function get_tipo_mala(){
		$data = $this->db->get_where('tipo_mala', array('status' => 1))->result();
		return $data;
	}

	public function get_estilo_mala(){
		$data = $this->db->get_where('estilo_mala', array('status' => 1))->result();
		return $data;
	}

	public function lista_viagens($id){
		$data = $this->db->order_by('data', 'DESC')->get_where('viagens', array('id_usuario' => $id))->result();
		return $data;
	}

	public function get_malas_usuario_viagem($viagem_id,$user_id){
		$this->db->select('*');
		$this->db->from('malas_usuarios');
		$this->db->join('malas', 'malas.id = malas_usuarios.id_mala');
		$this->db->where('malas_usuarios.id_usuario', $user_id);
		$this->db->where('malas_usuarios.id_viagem', $viagem_id);
		$data = $this->db->get()->result();
		return $data;
	}

    public function viagem_by_id($viagem_id,$user_id){
        $data = $this->db->get_where('viagens', array('id_usuario' => $user_id,'id' => $viagem_id))->result();
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
		$this->db->insert('malas_usuarios', $mala_usuario);

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

	public function edit_viagem_gravar($data, $id_viagem){
		$this->db->where('id', $id_viagem);
		$this->db->update('viagens', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}
    public function proxima_viagem($user_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('viagens', array('id_usuario' => $user_id))->result();
		return $data;
    }
	// public function check_user_exist($email){
	// 	$query = $this->db->get_where('usuarios', array('email' => $email))->num_rows();
	// 	return $query;
	// }

	
}
