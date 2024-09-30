<?php

use Mpdf\Tag\P;

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Rdf extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/rdfs_model');
		$this->load->model('admin/obras_model');
		$this->load->model('admin/frotas_model');
		$this->load->model('admin/produtos_model');
		$this->load->model('admin/equipamentos_model');
	}

	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id = $_SESSION['backend']['id'];
		$data['title'] = 'RDF - Relatório de Obras';
        
        if($_SESSION['backend']['permissao']==99){
            $data['rdfs'] = $this->rdfs_model->lista_rdfs_gestor();
            // p($data);
            $this->load->view('admin/lista_rdf_gestor', $data);

        }else{
            $data['obras'] = $this->obras_model->get_obra_id_usuario($id);
            $this->load->view('admin/rdfs', $data);
        }
	}

    public function lista_rdf($obra_id){  

        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Lista de Rdfs';
        $data['obra_id'] = $obra_id;
        $data['rdfs'] = $this->rdfs_model->lista_rdfs_by_obra_id($obra_id, $user_id);
        // p($data);
        $this->load->view('admin/rdfs_lista', $data);
    }

    public function criar_rdf($obra_id){  

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $user_id = $_SESSION['backend']['id'];
        date_default_timezone_set('America/Sao_Paulo');
        $today = strtotime(date("Y-m-d h:i:sa"));

        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id_obra',$obra_id);
        $this->db->where('data',$today);
        $q = $this->db->get('rdfs');

        if ( $q->num_rows() > 0 ) 
        {   
            $rdf_id = $q->result();

            redirect('admin/rdf/carrega_rdf/'.$obra_id.'/'.$rdf_id[0]->id);
            
        }else{
            $data = array(
                'id_obra' => $obra_id,
                'funcionario_id' => $user_id,
                'data' => $today,
                'data_alterada' => $today,
            );
            $this->db->insert('rdfs', $data);
            $rdf_id = $this->db->insert_id();

            redirect('admin/rdf/carrega_rdf/'.$obra_id.'/'.$rdf_id);
        }

	}

    public function carrega_rdf($obra_id, $rdf_id){  
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $user_id = $_SESSION['backend']['id'];

        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id',$rdf_id);
        $q = $this->db->get('rdfs');

        if($_SESSION['backend']['permissao'] != 99){
            if($q->num_rows() == 0 ) {   
                redirect('admin/rdf/lista_rdf/'.$obra_id);
            }
        }
        

        $data['title'] = 'rdfs';
        $data['detalhes_bra']   = $this->obras_model->get_obra_id_obra($obra_id);
        $data['funcionarios']   = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['perfuratriz']    = $this->frotas_model->get_perfuratriz();
        $data['produtos']       = $this->produtos_model->lista_produtos();
        $data['rastreador']     = $this->equipamentos_model->lista_rastreador();
        $data['rdf_id']         = $rdf_id;
        $data['rdfs']           = $this->rdfs_model->lista_rdfs_by_obra_id_e_rdf($obra_id, $rdf_id);
        $frota_rdf              = $this->frotas_model->lista_frotas_by_rdf_id($rdf_id);
        $motorista_rdf          = $this->frotas_model->lista_motoristas_by_rdf_id($rdf_id);
        $valor_certo_furos      = $this->db->get_where('valor_certo_rdf', array('rdf_id' => $rdf_id))->result();

        $frota_array = array();
        foreach($frota_rdf as $frota){
            array_push($frota_array,$frota->frota_id);
        }

        $motoristas_array = array();
        foreach($motorista_rdf as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $data['valor_certo_furos']  = (isset($valor_certo_furos[0]->valor) ? $valor_certo_furos[0]->valor : 0);
        $data['motoristas_array']   = $motoristas_array;
        $data['frota_array']        = $frota_array;
        // p($data);
        
        $this->load->view('admin/criar_rdf', $data);
	}

    public function excluir_furo_da_lista(){

        $furo =  $this->rdfs_model->get_ultimo_furo_rdf($_POST['rdf']);
        $numeracao = explode("/",$furo[0]->numeracao);
        $this->db->delete('lista_rdf_furos', array('id' => $_POST['id']));

        echo json_encode($numeracao[0]);
    }

    public function insere_lista_da_obra_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        // p($_POST);
        $numeracao = explode("/",$_POST['numeracao']);
        $id_obra = $_POST['obra_id'];
        $rdf_id = $_POST['rdf_id'];

        $this->rdfs_model->insere_lista_da_obra_gravar($this->input->post());

        redirect('admin/rdf/add_lista/'.$id_obra.'/'.$rdf_id.'?haste='.$_POST['haste'].'&numeracao='.$numeracao[0]);
    }

    public function salvar_valor_certo(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $this->rdfs_model->grava_valor_rdf_certo($this->input->post());
    }

    public function add_lista($obra_id, $rdf_id){  
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $user_id = $_SESSION['backend']['id'];

        $this->db->where('funcionario_id',$user_id);
        $this->db->where('id',$rdf_id);
        $q = $this->db->get('rdfs');

        if($_SESSION['backend']['permissao'] != 99){
            if($q->num_rows() == 0) {   
                redirect('admin/rdf/lista_rdf/'.$obra_id);
            }
        }

        $data['title'] = 'rdfs';
        $data['detalhes_bra']       = $this->obras_model->get_obra_id_obra($obra_id);
        $data['rdf_id']             = $rdf_id;
        $data['rdfs']               = $this->rdfs_model->lista_rdfs_by_obra_id_e_rdf($obra_id, $rdf_id);
        $data['rdfs_lista']         = $this->rdfs_model->get_lista_rdf_furos_by_id($obra_id, $rdf_id);
        $pv                         = $this->rdfs_model->tem_pv($rdf_id);
        $haste                      = $this->rdfs_model->tem_haste($rdf_id);
        $furo                       = $this->rdfs_model->get_ultimo_furo_rdf($rdf_id);
        $prof_lista                 = $this->rdfs_model->get_prof_lisa_rdf($rdf_id);
        $valor_certo_furos          = $this->db->get_where('valor_certo_rdf', array('rdf_id' => $rdf_id))->result();

        $numeracao = 0;
        if(count($furo)>0){
            $numeracao              = explode("/",$furo[0]->numeracao);
        }

        $order_by_pv = array();
        foreach($prof_lista as $each){
            if($each->pv != ''){
                if (!empty($order_by_pv[$each->pv])){
                    $order_by_pv[$each->pv] = array_merge($order_by_pv[$each->pv], array($each));
                }
                else{
                    $order_by_pv[$each->pv] = array($each);
                }
            }
        }
        $i = 1;
        $result = array();
        $proximo_inicial[1] = 0;
        foreach($order_by_pv as $key  => $pv){
            if(count($pv) != 1){

                $inicio_valor = array_shift($pv);

                $proximo_inicial = explode("/",next($order_by_pv)[0]->numeracao);
            
                if($inicio_valor->numeracao != 0){
                    $numeracao_inicial = explode("/",$inicio_valor->numeracao);
                    $soma_pv = ($proximo_inicial[1] - $numeracao_inicial[1]);
                }else{
                    $soma_pv = ($proximo_inicial[1] - 0);
                }

                $result[$key] = array("total"=>$soma_pv);

            }
            else{
                $result[$key] = array("total"=>$pv[0]->haste);
            }

        $i++;
    }

        $data['soma_final']                = $result;
        $data['valor_certo_furos']         = (isset($valor_certo_furos[0]->valor) ? $valor_certo_furos[0]->valor : 0);

        if(isset($pv[0]->pv)){
            $data['pv'] = $pv[0]->pv;
        }else{
            $data['pv'] = 0;
        }
        if(isset($haste[0]->haste)){
            $data['haste'] = $haste[0]->haste;
        }else{
            $data['haste'] = 0;
        }
        if(isset($numeracao[0])){
            $data['numeracao'] = $numeracao[0];
        }else{
            $data['numeracao'] = 0;
        }
        // p($data);

        $this->load->view('admin/add_lista_furos', $data);
	}


    public function items_da_rdf($rdf_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rdf';

        $data['rdf']    = $this->rdfs_model->get_rdf_by_id($rdf_id);
        $data['itens1']  = $this->rdfs_model->get_itens_da_rdf($rdf_id,1);
        $data['itens2']  = $this->rdfs_model->get_itens_da_rdf($rdf_id,2);
        $data['itens3']  = $this->rdfs_model->get_itens_da_rdf($rdf_id,3);
        
        $data['id_rdf'] = $rdf_id;

        $this->load->view('admin/items_da_rdf', $data);
    }

    public function salvar_rdf(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_obra = $_POST['id_obra'];
        $id_rdf = $_POST['id'];

        $this->rdfs_model->insere_item_rdf_gravar($id_obra, $id_rdf, $this->input->post());

        redirect('admin/rdf/carrega_rdf/'.$id_obra.'/'.$id_rdf);
    }

    public function salvar_rdf_assinatura(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $rdf_id             = $_POST['rdf_id'];
        $id_cliente         = $_POST['id_cliente'];
        $assinatura_value   = $_POST['assinatura_value'];

       if($id_cliente=='equipe'){
            $this->db->where('funcionario_id',99);
            $this->db->where('rdf_id',$rdf_id);
            $q = $this->db->get('assinatura_equipe_rdf');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->where('rdf_id',$rdf_id);
                $this->db->where('funcionario_id',99);
                $this->db->update('assinatura_equipe_rdf',$data);
                
            } else {
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> 99,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdf',$data);
            }
       }else if($id_cliente=='cliente'){
            $this->db->where('funcionario_id',88);
            $this->db->where('rdf_id',$rdf_id);
            $q = $this->db->get('assinatura_equipe_rdf');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->where('rdf_id',$rdf_id);
                $this->db->where('funcionario_id',88);
                $this->db->update('assinatura_equipe_rdf',$data);
                
            } else {
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> 88,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdf',$data);
            }
       }else{
            $this->db->where('funcionario_id',$id_cliente);
            $this->db->where('rdf_id',$rdf_id);
            $q = $this->db->get('assinatura_equipe_rdf');

            if ( $q->num_rows() > 0 ) 
            {   
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->where('rdf_id',$rdf_id);
                $this->db->where('funcionario_id',$id_cliente);
                $this->db->update('assinatura_equipe_rdf',$data);
                
            } else {
                $data = array('rdf_id'=> $rdf_id,'funcionario_id'=> $id_cliente,'assinatura'=> $assinatura_value);
                $this->db->insert('assinatura_equipe_rdf',$data);
            }
        }
        echo json_encode(1);


    }

    public function excluir_item_da_rdf(){
        $this->db->delete('itens_da_rdf', array('id' => $_POST['id']));
        echo json_encode(1);
    }

    public function funcionario_da_rdf($rdf_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha rdf';

        $data['rdf']    = $this->rdfs_model->get_rdf_by_id($rdf_id);
        $data['funcionarios']  = $this->rdfs_model->get_funcionarios_da_rdf($rdf_id);
        
        $new_func = array();
        foreach ($data['funcionarios'] as $row){
            array_push($new_func, $row->id);
        }
    
        $data['lista_funcionarios']  = $this->funcionarios_model->lista_funcionarios($new_func);
        $data['id_rdf'] = $rdf_id;

        $this->load->view('admin/funcionario_da_rdf', $data);
    }

    public function insere_funcionario_da_rdf_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_rdf = $_POST['id_rdf'];
        $this->rdfs_model->insere_funcionario_da_rdf_gravar($this->input->post());

        redirect('admin/rdfs/funcionario_da_rdf/'.$id_rdf);
    }

    public function excluir_funcionario_da_rdf(){
        $this->db->delete('funcionarios_da_rdf', array('id_funcionario' => $_POST['id'],'id_rdf' => $_POST['id_rdf']));
        echo json_encode(1);
    }

    public function excluir_rdf(){

        $this->db->delete('produtos_rdf', array('rdf_id' => $_POST['id']));
        $this->db->delete('valor_certo_rdf', array('rdf_id' => $_POST['id']));
        $this->db->delete('lista_rdf_furos', array('rdf_id' => $_POST['id']));
        $this->db->delete('assinatura_equipe_rdf', array('rdf_id' => $_POST['id']));
        $this->db->delete('rdfs', array('id' => $_POST['id']));

        echo json_encode(1);
    }

    public function edit_rdf_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        // p($_POST);
        $id_rdf = $_POST['id'];
        $this->rdfs_model->edit_rdf($this->input->post(), $id_rdf);
        
        redirect('admin/rdfs/edit_rdf/'.$id_rdf);
    }

    public function add_rdf(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar rdf';

        $this->load->view('admin/add_rdf', $data);
    }

    public function add_rdf_gravar(){
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
        $id_rdf = $this->rdfs_model->add_rdf_gravar($data);
        redirect('admin/rdfs/edit_rdf/'.$id_rdf);
    }

    public function export_rdf($obra_id, $rdf_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'rdf';
        // $data['rdf'] = $this->rdfs_model->get_rdf_by_id($id_rdf);
        // $data['id_rdf'] = $id_rdf;

        $data['title'] = 'rdfS - PDF';
        $data['detalhes_bra']       = $this->obras_model->get_obra_id_obra($obra_id);
        $data['funcionarios']       = $this->obras_model->get_funcionarios_nome_da_obra($obra_id);
        $data['assinaturas_rdf']    = $this->rdfs_model->assinaturas_rdf_by_rdf_id($rdf_id);
        $data['produtos']           = $this->rdfs_model->produtos_do_rdf($rdf_id);
        $data['perfuratriz']        = $this->frotas_model->get_perfuratriz();
        $data['lista_de_furos']     = $this->rdfs_model->get_lista_rdf_furos_by_rdf_id($rdf_id);
        $data['rastreador']         = $this->equipamentos_model->lista_rastreador();
        $prof_lista                 = $this->rdfs_model->get_prof_lisa_rdf($rdf_id);

        $data['rdf_id']             = $rdf_id;
        $data['rdfs']               = $this->rdfs_model->lista_rdfs_by_obra_id_e_rdf($obra_id, $rdf_id);
        $frota_rdf                  = $this->frotas_model->lista_frotas_com_nome_by_rdf_id($rdf_id);
        $motorista_rdf              = $this->frotas_model->lista_motoristas_by_rdf_id($rdf_id);
        $valor_certo_furos      = $this->db->get_where('valor_certo_rdf', array('rdf_id' => $rdf_id))->result();

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
        foreach($motorista_rdf as $motoca){
            array_push($motoristas_array,$motoca->funcionario_id);
        }

        $order_by_pv = array();
        foreach($prof_lista as $each){
            if($each->pv != ''){
                if (!empty($order_by_pv[$each->pv])){
                    $order_by_pv[$each->pv] = array_merge($order_by_pv[$each->pv], array($each));
                }
                else{
                    $order_by_pv[$each->pv] = array($each);
                }
            }
        }

        $i = 1;
        $result = array();

        foreach($order_by_pv as $key  => $pv){

                if(count($pv) != 1){
                    
                    $inicio_valor = array_shift($pv);
                    $proximo_inicial = explode("/",next($order_by_pv)[0]->numeracao);
                    
                    if($inicio_valor->numeracao != 0){
                        $numeracao_inicial = explode("/",$inicio_valor->numeracao);
                        $soma_pv = ($proximo_inicial[1] - $numeracao_inicial[1]);
                    }else{
                        $soma_pv = ($proximo_inicial[1] - 0);
                    }

                    $result[$key] = array("total"=>$soma_pv);

                }
                else{
                    $result[$key] = array("total"=>$pv[0]->haste);
                }

            $i++;
        }

        $data['soma_final']         = $result;
        $data['valor_certo_furos']         = (isset($valor_certo_furos[0]->valor) ? $valor_certo_furos[0]->valor : 0);
        $data['tipo'] = $tipo;
        $data['motoristas_array']   = $motoristas_array;
        $data['frota_array']        = $frota_rdf;
        // p($data);
        $this->load->view('admin/export_rdf', $data);

    }
    
}

