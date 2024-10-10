<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('admin/login_model');
	}
	public function index(){
        $data['title'] = 'EVK - Faça seu login';

        $data['frase'] = $this->db->get_where('frase', array('id' => 1))->result();

		$this->load->view('admin/login', $data);
	}
    public function alt_senha(){
        $data['title'] = 'Alterar sua senha';
        $data['client_id'] = $_SESSION['backend']['id'];

		$this->load->view('admin/alt_senha', $data);
	}
    
    public function alt_senha_salvar(){

        $alt_senha = $this->login_model->alt_senha($_POST['client_id'],  md5($_POST['pass'])); 
        $array[] = ['tem' =>  'yes',];
        $json['data'] = $array;
        echo json_encode($json, true);
	}

    public function login_carrinho(){
        $data['title'] = 'EVK - Faça seu login';

		$this->load->view('admin/login_carrinho', $data);
	}
    public function adm(){   
        $data['title'] = '';
        $this->load->view('loginadm', $data);
	}
    public function cad(){
        $data['cad'] = '';

		$this->load->view('cadastrar', $data);
    }
    public function cad_insert(){
        
        $checkemail = $this->login_model->checkemail($_POST['nome'],$_POST['sobrenome'],$_POST['insta'],$_POST['quer'],$_POST['email'],$_POST['pass']);
        if($checkemail == 0){
            $array[] = ['tem' =>  'nao',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }else{
            $array[] = ['tem' =>  'yes',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }
    }
	public function log($email=null, $pass=null){
        $default = '202cb962ac59075b964b07152d234b70';
        
        $_SESSION["trocar_senha"] = 0;

        if($email && $pass){
            if(md5($pass) == $default){
                $_SESSION["trocar_senha"] = 1;
            }
            $checkLogin = $this->login_model->loginAuthentication($email, md5($pass)); 
        }else{
            if(md5($_POST['pass']) == $default){
                $_SESSION["trocar_senha"] = 1;
            }
            $checkLogin = $this->login_model->loginAuthentication($_POST['email'], md5($_POST['pass']));
        }
		
        if ($checkLogin){
            $this->session->set_userdata('backend', $checkLogin);
            $sess_id = $this->session->userdata('backend');

            $array[] = [
                    'session' => $sess_id,
                    'logado' =>  'sim',
                 ];
            $json['data'] = $array;
            echo json_encode($json, true);
        }else{
            $array[] = ['logado' =>  'nao',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }
    }
    public function loginadm($email=null, $pass=null){

        if($email && $pass){
            $checkLogin = $this->login_model->loginAuthenticationAdm($email, $pass); 
        }else{
            $checkLogin = $this->login_model->loginAuthenticationAdm($_POST['email'], $_POST['pass']);
        }
        if ($checkLogin){
            $this->session->set_userdata('backend', $checkLogin);
            $ip = $_SERVER['REMOTE_ADDR'];
            $sess_id = $this->session->userdata('backend');

            $array[] = [
                    'session' => $sess_id,
                    'logado' =>  'sim',
                 ];
            $json['data'] = $array;
            echo json_encode($json, true);
        }else{
            $array[] = ['logado' =>  'nao',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }
    }
    public function logout(){
        unset($_SESSION['backend']);
        redirect(base_url());
    }
    public function logout_adm(){
        unset($_SESSION['backend']);
        redirect('login_adm');
    }
    public function pedir_senha(){

        $hash = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmopqrstuvxyz1234567890', 5)),10,9);

        $this->db->where('email', $_POST['email']);
        $this->db->update('user', array('hash' => $hash));

        $datahash['hash'] = $hash;


        $email = $_POST['email'];

        $from_email = "aluguelfamiliar@gmail.com";
        $to_email = $email;

        $this->load->library('email');
        //Load email library 
        $config = Array(   
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.hostinger.com.br',
            'smtp_port' => 587,
            'smtp_user' => 'contato@aluguelfamiliar.com.br', // change it to yours
            'smtp_pass' => 'Aluguelfamiliar2021', // change it to yours
            'mailtype' => 'html', // text
            'charset' => 'iso-8859-1',
            'newline' => '\r\n',
            'wordwrap' => TRUE
        );
        
        $this->email->initialize($config);

        $this->email->from('contato@aluguelfamiliar.com.br', 'Aluguel Familiar');
        $this->email->to($to_email);
        $this->email->subject('Recuperar Senha');
        $this->email->message(utf8_decode($this->load->view('email_form', $datahash, TRUE)));

        //Send mail 
        if ($this->email->send()){
            $array[] = ['logado' =>  'sim',];
            $json['data'] = $array;
            echo json_encode($json, true);
        }

    }
    public function change_password($hash){
        $query = $this->db->get_where('user', array('hash' => $hash))->result();

        $data['usuario'] = $query;
        $this->load->view('change_pass', $data);

    }
    public function save_new_pass(){
        $default = '202cb962ac59075b964b07152d234b70';
        $funcionario_id   = $_SESSION['backend']['id'];
        $senha             = md5($_POST['senha']);

        $this->db->where('id', $funcionario_id);
        $this->db->update('funcionarios', array('senha'=>$senha));

        if($default != $senha){
            $_SESSION['trocar_senha'] = 0;
        }
        $json['data'] = 1;
        echo json_encode($json, true);

    }
    
}
