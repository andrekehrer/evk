<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rdss_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

    public function lista_data_rds(){
		$data = $this->db->get('rdss')->result();
		return $data;
	}

    public function lista_rdss_by_obra_id_data($obra_id, $data){

        $this->db->select('*');
		$this->db->from('rdss');
		$this->db->where('id_obra', $obra_id);
		// $this->db->where('dia_criada', $data);
		$this->db->order_by('rdss.id', 'DESC');
        $this->db->limit(1);

		$data = $this->db->get()->result();

		return $data;
    }

    public function lista_rdss_gestor(){
		$this->db->select('rdss.id, rdss.data, obras.id as obra_id, obras.nome as nome_obra');
		$this->db->select('funcionarios.nome as funcionario');
		$this->db->from('rdss');
		$this->db->join('funcionarios', 'funcionarios.id = rdss.funcionario_id');
		$this->db->join('obras', 'rdss.id_obra = obras.id');
		$this->db->order_by('rdss.id', 'DESC');
		$data = $this->db->get()->result();
		
		return $data;
	}

    public function edit_rds($post, $id_rds){
        $data = array(
			'nome'          => $post['nome'],
			'status'        => ($post['status'] ? 1 : 0),
			'numero_id'     => $post['numero_id'],
			'endereco'      => $post['endereco'],
			'numero'        => $post['numero'],
			'bairro'        => $post['bairro'],
			'cidade'        => $post['cidade'],
			'estado'        => $post['estado'],
			'cep'           => $post['CEP'],
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id_rds);
		$this->db->update('rdss', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function add_rds_gravar($post){
		
		$this->db->insert('rdss', $post);
		$id_rds = $this->db->insert_id();

        return $id_rds;
		
	}
    
    public function lista_rdss_by_obra_id_e_rds($obra_id, $rds_id){
        $data = $this->db->get_where('rdss', array('id_obra' => $obra_id, 'id' => $rds_id))->result();
		return $data;
    }
    public function lista_rdss_by_obra_id($obra_id, $funcionario_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('rdss', array('id_obra' => $obra_id, 'funcionario_id' => $funcionario_id))->result();
		return $data;
    }


	public function lista_rdss(){
		$data = $this->db->get('rdss')->result();
		return $data;
	}

    public function get_rds_by_id($rds_id){
        $data = $this->db->get_where('rdss', array('id' => $rds_id))->result();
		return $data;
    }
    
    public function assinaturas_rds_by_rds_id($obra_id){
        $this->db->select('assinatura_equipe_rds.*, funcionarios.nome, funcionarios.sobrenome');
		$this->db->from('assinatura_equipe_rds');
		$this->db->join('funcionarios', 'funcionarios.id = assinatura_equipe_rds.funcionario_id', 'left');
		$this->db->where('assinatura_equipe_rds.rds_id', $obra_id);
		$data = $this->db->get()->result();
        // $data = $this->db->get_where('assinatura_equipe_rds', array('rds_id' => $rds_id))->result();
		return $data;
    }

    public function produtos_do_rds($rds_id){


        $this->db->select('produtos_rds.*, produtos.nome, produtos.unidade');
		$this->db->from('produtos_rds');
		$this->db->join('produtos', 'produtos.id = produtos_rds.produto_id');
		$this->db->where('produtos_rds.rds_id', $rds_id);
		$data = $this->db->get()->result();
        
		return $data;
    }

	public function insere_item_rds_gravar($id_obra, $id_rds, $post){

        $post['data'] = strtotime($post['data']);
        unset( $post['id_obra']);
        unset( $post['id_rds']);

		$this->db->where('id', $id_rds);
		$this->db->where('id_obra', $id_obra);
		$this->db->update('rdss', $post);

        // p($this->db->last_query());
	}


	
}
