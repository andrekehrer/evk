<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rdos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return;
	}

    public function lista_data_rdo(){
		$data = $this->db->get('rdos')->result();
		return $data;
	}

    public function lista_rdos_by_obra_id_data($obra_id, $data_dia = false){

        $this->db->select('*');
		$this->db->from('rdos');
		$this->db->where('id_obra', $obra_id);
        if($data_dia == true){
            $this->db->where('dia_criada', $data_dia);
        }
		$this->db->order_by('rdos.id', 'DESC');
        $this->db->limit(1);

		$data = $this->db->get()->result();
		// p($this->db->last_query());

		return $data;
    }

    public function lista_rdos_gestor(){
		$this->db->select('rdos.id, rdos.data, obras.id as obra_id, obras.nome as nome_obra');
		$this->db->select('funcionarios.nome as funcionario');
		$this->db->select('funcionarios.id as id_funcionario');
		$this->db->from('rdos');
		$this->db->join('funcionarios', 'funcionarios.id = rdos.funcionario_id');
		$this->db->join('obras', 'rdos.id_obra = obras.id');
		$this->db->order_by('rdos.id', 'DESC');
		$data = $this->db->get()->result();
		
		return $data;
	}

    public function edit_rdo($post, $id_rdo){
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
		$this->db->where('id', $id_rdo);
		$this->db->update('rdos', $data);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

    public function add_rdo_gravar($post){
		
		$this->db->insert('rdos', $post);
		$id_rdo = $this->db->insert_id();

        return $id_rdo;
		
	}

    
    public function lista_rdos_by_obra_id_e_rdo($obra_id, $rdo_id){
        $data = $this->db->get_where('rdos', array('id_obra' => $obra_id, 'id' => $rdo_id))->result();
		return $data;
    }
    public function lista_rdos_by_obra_id($obra_id, $funcionario_id){
        $data = $this->db->order_by('data', 'DESC')->get_where('rdos', array('id_obra' => $obra_id, 'funcionario_id' => $funcionario_id))->result();
		return $data;
    }


	public function lista_rdos(){
		$data = $this->db->get('rdos')->result();
		return $data;
	}

    public function get_rdo_by_id($rdo_id){
        $data = $this->db->get_where('rdos', array('id' => $rdo_id))->result();
		return $data;
    }

    public function assinaturas_rdo_by_rdo_id($obra_id){

        $this->db->select('assinatura_equipe_rdo.*, funcionarios.nome, funcionarios.sobrenome');
		$this->db->from('assinatura_equipe_rdo');
		$this->db->join('funcionarios', 'funcionarios.id = assinatura_equipe_rdo.funcionario_id', 'left');
		$this->db->where('assinatura_equipe_rdo.rdo_id', $obra_id);
		$data = $this->db->get()->result();
        // $data = $this->db->get_where('assinatura_equipe_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
    }

    public function produtos_do_rdo($rdo_id){


        $this->db->select('produtos_rdo.*, produtos.nome, produtos.unidade');
		$this->db->from('produtos_rdo');
		$this->db->join('produtos', 'produtos.id = produtos_rdo.produto_id');
		$this->db->where('produtos_rdo.rdo_id', $rdo_id);
		$data = $this->db->get()->result();
        // $data = $this->db->get_where('assinatura_equipe_rdo', array('rdo_id' => $rdo_id))->result();
		return $data;
    }

    public function inserir_funcionario_no_rdo($rdo_id, $funcionario, $lat, $longe){
        date_default_timezone_set('America/Sao_Paulo');
        if($_SESSION['backend']['permissao'] == 2){
            $data = array('funcionario_id'=> $funcionario);
            $this->db->where('rdo_id',$rdo_id);
            $this->db->update('rdos',$data); 
        }
        
        $data = array(
            'funcionario_id' => $funcionario,
            'rdo_id' => $rdo_id,
            'latitude' => $lat,
            'longetude' => $longe,
            'checkin' => strtotime(date("Y-m-d h:i:sa")),
        );
        $this->db->insert('funcionarios_rdo', $data);
    }

    public function inserir_veiculo_no_rdo($rdo_id, $funcionario, $veiculo){
        date_default_timezone_set('America/Sao_Paulo');
        $data = array(
            'funcionario_id' => $funcionario,
            'frota_id' => $veiculo,
            'rdo_id' => $rdo_id,
            'checkin' => strtotime(date("Y-m-d h:i:sa")),
        );
        $this->db->insert('veiculos_rdo', $data);
    }



    public function criar_rdo_para_checkin($obra_id, $user_id, $permissao){
        date_default_timezone_set('America/Sao_Paulo');
        $today      = strtotime(date("Y-m-d h:i:sa"));
        $today_dia  = date("d-m-Y");

        $data = array(
            'id_obra' => $obra_id,
            'funcionario_id' => ($permissao == 2 ? $user_id : 16),
            'data' => $today,
            'data_alterada' => $today,
            'dia_criada' => $today_dia,
        );

        $this->db->insert('rdos', $data);
        $rdo_id = $this->db->insert_id();
        return $rdo_id;
    }

	public function insere_item_rdo_gravar($id_obra, $id_rdo, $post){

        foreach($post as $key => $row){

            if(str_contains($key, 'produtos')){
                $data_produto = explode("_",$key);

                $this->db->where('produto_id',$data_produto[1]);
                $this->db->where('rdo_id',$id_rdo);
                $q = $this->db->get('produtos_rdo');

                if ( $q->num_rows() > 0 ) 
                {   
                    $data = array('qtd'=> $row);
                    $this->db->where('rdo_id',$id_rdo);
                    $this->db->where('produto_id',$data_produto[1]);
                    $this->db->update('produtos_rdo',$data);
                    
                } else {
                    $data = array('rdo_id'=> $id_rdo,'produto_id'=> $data_produto[1],'qtd'=> $row);
                    $this->db->insert('produtos_rdo',$data);
                }

            }
        }

        if($post['veiculos']){
            $this->db->where('rdo_id', $id_rdo);
            $this->db->delete('veiculos_rdo');
            
            foreach($post['veiculos'] as $veiculo){
                $data = array(
                    'frota_id' => $veiculo,
                    'rdo_id' => $id_rdo,
                );
                $this->db->insert('veiculos_rdo', $data);
            }
        }

        if($post['motoristas']){
            $this->db->where('rdo_id', $id_rdo);
            $this->db->delete('motoristas_rdo');

            foreach($post['motoristas'] as $funcionario){

                $data = array(
                    'funcionario_id' => $funcionario,
                    'rdo_id' => $id_rdo,
                );
                $this->db->insert('motoristas_rdo', $data);
            }
        }
		
		if($post['funcionario_obra']){
            $this->db->where('rdo_id', $id_rdo);
            $this->db->delete('funcionarios_rdo');

            foreach($post['funcionario_obra'] as $funcionario){

                $data = array(
                    'funcionario_id' => $funcionario,
                    'rdo_id' => $id_rdo,
                );
                $this->db->insert('funcionarios_rdo', $data);
            }
        }

		$data = array(
			'obs'                   => $post['obs'],
			'horario_inicio_obra'   => $post['hora_inicio_obra'],
			'horario_inicio_exp'    => $post['hora_inicio'],
			'horario_termino_exp'   => $post['hora_termino_obra'],
			'cliente'               => $post['cliente'],
			'endereco'              => $post['endereco'],
			'diametro_t'            => $post['diametro_t'],
			'tipo'                  => $post['tipo'],
			'numero_soldas'         => $post['soldas'],
			'distancia_t'           => $post['distancia_t'],
			'data_alterada'         => strtotime($post['data_alterada']),
			'numero'                => $post['numero'],
			'bairro'                => $post['bairro'],
			'cidade'                => $post['cidade'],
        );

		$this->db->where('id', $id_rdo);
		$this->db->where('id_obra', $id_obra);
		$this->db->update('rdos', $data);

	}


	
}
