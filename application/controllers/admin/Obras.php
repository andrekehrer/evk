<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obras extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/obras_model');
		$this->load->model('admin/cliente_model');
		$this->load->model('admin/funcionarios_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'obras';
        $data['obras'] = $this->obras_model->lista_obras();

        $this->load->view('admin/obras', $data);
	}

    public function lista_rdos($obra_id){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title']      = 'Lista RDO';
        $data['rdos']       = $this->obras_model->lista_rdos($obra_id);
        $data['obra']       = $this->obras_model->get_obra_by_id($obra_id);

        $data['obra_id']    = $obra_id;
        // p($data);
        $this->load->view('admin/lista_rdo', $data);
	}

    public function lista_rdfs($obra_id){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title']      = 'Lista RDO';
        $data['rdfs']       = $this->obras_model->lista_rdfs($obra_id);
        $data['obra']       = $this->obras_model->get_obra_by_id($obra_id);
        
        $data['obra_id']    = $obra_id;
        // p($data);
        $this->load->view('admin/lista_rdf', $data);
	}
    
    public function edit_obra($obra_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha obra';
        $data['obra'] = $this->obras_model->get_obra_by_id($obra_id);
        $data['clientes'] = $this->cliente_model->lista_clientes();

        $data['id_obra'] = $obra_id;
        
        $this->load->view('admin/edit_obra', $data);
    }

    public function items_da_obra($obra_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha obra';

        $data['obra']    = $this->obras_model->get_obra_by_id($obra_id);
        $data['itens1']  = $this->obras_model->get_itens_da_obra($obra_id,1);
        $data['itens2']  = $this->obras_model->get_itens_da_obra($obra_id,2);
        $data['itens3']  = $this->obras_model->get_itens_da_obra($obra_id,3);
        
        $data['id_obra'] = $obra_id;

        $this->load->view('admin/items_da_obra', $data);
    }

    public function insere_item_obra_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_obra = $_POST['id_obra'];
        $this->obras_model->insere_item_obra_gravar($this->input->post());

        redirect('admin/obras/items_da_obra/'.$id_obra);
    }

    public function excluir_item_da_obra(){
        $this->db->delete('itens_da_obra', array('id' => $_POST['id']));
        echo json_encode(1);
    }

    public function funcionario_da_obra($obra_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha obra';

        $data['obra']    = $this->obras_model->get_obra_by_id($obra_id);
        $data['funcionarios']  = $this->obras_model->get_funcionarios_da_obra($obra_id);
        
        $new_func = array();
        foreach ($data['funcionarios'] as $row){
            array_push($new_func, $row->id);
        }
    
        $data['lista_funcionarios']  = $this->funcionarios_model->lista_funcionarios($new_func);
        $data['id_obra'] = $obra_id;

        $this->load->view('admin/funcionario_da_obra', $data);
    }

    public function insere_funcionario_da_obra_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $id_obra = $_POST['id_obra'];
        $this->obras_model->insere_funcionario_da_obra_gravar($this->input->post());

        redirect('admin/obras/funcionario_da_obra/'.$id_obra);
    }

    public function excluir_funcionario_da_obra(){
        $this->db->delete('funcionarios_da_obra', array('id_funcionario' => $_POST['id'],'id_obra' => $_POST['id_obra']));
        echo json_encode(1);
    }

    public function edit_obra_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        // p($_POST);
        $id_obra = $_POST['id'];
        $this->obras_model->edit_obra($this->input->post(), $id_obra);
        
        redirect('admin/obras/edit_obra/'.$id_obra);
    }

    public function add_obra(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar obra';

        $this->load->view('admin/add_obra', $data);
    }

    public function add_obra_gravar(){
        $id = $_SESSION['backend']['id'];
        $data = array(
			'nome'          => $_POST['nome'],
			'status'        => ($_POST['status'] ? 1 : 0),
			'numero_id'     => $_POST['numero_id'],
			'endereco'      => $_POST['endereco'],
			'numero'        => $_POST['numero'],
			'bairro'        => $_POST['bairro'],
			'tipo'          => $_POST['tipo'],
			'cidade'        => $_POST['cidade'],
			'estado'        => $_POST['estado'],
			'cep'           => $_POST['CEP'],
        );
        $id_obra = $this->obras_model->add_obra_gravar($data);
        redirect('admin/obras/edit_obra/'.$id_obra);
    }
    
}

