<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rdfs_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

    public function lista_data_rdf(){
		$data = $this->db->get('rdfs')->result();
		return $data;
	}

    public function get_lista_rdf_furos_by_id($obra_id, $rdf_id){
        $data = $this->db->get_where('lista_rdf_furos', array('obra_id' => $obra_id, 'rdf_id' => $rdf_id))->result();
		return $data;
	}

	public function get_lista_rdf_furos_by_rdf_id($rdf_id){
        $data = $this->db->get_where('lista_rdf_furos', array('rdf_id' => $rdf_id))->result();
		return $data;
	}

    public function insere_lista_da_obra_gravar($post){
    

		$tem_pv = $this->tem_pv($post['rdf_id']);

		if($post['contagem'] == 1){
		
			if($tem_pv[0]->pv != ''){
				if(($post['pv'] != '') and ($tem_pv[0]->pv == $post['pv'])){
					echo '1';
					$post['pv'] = $tem_pv[0]->pv;
				}elseif(($post['pv'] != '') and ($tem_pv[0]->pv != $post['pv'])){
					echo '2';
					$post['pv'] = $post['pv'];
				}elseif($post['pv'] == ''){
					echo '3';
					$post['pv'] = $tem_pv[0]->pv;
				}
			}
		}
		
		unset($post['contagem']);

		$this->db->insert('lista_rdf_furos', $post);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

	function grava_valor_rdf_certo($post){

		$data_ = $this->db->get_where('valor_certo_rdf', array('rdf_id' => $post['rdf']))->result();

		$data = array(
			'rdf_id'         => $post['rdf'],
			'obra_id'    	 => $post['obra'],
			'valor'     	 => $post['valor'],
        );


		if(count($data_) == 0){
			$this->db->insert('valor_certo_rdf', $data);
		}else{
			$this->db->where('rdf_id', $post['rdf']);
			$this->db->update('valor_certo_rdf', $data);
		}
		// p($this->db->last_query());
		
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

	
	public function tem_pv($rdf_id){
		$this->db->select('pv');
		$this->db->from('lista_rdf_furos');
		$this->db->where('rdf_id', $rdf_id);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get()->result();
		
		return $data;
	}

	public function tem_haste($rdf_id){
		$this->db->select('haste');
		$this->db->from('lista_rdf_furos');
		$this->db->where('rdf_id', $rdf_id);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get()->result();
		return $data;
	}


	public function get_ultimo_furo_rdf($rdf_id){
		$this->db->select('*');
		$this->db->from('lista_rdf_furos');
		$this->db->where('rdf_id', $rdf_id);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get()->result();
		
		return $data;
	}

	public function get_prof_lisa_rdf($rdf_id){
		$this->db->select('*');
		$this->db->from('lista_rdf_furos');
		$this->db->where('rdf_id', $rdf_id);
		$data = $this->db->get()->result();
		
		return $data;
	}

    public function lista_rdfs_gestor(){
		$this->db->select('rdfs.id, rdfs.data, obras.id as obra_id, obras.nome as nome_obra');
		$this->db->select('funcionarios.nome as funcionario');
		$this->db->from('rdfs');
		$this->db->join('funcionarios', 'funcionarios.id = rdfs.funcionario_id');
		$this->db->join('obras', 'rdfs.id_obra = obras.id');
		$this->db->order_by('rdfs.id', 'DESC');
		$data = $this->db->get()->result();
		
		return $data;
	}


    public function edit_rdf($post, $id_rdf){
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
		$this->db->where('id', $id_rdf);
		$this->db->update('rdfs', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function add_rdf_gravar($post){
		
		$this->db->insert('rdfs', $post);
		$id_rdf = $this->db->insert_id();

        return $id_rdf;
		
	}

    
    public function lista_rdfs_by_obra_id_e_rdf($obra_id, $rdf_id){
		$this->db->select('funcionarios.nome, funcionarios.sobrenome, rdfs.*');
		$this->db->from('rdfs');
		$this->db->join('funcionarios', 'funcionarios.id = rdfs.funcionario_id');
		$this->db->where('rdfs.id_obra', $obra_id);
		$this->db->where('rdfs.id', $rdf_id);
		$data = $this->db->get()->result();

        // $data = $this->db->get_where('rdfs', array('id_obra' => $obra_id, 'id' => $rdf_id))->result();

		return $data;
    }
    public function lista_rdfs_by_obra_id($obra_id, $funcionario_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('rdfs', array('id_obra' => $obra_id, 'funcionario_id' => $funcionario_id))->result();
		return $data;
    }


	public function lista_rdfs(){
		$data = $this->db->get('rdfs')->result();
		return $data;
	}

    public function get_rdf_by_id($rdf_id){
        $data = $this->db->get_where('rdfs', array('id' => $rdf_id))->result();
		return $data;
    }

    public function assinaturas_rdf_by_rdf_id($obra_id){


        $this->db->select('assinatura_equipe_rdf.*, funcionarios.nome, funcionarios.sobrenome');
		$this->db->from('assinatura_equipe_rdf');
		$this->db->join('funcionarios', 'funcionarios.id = assinatura_equipe_rdf.funcionario_id');
		$this->db->where('assinatura_equipe_rdf.rdf_id', $obra_id);
		$data = $this->db->get()->result();
        // $data = $this->db->get_where('assinatura_equipe_rdf', array('rdf_id' => $rdf_id))->result();
		return $data;
    }

    public function produtos_do_rdf($rdf_id){


        $this->db->select('produtos_rdf.*, produtos.nome, produtos.unidade');
		$this->db->from('produtos_rdf');
		$this->db->join('produtos', 'produtos.id = produtos_rdf.produto_id');
		$this->db->where('produtos_rdf.rdf_id', $rdf_id);
		$data = $this->db->get()->result();
        // $data = $this->db->get_where('assinatura_equipe_rdf', array('rdf_id' => $rdf_id))->result();
		return $data;
    }

	public function insere_item_rdf_gravar($id_obra, $id_rdf, $post){

        // p($post);
        
        foreach($post as $key => $row){

            if(str_contains($key, 'produtos')){
                $data_produto = explode("_",$key);

                $this->db->where('produto_id',$data_produto[1]);
                $this->db->where('rdf_id',$id_rdf);
                $q = $this->db->get('produtos_rdf');

                if ( $q->num_rows() > 0 ) 
                {   
                    $data = array('qtd'=> $row);
                    $this->db->where('rdf_id',$id_rdf);
                    $this->db->where('produto_id',$data_produto[1]);
                    $this->db->update('produtos_rdf',$data);
                    
                } else {
                    $data = array('rdf_id'=> $id_rdf,'produto_id'=> $data_produto[1],'qtd'=> $row);
                    $this->db->insert('produtos_rdf',$data);
                }

                unset($post[$key]);
            }
        }
        $post['data_furo_piloto'] 		= strtotime($post['data_furo_piloto']);
        $post['data_puxe']        		= strtotime($post['data_puxe']);
        $post['data_alterada']          = strtotime($post['data_alterada']);

		$this->db->where('id', $id_rdf);
		$this->db->where('id_obra', $id_obra);
		$this->db->update('rdfs', $post);

	}


	
}
