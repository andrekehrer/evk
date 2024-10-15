<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Rdo extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/rdos_model');
		$this->load->model('admin/obras_model');
		$this->load->model('admin/frotas_model');
		$this->load->model('admin/produtos_model');
	}

	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $data['title'] = 'RDO - Relatório de Obras';
        $id = $_SESSION['backend']['id'];

        $data['id_usuario'] = $id;
        
        if($_SESSION['backend']['permissao']==99){
            $data['rdos'] = $this->rdos_model->lista_rdos_gestor();
            $this->load->view('admin/lista_rdo_gestor', $data);

        }else{
            $data['obras'] = $this->obras_model->get_obra_id_usuario($id);
            $data['veiculos'] = $this->frotas_model->get_veiculos($id);
            $this->load->view('admin/rdos', $data);
        }
        
	}

    public function lista_rdo($obra_id){  

        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Lista de RDOs';
        $data['obra_id'] = $obra_id;
        $data['rdos'] = $this->rdos_model->lista_rdos_by_obra_id($obra_id, $user_id);

        $this->load->view('admin/rdos_lista', $data);
    }

    public function checkin_funcionario($obra_id, $id_usuario){
        $today_dia  = date("d-m-Y");

        $rdo = $this->rdos_model->lista_rdos_by_obra_id_data($obra_id, $today_dia);

        if(!$rdo){
            $permissao = $_SESSION['backend']['permissao'];
            $rdo_id = $this->rdos_model->criar_rdo_para_checkin($obra_id, $id_usuario, $permissao);

            $func_adicionado = $this->rdos_model->inserir_funcionario_no_rdo($rdo_id, $id_usuario);
        }else{
            $func_adicionado = $this->rdos_model->inserir_funcionario_no_rdo($rdo[0]->id, $id_usuario);
        }
        redirect('admin/rdo/');    

    }

    public function checkout_funcionario($rdo_id, $funcionario_id, $placa){

        $data = array('checkout'=> strtotime(date("Y-m-d h:i:sa")));
        $this->db->where('rdo_id',$rdo_id);
        $this->db->where('funcionario_id',$funcionario_id);
        $this->db->update('funcionarios_rdo',$data);

        if($placa > 0){
            $data = array('checkout'=> strtotime(date("Y-m-d h:i:sa")));
            $this->db->where('rdo_id',$rdo_id);
            $this->db->where('funcionario_id',$funcionario_id);
            $this->db->update('veiculos_rdo',$data);
        }
        redirect('admin/rdo/');  
    }

    public function checkin_funcionario_motorista(){
        
        $today_dia  = date("d-m-Y");
        
        $id_usuario = $_SESSION['backend']['id'];
        $obra_id = $_POST['obra'];
        
        
        $rdo = $this->rdos_model->lista_rdos_by_obra_id_data($obra_id, $today_dia);

        if(!$rdo){
            $permissao = $_SESSION['backend']['permissao'];
            
            $rdo_id = $this->rdos_model->criar_rdo_para_checkin($obra_id, $id_usuario, $permissao);

            $this->rdos_model->inserir_funcionario_no_rdo($rdo_id, $id_usuario, $_POST['lat'], $_POST['longe']);
        }else{
            $rdo_id = $rdo[0]->id;
            $this->rdos_model->inserir_funcionario_no_rdo($rdo[0]->id, $id_usuario, $_POST['lat'], $_POST['longe']);
        }

        if($_POST['veiculo'] != 0){
            $this->rdos_model->inserir_veiculo_no_rdo($rdo_id, $id_usuario, $_POST['veiculo']);
        }

        redirect('admin/rdo/');    

    }

    public function criar_rdo($obra_id){  

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
        $q = $this->db->get('rdos');

        if($_SESSION['backend']['permissao'] != 99){
            if ( $q->num_rows() > 0 ) {   
                $rdo_id = $q->result();
                redirect('admin/rdo/carrega_rdo/'.$obra_id.'/'.$rdo_id[0]->id);       
            }
        }
            
        $data = array(
            'id_obra' => $obra_id,
            'funcionario_id' => $user_id,
            'data' => $today,
            'data_alterada' => $today,
            'dia_criada' => $today_dia,
        );
        $this->db->insert('rdos', $data);

        $rdo_id = $this->db->insert_id();
        
        $this->rdos_model->inserir_funcionario_no_rdo($rdo_id, $user_id);

        redirect('admin/rdo/carrega_rdo/'.$obra_id.'/'.$rdo_id);
        

	}
    

    public function remover_checkin($rdo_id, $funcionario_id, $placa){
        if($placa > 0){
            $this->db->delete('veiculos_rdo', array('funcionario_id' => $funcionario_id, 'rdo_id' => $rdo_id));
        }
        $this->db->delete('funcionarios_rdo', array('funcionario_id' => $funcionario_id, 'rdo_id' => $rdo_id));
        redirect('admin/rdo/'); 
        
    }
    public function excluir_rdo(){

        $this->db->delete('veiculos_rdo', array('rdo_id' => $_POST['id']));
        $this->db->delete('motoristas_rdo', array('rdo_id' => $_POST['id']));
        $this->db->delete('produtos_rdo', array('rdo_id' => $_POST['id']));
        $this->db->delete('funcionarios_rdo', array('rdo_id' => $_POST['id']));
        $this->db->delete('assinatura_equipe_rdo', array('rdo_id' => $_POST['id']));
        $this->db->delete('rdos', array('id' => $_POST['id']));

        echo json_encode(1);
    }

    public function carrega_rdo($obra_id, $rdo_id){  
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $user_id = $_SESSION['backend']['id'];

        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id',$rdo_id);
        $q = $this->db->get('rdos');
        
        if($_SESSION['backend']['permissao'] != 99){
            if($q->num_rows() == 0) {   
                redirect('admin/rdo/lista_rdo/'.$obra_id);
            }
        }

        $data['title'] = 'rdos';
        $data['detalhes_bra']   = $this->obras_model->get_obra_id_obra($obra_id);
        $data['funcionarios']   = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['frota']          = $this->frotas_model->lista_frotas();
        $data['produtos']       = $this->produtos_model->lista_produtos();
        $data['rdo_id']         = $rdo_id;
        $data['rdos']           = $this->rdos_model->lista_rdos_by_obra_id_e_rdo($obra_id, $rdo_id);
        $frota_rdo              = $this->frotas_model->lista_frotas_by_rdo_id($rdo_id);
        $funcionarios_rdo       = $this->frotas_model->lista_funcionarios_rdo($rdo_id);
        $motorista_rdo          = $this->frotas_model->lista_motoristas_by_rdo_id($rdo_id);

        $frota_array = array();
        foreach($frota_rdo as $frota){
            array_push($frota_array,$frota->frota_id);
        }

        $motoristas_array = array();
        foreach($motorista_rdo as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $func_array = array();
        foreach($funcionarios_rdo as $func){
            array_push($func_array,$func->funcionario_id);
        }

        $data['motoristas_array']   = $motoristas_array;
        $data['frota_array']        = $frota_array;
        $data['func_array']        = $func_array;
        // p($data);
        
        $this->load->view('admin/criar_rdo', $data);
	}


    public function items_da_rdo($rdo_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rdo';

        $data['rdo']    = $this->rdos_model->get_rdo_by_id($rdo_id);
        $data['itens1']  = $this->rdos_model->get_itens_da_rdo($rdo_id,1);
        $data['itens2']  = $this->rdos_model->get_itens_da_rdo($rdo_id,2);
        $data['itens3']  = $this->rdos_model->get_itens_da_rdo($rdo_id,3);
        
        $data['id_rdo'] = $rdo_id;

        $this->load->view('admin/items_da_rdo', $data);
    }

    public function salvar_rdo(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_obra = $_POST['id_obra'];
        $id_rdo = $_POST['id_rdo'];

        $this->rdos_model->insere_item_rdo_gravar($id_obra, $id_rdo, $this->input->post());

        redirect('admin/rdo/carrega_rdo/'.$id_obra.'/'.$id_rdo);
    }

    public function salvar_rdo_assinatura(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $rdo_id             = $_POST['rdo_id'];
        $id_cliente         = $_POST['id_cliente'];
        $assinatura_value   = $_POST['assinatura_value'];

       if($id_cliente=='equipe'){
            $this->db->where('funcionario_id',99);
            $this->db->where('rdo_id',$rdo_id);
            $q = $this->db->get('assinatura_equipe_rdo');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->where('rdo_id',$rdo_id);
                $this->db->where('funcionario_id',99);
                $this->db->update('assinatura_equipe_rdo',$data);
                
            } else {
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdo',$data);
            }
       }else if($id_cliente=='cliente'){
            $this->db->where('funcionario_id',88);
            $this->db->where('rdo_id',$rdo_id);
            $q = $this->db->get('assinatura_equipe_rdo');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->where('rdo_id',$rdo_id);
                $this->db->where('funcionario_id',88);
                $this->db->update('assinatura_equipe_rdo',$data);
                
            } else {
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdo',$data);
            }
       }else{
            $this->db->where('funcionario_id',$id_cliente);
            $this->db->where('rdo_id',$rdo_id);
            $q = $this->db->get('assinatura_equipe_rdo');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->where('rdo_id',$rdo_id);
                $this->db->where('funcionario_id',$id_cliente);
                $this->db->update('assinatura_equipe_rdo',$data);
                
            } else {
                $data = array('rdo_id'=> $rdo_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdo',$data);
            }
        }
        echo json_encode(1);


    }

    public function excluir_item_da_rdo(){
        $this->db->delete('itens_da_rdo', array('id' => $_POST['id']));
        echo json_encode(1);
    }

    public function funcionario_da_rdo($rdo_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rdo';

        $data['rdo']    = $this->rdos_model->get_rdo_by_id($rdo_id);
        $data['funcionarios']  = $this->rdos_model->get_funcionarios_da_rdo($rdo_id);
        
        $new_func = array();
        foreach ($data['funcionarios'] as $row){
            array_push($new_func, $row->id);
        }
    
        $data['lista_funcionarios']  = $this->funcionarios_model->lista_funcionarios($new_func);
        $data['id_rdo'] = $rdo_id;

        $this->load->view('admin/funcionario_da_rdo', $data);
    }

    public function insere_funcionario_da_rdo_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_rdo = $_POST['id_rdo'];
        $this->rdos_model->insere_funcionario_da_rdo_gravar($this->input->post());

        redirect('admin/rdos/funcionario_da_rdo/'.$id_rdo);
    }

    public function excluir_funcionario_da_rdo(){
        $this->db->delete('funcionarios_da_rdo', array('id_funcionario' => $_POST['id'],'id_rdo' => $_POST['id_rdo']));
        echo json_encode(1);
    }

    public function edit_rdo_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        // p($_POST);
        $id_rdo = $_POST['id'];
        $this->rdos_model->edit_rdo($this->input->post(), $id_rdo);
        
        redirect('admin/rdos/edit_rdo/'.$id_rdo);
    }

    public function add_rdo(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar rdo';

        $this->load->view('admin/add_rdo', $data);
    }

    public function add_rdo_gravar(){
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
        $id_rdo = $this->rdos_model->add_rdo_gravar($data);
        redirect('admin/rdos/edit_rdo/'.$id_rdo);
    }

    public function export_rdo($obra_id, $rdo_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'RDO';
        $data['title'] = 'RDOS - PDF';
        $data['detalhes_bra']       = $this->obras_model->get_obra_id_obra($obra_id);

        $data['funcionarios']       = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['assinaturas_rdo']    = $this->rdos_model->assinaturas_rdo_by_rdo_id($rdo_id);
        $data['produtos']           = $this->rdos_model->produtos_do_rdo($rdo_id);
        // $data['assinatura']         = $data['assinaturas_rdo'][0]->assinatura;
        
        $data['rdo_id']             = $rdo_id;
        $data['rdos']               = $this->rdos_model->lista_rdos_by_obra_id_e_rdo($obra_id, $rdo_id);
        $frota_rdo                  = $this->frotas_model->lista_frotas_com_nome_by_rdo_id($rdo_id);
        $funcionarios_rdo           = $this->frotas_model->lista_funcionarios_rdo($rdo_id);
        $motorista_rdo              = $this->frotas_model->lista_motoristas_by_rdo_id($rdo_id);

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
        foreach($motorista_rdo as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $func_array = array();
        foreach($funcionarios_rdo as $func){
            array_push($func_array,$func->funcionario_id);
        }


        $data['tipo'] = $tipo;
        $data['motoristas_array']   = $motoristas_array;
        $data['func_array']         = $func_array;
        $data['frota_array']        = $frota_rdo;
        // p($data);
        $this->load->view('admin/export_rdo', $data);

    }
    
}

