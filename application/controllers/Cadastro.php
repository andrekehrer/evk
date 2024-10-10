<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('customers/login_model');
        $this->load->model('customers/usuario_model');
        $this->load->library('paypal_lib');
	}

	public function index(){
        $data['title'] = 'Faça seu cadastro';
		$this->load->view('form_cadastro', $data);
	}

    function buy(){

        //Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url
        //get particular product data
        // $product = $this->product->getRows($id);
        $userID = 1; //current user id
        $logo = base_url().'assets/images/logo.png';

        
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'Test');
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  3);
        $this->paypal_lib->add_field('amount',  10);        
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
    }

	public function salvar_cadastro(){
        
        $email = $_POST['email'];
        $exist_user = $this->usuario_model->check_user_exist($email);
        if($exist_user == 0){
            $bytes = openssl_random_pseudo_bytes(32);
		    $hash = base64_encode($bytes);
		    $hash = str_replace('+', '', $hash);
		    $hash = str_replace('=', '', $hash);
		    $hash = str_replace('/', '', $hash);
		    $hash = str_replace('|', '', $hash);
            $senha = md5($_POST['senha']);
            
            $data_usuario = array(
                'nome' =>  $_POST['nome'],
                'email' => $_POST['email'],
                'sobrenome' => $_POST['sobrenome'],
                'telefone' => $_POST['telefone'],
                'endereco' => $_POST['endereco'],
                'end_continuacao' => $_POST['end_continuacao'],
                'cidade' => $_POST['cidade'],
                'estado' => $_POST['estado'],
                'cep' => $_POST['cep'],
                'senha' => $senha ,
                'hash' => $hash,
                'status' =>  1
            );
            $add_user = $this->usuario_model->add_user($data_usuario);
            if($add_user == 1){
                //////// Enviar email de liberacao de cadastro ////////
                $message = '
                        <html>
                            <head>
                                <title>MyThreePi - Ative sua conta!</title>
                            </head>
                            <body>
                                <table cellspacing="0" style="border: 1px solid #000000;width: 50%;padding: 20px;">
                                    <tr><p>Ola!</p></tr>
                                    <tr><p>Click <a href="'.base_url().'/active_account.php?hash='.$hash.'">aqui</a> Para ativar sua conta!</p></tr>
                                    <tr><p>E-mail gerado automaticamente.</p></tr>
                                    <tr><img src="https://tag.andrekehrer.com/assets/img/logo.png" width="100%"></tr>
                                    <p style="font-size: 10px;margin: 0 auto;width: 178px;">MyThreePi | 020 1233 1233</p>
                                </table>
                            </body>
                        </html>';
                $from_email = "drekehrer@gmail.com";
                //Load email library
                $this->load->library('email');
                $this->email->from($from_email, 'MyThreePi');
                $this->email->to($email);
                $this->email->subject('Ative seu cadastro');
                $this->email->message($message);
                $this->email->set_mailtype("html");
                //Send mail
                $this->email->send();


                header('Content-Type: application/json');
                echo json_encode(array('cad' => '1','msg' => 'Sucesso'),true);
                ////////////////////////////////////////////////////////


                //// LOGAR O USUARIO
                // $checkLogin = $this->login_model->loginAuthentication($_POST['email'], $_POST['senha']);
                
                // if ($checkLogin){
                //     $this->session->set_userdata('backend', $checkLogin);

                // }
                ////////////////////////////////////////////////////////
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array('cad' => '0','msg' => 'Usuário já cadastrado! Faça seu login!'),true);
        }

	}

}
