<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamentos extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/equipamentos_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'equipamentos';
        $data['equipamentos'] = $this->equipamentos_model->lista_equipamentos();

        $this->load->view('admin/equipamentos', $data);
	}

    public function edit_equipamento($equipamento_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar equipamento';
        $data['equipamento'] = $this->equipamentos_model->get_equipamento_by_id($equipamento_id);
        $data['id_equipamento'] = $equipamento_id;

        $this->load->view('admin/edit_equipamento', $data);
    }

    public function edit_equipamento_gravar(){
        $id_equipamento = $_POST['id'];

        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $uploadPath = "./assets/equipamentos/"; 
 
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
			$this->db->where('id', $id_equipamento);
			$this->db->update('equipamentos', $data);
        }
        // exit;
        $this->equipamentos_model->edit_equipamento($this->input->post(), $id_equipamento);
        
        redirect('admin/equipamentos/edit_equipamento/'.$id_equipamento);
    }

    public function add_equipamento(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar equipamento';

        $this->load->view('admin/add_equipamento', $data);
    }

    public function resetar_senha(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar equipamento';

        $this->load->view('admin/resetar_senha', $data);
    }

    public function add_equipamento_gravar(){

        $equipamento = array(
		    'nome'              => $_POST['nome'],
		    'proprietario'      => $_POST['proprietario'],
		    'cnpj'              => $_POST['cnpj'],
		    'seguro'            => $_POST['seguro'],
		    'vigencia'          => $_POST['vigencia'],
			'status'            => ($_POST['status'] ? 1 : 0),
			'patrimonio'        => $_POST['patrimonio'],
			'fabricante'        => $_POST['fabricante'],
			'ano'               => $_POST['ano'],
			'cor'               => $_POST['cor'],
			'chassi'            => $_POST['chassi'],
			'renavam'           => $_POST['renavam']
        );

        $id_equipamento = $this->equipamentos_model->add_equipamento_gravar($equipamento);

        $uploadPath = "./assets/equipamentos/"; 
 
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
			$this->db->where('id', $id_equipamento);
			$this->db->update('equipamentos', $data);
        }
    
        redirect('admin/equipamentos/edit_equipamento/'.$id_equipamento);
    }

    public function resetar_senha_gravar(){

        $id = $_SESSION['backend']['id'];
        $senha = array(
            'senha'         => md5($_POST['password'])
        );

        $this->equipamentos_model->resetar_senha_gravar($senha, $id);
    
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

