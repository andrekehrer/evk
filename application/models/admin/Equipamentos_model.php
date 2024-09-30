<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Equipamentos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}


	public function lista_equipamentos(){
		$data = $this->db->get('equipamentos')->result();
		return $data;
	}

	public function lista_rastreador(){
		$data = $this->db->get('equipamentos')->result();
		$data = $this->db->get_where('equipamentos', array('rastreador' => 1))->result();
		return $data;
	}


	public function add_equipamento_gravar($post){
		
		$this->db->insert('equipamentos', $post);
		$id_equipamento = $this->db->insert_id();

        return $id_equipamento;
		
	}

	public function edit_equipamento($post, $id_equipamento){
		$equipamento = array(
		    'nome'          => $post['nome'],
            'proprietario'  => $post['proprietario'],
		    'cnpj'          => $post['cnpj'],
		    'seguro'        => $post['seguro'],
		    'vigencia'      => $post['vigencia'],
			'status'        => ($post['status'] ? 1 : 0),
			'patrimonio'    => $post['patrimonio'],
			'fabricante'    => $post['fabricante'],
			'ano'           => $post['ano'],
			'cor'           => $post['cor'],
			'rastreador'    => ($post['rastreador'] ? 1 : 0),
			'chassi'        => $post['chassi'],
			'renavam'       => $post['renavam']
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_equipamento);
		$this->db->update('equipamentos', $equipamento);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function get_equipamento_by_id($viagem_id){
        $data = $this->db->get_where('equipamentos', array('id' => $viagem_id))->result();
		return $data;
    }

	public function alterar_imagem($post, $id_equipamento){
		if($_FILES['mudar_foto']['tmp_name']){
			$foto = 'mudar_foto'.$id_equipamento;
			$this->upload_image($_FILES['mudar_foto'], $id_equipamento, $foto);
		}
	}
	
	public function upload_image($image,$mala_id, $foto){

		$str = $image['name'];
        $new_str = str_replace('-', '', $str);
        $new = str_replace(' ', '', $new_str);
        $newFilePath = "./assets/equipamentos/" . $new;

        if(move_uploaded_file($image['tmp_name'], $newFilePath)){
			$data = array('foto' => $new);
			$this->db->where('id', $mala_id);
			$this->db->update('equipamentos', $data);
		}
	}

	
}
