<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}


	public function lista_produtos(){
		$data = $this->db->get('produtos')->result();
		return $data;
	}

	public function add_produto_gravar($post){
		
		$this->db->insert('produtos', $post);
		$id_produto = $this->db->insert_id();

        return $id_produto;
		
	}

	public function edit_produto($post, $id_produto){
		$produto = array(
			'nome'              => $post['nome'],
			'fabricante'        => $post['fabricante'],
		    'unidade'           => $post['unidade'],
			'status'            => ($post['status'] ? 1 : 0)
        );
		
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_produto);
		$this->db->update('produtos', $produto);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function get_produto_by_id($viagem_id){
        $data = $this->db->get_where('produtos', array('id' => $viagem_id))->result();
		return $data;
    }

	public function alterar_imagem($post, $id_produto){
		if($_FILES['mudar_foto']['tmp_name']){
			$foto = 'mudar_foto'.$id_produto;
			$this->upload_image($_FILES['mudar_foto'], $id_produto, $foto);
		}
	}
	
	public function upload_image($image,$mala_id, $foto){

		$str = $image['name'];
        $new_str = str_replace('-', '', $str);
        $new = str_replace(' ', '', $new_str);
        $newFilePath = "./assets/produtos/" . $new;

        if(move_uploaded_file($image['tmp_name'], $newFilePath)){
			$data = array('foto' => $new);
			$this->db->where('id', $mala_id);
			$this->db->update('produtos', $data);
		}
	}

	
}
