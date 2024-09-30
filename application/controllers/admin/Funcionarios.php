<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Funcionarios extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/funcionarios_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Funcionarios';
        $data['funcionarios'] = $this->funcionarios_model->lista_funcionarios();

        $this->load->view('admin/funcionarios', $data);
	}

    public function funcionarios_ativo(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Funcionarios';
        $data['funcionarios'] = $this->funcionarios_model->lista_funcionarios_ativos();

        $this->load->view('admin/funcionarios_ativo', $data);
	}

    public function alterar_senha(){   

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }  

        $data = array(
            'senha'   => md5(123)
        );

        $this->db->where('id', $_POST['id_']);
		$this->db->update('funcionarios', $data);

        redirect('admin/funcionarios/funcionarios_ativo/');
       
	}

    public function funcionarios_desativados(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Funcionarios';
        $data['funcionarios'] = $this->funcionarios_model->lista_funcionarios_desativados();

        $this->load->view('admin/funcionarios_desativados', $data);
	}

    public function edit_funcionario($funcionario_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha funcionario';
        $data['funcionario'] = $this->funcionarios_model->get_funcionario_by_id($funcionario_id);
        $data['id_funcionario'] = $funcionario_id;

        $this->load->view('admin/edit_funcionario', $data);
    }

    public function export_funcionario($funcionario_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha funcionario';
        $data['funcionario'] = $this->funcionarios_model->get_funcionario_by_id($funcionario_id);
        $data['id_funcionario'] = $funcionario_id;

        $html = $this->load->view('admin/export_funcionario', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML( $html);
        $mpdf->Output();
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

    public function edit_funcionario_gravar(){
        $id_funcionario = $_POST['id'];

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $uploadPath = "./assets/funcionarios/"; 
 
        $statusMsg = ''; 
        $status = 'danger'; 
    
        if(!empty($_FILES["mudar_foto"]["name"])) { 

            $str = $_FILES["mudar_foto"]["name"];
            $new_str = str_replace('-', '', $str);
            $fileName = str_replace(' ', '', $new_str);
            $fileName = time().$fileName;
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
            
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $imageTemp = $_FILES["mudar_foto"]["tmp_name"]; 
                $imageSize = $this->convert_filesize($_FILES["mudar_foto"]["size"]); 
                $compressedImage = $this->compressImage($imageTemp, $imageUploadPath, 50); 
                if($compressedImage){ 
                    $compressedImageSize = filesize($compressedImage); 
                    $compressedImageSize = $this->convert_filesize($compressedImageSize); 
                    
                    $status = 1; 
                    $statusMsg = "Image compressed successfully."; 
                }else{ 
                    $statusMsg = "Image compress failed!"; 
                } 
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        }
        if($status == 1){
            $data = array(
				'foto'   => $fileName
			);
			$this->db->where('id', $id_funcionario);
			$this->db->update('funcionarios', $data);
        }
        $this->funcionarios_model->edit_funcionario($this->input->post(), $id_funcionario);
        redirect('admin/funcionarios/edit_funcionario/'.$id_funcionario);
    }

    public function add_funcionario(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar funcionario';

        $this->load->view('admin/add_funcionario', $data);
    }

    public function resetar_senha(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar funcionario';

        $this->load->view('admin/resetar_senha', $data);
    }

    public function add_funcionario_gravar(){

        // p($_POST);
        $funcionario = array(
		    'nome'          => $_POST['nome'],
			'status'        => ($_POST['status'] ? 1 : 0),
			'sobrenome'     => $_POST['sobrenome'],
			'telefone'      => $_POST['telefone'],
			'email'         => $_POST['email'],
			'aso'           => strtotime($_POST['aso']),
			'CPF'           => $_POST['CPF'],
			'RG'            => $_POST['RG'],
			'admissao'      => strtotime($_POST['admissao']),
			'CBO'           => $_POST['CBO'],
			'cargo'         => $_POST['cargo'],
			'registro'      => $_POST['registro'],
			'endereco'      => $_POST['endereco'],
            'numero'      	=> $_POST['numero'],
			'bairro'      	=> $_POST['bairro'],
			'cidade'        => $_POST['cidade'],
			'estado'        => $_POST['estado'],
			'cep'           => $_POST['CEP'],
			'permissao'     => $_POST['permissao'],
            'senha'         => md5($_POST['password']),
			'dob'           => strtotime($_POST['dob']),
        );

        $id_funcionario = $this->funcionarios_model->add_funcionario_gravar($funcionario);
        if($_FILES['mudar_foto']['tmp_name']) {

            // p($image);
		
                
            // if($_FILES['mudar_foto']['size'] > 52428800) {
            // $data['error_message'] = "Image is too big.";
            // } else {
            //     $this->funcionarios_model->alterar_imagem($this->input->post(), $id_funcionario);
            // }
            $this->funcionarios_model->alterar_imagem($this->input->post(), $id_funcionario);

        }
        redirect('admin/funcionarios');
    }

    public function resetar_senha_gravar(){

        $id = $_SESSION['backend']['id'];
        $senha = array(
            'senha'         => md5($_POST['password'])
        );

        $this->funcionarios_model->resetar_senha_gravar($senha, $id);
    
        redirect('admin/dashboard/');
    }
    
}

