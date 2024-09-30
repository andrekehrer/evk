<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/produtos_model');
        $this->load->library('upload'); 
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'produtos';
        $data['produtos'] = $this->produtos_model->lista_produtos();

        $this->load->view('admin/produtos', $data);
	}

    public function edit_produto($produto_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar produto';
        $data['produto'] = $this->produtos_model->get_produto_by_id($produto_id);
        $data['id_produto'] = $produto_id;

        $this->load->view('admin/edit_produto', $data);
    }

    public function edit_produto_gravar(){
        $id_produto = $_POST['id'];

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        
        if($_FILES['mudar_foto']['name']){
            $str = $_FILES['mudar_foto']['name'];
            $new_str = str_replace('-', '', $str);
            $new = str_replace(' ', '', $new_str);
            $newFilePath = "./assets/produtos/" . $new;

            if(move_uploaded_file($_FILES['mudar_foto']['tmp_name'], $newFilePath)){
            	$data = array('anexo' => $new);
            	$this->db->where('id', $id_produto);
            	$this->db->update('produtos', $data);
            }
        }

        $this->produtos_model->edit_produto($this->input->post(), $id_produto);
        
        redirect('admin/produtos/edit_produto/'.$id_produto);
    }

    public function add_produto(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar produto';

        $this->load->view('admin/add_produto', $data);
    }

    public function resetar_senha(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar produto';

        $this->load->view('admin/resetar_senha', $data);
    }

    public function add_produto_gravar(){

        $produto = array(
		    'nome'              => $_POST['nome'],
			'fabricante'        => $_POST['fabricante'],
		    'unidade'           => $_POST['unidade'],
			'status'            => ($_POST['status'] ? 1 : 0)
        );

        $id_produto = $this->produtos_model->add_produto_gravar($produto);
    
        redirect('admin/produtos/edit_produto/'.$id_produto);
    }

    public function resetar_senha_gravar(){

        $id = $_SESSION['backend']['id'];
        $senha = array(
            'senha'         => md5($_POST['password'])
        );

        $this->produtos_model->resetar_senha_gravar($senha, $id);
    
        redirect('admin/dashboard/');
    }
    function convert_filesize($bytes, $decimals = 2) { 
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB'); 
        $factor = floor((strlen($bytes) - 1) / 3); 
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor]; 
    }

    function compressImage($source, $destination, $quality) { 
        // Get image info 
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
         
        // Create a new image from file 
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
        } 
         
        // Save image 
        imagejpeg($image, $destination, $quality); 
         
        // Return compressed image 
        return $destination; 
    }
}

