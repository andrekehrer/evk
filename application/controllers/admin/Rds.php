<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Rds extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/rdss_model');
		$this->load->model('admin/obras_model');
		$this->load->model('admin/frotas_model');
		$this->load->model('admin/produtos_model');
	}

	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $data['title'] = 'RDS - Relatório de Solda';
        $id = $_SESSION['backend']['id'];

        if($_SESSION['backend']['permissao']==99){
            $data['rdss'] = $this->rdss_model->lista_rdss_gestor();
            $this->load->view('admin/lista_rds_gestor', $data);

        }else{
            $data['obras'] = $this->obras_model->get_obra_id_usuario($id);
            $this->load->view('admin/rdss', $data);
        }
        
	}

    public function lista_rds($obra_id){  

        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Lista de RDss';
        $data['obra_id'] = $obra_id;
        $data['rdss'] = $this->rdss_model->lista_rdss_by_obra_id($obra_id, $user_id);

        $this->load->view('admin/rdss_lista', $data);
    }

    public function criar_rds($obra_id){  

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        date_default_timezone_set('America/Sao_Paulo');
        $user_id    = $_SESSION['backend']['id'];
        $today      = strtotime(date("Y-m-d h:i:sa"));
        $today_dia  = date("d-m-Y");
        
        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id_obra',$obra_id);
        $this->db->where('data',$today);
        $q = $this->db->get('rdss');

        if($_SESSION['backend']['permissao'] != 99){
            if ( $q->num_rows() > 0 ) {   
                $rds_id = $q->result();
                redirect('admin/rds/carrega_rds/'.$obra_id.'/'.$rds_id[0]->id);       
            }
        }
            
        $data = array(
            'id_obra' => $obra_id,
            'funcionario_id' => $user_id,
            'data' => $today,
            'data_alterada' => $today,
            'dia_criada' => $today_dia,
        );
        $this->db->insert('rdss', $data);
        $rds_id = $this->db->insert_id();

        redirect('admin/rds/carrega_rds/'.$obra_id.'/'.$rds_id);
        

	}

    public function excluir_rds(){

        $this->db->delete('veiculos_rds', array('rds_id' => $_POST['id']));
        $this->db->delete('motoristas_rds', array('rds_id' => $_POST['id']));
        $this->db->delete('produtos_rds', array('rds_id' => $_POST['id']));
        $this->db->delete('funcionarios_rds', array('rds_id' => $_POST['id']));
        $this->db->delete('assinatura_equipe_rds', array('rds_id' => $_POST['id']));
        $this->db->delete('rdss', array('id' => $_POST['id']));

        echo json_encode(1);
    }

    public function carrega_rds($obra_id, $rds_id){  
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $user_id = $_SESSION['backend']['id'];

        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id',$rds_id);
        $q = $this->db->get('rdss');
        
        if($_SESSION['backend']['permissao'] != 99){
            if($q->num_rows() == 0) {   
                redirect('admin/rds/lista_rds/'.$obra_id);
            }
        }

        $data['title'] = 'rdss';
        $data['detalhes_bra']   = $this->obras_model->get_obra_id_obra($obra_id);
        $data['funcionarios']   = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['frota']          = $this->frotas_model->lista_frotas();
        $data['produtos']       = $this->produtos_model->lista_produtos();
        $data['rds_id']         = $rds_id;
        $data['rdss']           = $this->rdss_model->lista_rdss_by_obra_id_e_rds($obra_id, $rds_id);
        $frota_rds              = $this->frotas_model->lista_frotas_by_rds_id($rds_id);
        $funcionarios_rds       = $this->frotas_model->lista_funcionarios_rds($rds_id);
        $motorista_rds          = $this->frotas_model->lista_motoristas_by_rds_id($rds_id);

        $frota_array = array();
        foreach($frota_rds as $frota){
            array_push($frota_array,$frota->frota_id);
        }

        $motoristas_array = array();
        foreach($motorista_rds as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $func_array = array();
        foreach($funcionarios_rds as $func){
            array_push($func_array,$func->funcionario_id);
        }

        $data['motoristas_array']   = $motoristas_array;
        $data['frota_array']        = $frota_array;
        $data['func_array']        = $func_array;
        // p($data);
        
        $this->load->view('admin/criar_rds', $data);
	}


    public function items_da_rds($rds_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rds';

        $data['rds']    = $this->rdss_model->get_rds_by_id($rds_id);
        $data['itens1']  = $this->rdss_model->get_itens_da_rds($rds_id,1);
        $data['itens2']  = $this->rdss_model->get_itens_da_rds($rds_id,2);
        $data['itens3']  = $this->rdss_model->get_itens_da_rds($rds_id,3);
        
        $data['id_rds'] = $rds_id;

        $this->load->view('admin/items_da_rds', $data);
    }

    public function salvar_rds(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_obra = $_POST['id_obra'];
        $id_rds = $_POST['id_rds'];

        $this->rdss_model->insere_item_rds_gravar($id_obra, $id_rds, $this->input->post());

        redirect('admin/rds/carrega_rds/'.$id_obra.'/'.$id_rds);
    }

    public function salvar_rds_assinatura(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $rds_id             = $_POST['rds_id'];
        $id_cliente         = $_POST['id_cliente'];
        $assinatura_value   = $_POST['assinatura_value'];

       if($id_cliente=='equipe'){
            $this->db->where('funcionario_id',99);
            $this->db->where('rds_id',$rds_id);
            $q = $this->db->get('assinatura_equipe_rds');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->where('rds_id',$rds_id);
                $this->db->where('funcionario_id',99);
                $this->db->update('assinatura_equipe_rds',$data);
                
            } else {
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rds',$data);
            }
       }else if($id_cliente=='cliente'){
            $this->db->where('funcionario_id',88);
            $this->db->where('rds_id',$rds_id);
            $q = $this->db->get('assinatura_equipe_rds');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->where('rds_id',$rds_id);
                $this->db->where('funcionario_id',88);
                $this->db->update('assinatura_equipe_rds',$data);
                
            } else {
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rds',$data);
            }
       }else{
            $this->db->where('funcionario_id',$id_cliente);
            $this->db->where('rds_id',$rds_id);
            $q = $this->db->get('assinatura_equipe_rds');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->where('rds_id',$rds_id);
                $this->db->where('funcionario_id',$id_cliente);
                $this->db->update('assinatura_equipe_rds',$data);
                
            } else {
                $data = array('rds_id'=> $rds_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rds',$data);
            }
        }
        echo json_encode(1);


    }

    public function excluir_item_da_rds(){
        $this->db->delete('itens_da_rds', array('id' => $_POST['id']));
        echo json_encode(1);
    }

    public function funcionario_da_rds($rds_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rds';

        $data['rds']    = $this->rdss_model->get_rds_by_id($rds_id);
        $data['funcionarios']  = $this->rdss_model->get_funcionarios_da_rds($rds_id);
        
        $new_func = array();
        foreach ($data['funcionarios'] as $row){
            array_push($new_func, $row->id);
        }
    
        $data['lista_funcionarios']  = $this->funcionarios_model->lista_funcionarios($new_func);
        $data['id_rds'] = $rds_id;

        $this->load->view('admin/funcionario_da_rds', $data);
    }

    public function insere_funcionario_da_rds_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_rds = $_POST['id_rds'];
        $this->rdss_model->insere_funcionario_da_rds_gravar($this->input->post());

        redirect('admin/rdss/funcionario_da_rds/'.$id_rds);
    }

    public function excluir_funcionario_da_rds(){
        $this->db->delete('funcionarios_da_rds', array('id_funcionario' => $_POST['id'],'id_rds' => $_POST['id_rds']));
        echo json_encode(1);
    }

    public function edit_rds_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        // p($_POST);
        $id_rds = $_POST['id'];
        $this->rdss_model->edit_rds($this->input->post(), $id_rds);
        
        redirect('admin/rdss/edit_rds/'.$id_rds);
    }

    public function add_rds(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar rds';

        $this->load->view('admin/add_rds', $data);
    }

    public function add_rds_gravar(){
        $id = $_SESSION['backend']['id'];
        $data = array(
			'nome'          => $_POST['nome'],
			'status'        => ($_POST['status'] ? 1 : 0),
			'numero_id'     => $_POST['numero_id'],
			'endereco'      => $_POST['endereco'],
			'numero'        => $_POST['numero'],
			'bairro'        => $_POST['bairro'],
			'cidade'        => $_POST['cidade'],
			'estado'        => $_POST['estado'],
			'cep'           => $_POST['CEP'],
        );
        $id_rds = $this->rdss_model->add_rds_gravar($data);
        redirect('admin/rdss/edit_rds/'.$id_rds);
    }

    public function export_rds($obra_id, $rds_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'RDs';
        $data['title'] = 'RDsS - PDF';
        $data['detalhes_bra']       = $this->obras_model->get_obra_id_obra($obra_id);

        $data['funcionarios']       = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['assinaturas_rds']    = $this->rdss_model->assinaturas_rds_by_rds_id($rds_id);
        $data['produtos']           = $this->rdss_model->produtos_do_rds($rds_id);
        // $data['assinatura']         = $data['assinaturas_rds'][0]->assinatura;
        
        $data['rds_id']             = $rds_id;
        $data['rdss']               = $this->rdss_model->lista_rdss_by_obra_id_e_rds($obra_id, $rds_id);
        $frota_rds                  = $this->frotas_model->lista_frotas_com_nome_by_rds_id($rds_id);
        $funcionarios_rds           = $this->frotas_model->lista_funcionarios_rds($rds_id);
        $motorista_rds              = $this->frotas_model->lista_motoristas_by_rds_id($rds_id);

        $tipo = '';
        switch ($data['detalhes_bra'][0]->tipo) {
            case 1:
                $tipo = 'Esgoto';
            break;
            case 2:
                $tipo = 'Água'; 
            break;
            case 3:
                $tipo = 'Gás';
            break;
            case 4:
                $tipo = 'Fibra óptica';
            break;
            case 5:
                $tipo = 'Drenagem';
            break;
            case 6:
                $tipo = 'Eletricidade';
            break;
            case 7:
                $tipo = 'Travessias especias';
            break;
            default:
                $tipo = '';
        }

        
        $motoristas_array = array();
        foreach($motorista_rds as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $func_array = array();
        foreach($funcionarios_rds as $func){
            array_push($func_array,$func->funcionario_id);
        }


        $data['tipo'] = $tipo;
        $data['motoristas_array']   = $motoristas_array;
        $data['func_array']         = $func_array;
        $data['frota_array']        = $frota_rds;
        // p($data);
        $this->load->view('admin/export_rds', $data);

    }
    
}

