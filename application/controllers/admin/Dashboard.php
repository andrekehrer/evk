<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		// $this->load->model('admin/viagem_model');
	}
	public function index()
	{   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
		$user_id = $_SESSION['backend']['id'];
		$data['title'] = 'Dashboard';
		$frase = $this->db->get_where('frase', array('id' => 1))->result();
		$data['frase'] = $frase[0]->frase;



        $this->db->select('id,nome,sobrenome,dob');
        $this->db->from('funcionarios');
        $this->db->where('status', 1);
        $this->db->order_by('dob', 'DESC');
        $aniver = $this->db->get()->result();

        $array_final = array();
        foreach($aniver as $niver){
            $mes_do_funcionario = date('m', $niver->dob);
            $dia_do_funcionario = date('d', $niver->dob);
            $mes_atual =date("m");
            $dia_atual =date("d");
            if($mes_do_funcionario == $mes_atual){
                if($dia_do_funcionario >= $dia_atual){
                    $aniversariantes = array(
                        'nome'          => $niver->nome.' '.$niver->sobrenome,
                        'aniversario'   => date('d-m-y', $niver->dob),
                        'id'            => $niver->id,
                    );
                    array_push($array_final, $aniversariantes);
                }
            }
        }

        $data['aniversariantes'] = $array_final;
        // p($data);
        $this->load->view('admin/dashboard', $data);
	}

    /////// FRASE ////////
    public function editar_frase(){

        $data = array('frase'=> $_POST['frase']);
        $this->db->where('id', 1);
		$this->db->update('frase', $data);
        
        redirect('admin/dashboard');
    }
    
}

