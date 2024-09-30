<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frotas extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/frotas_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'frotas';
        $data['frotas'] = $this->frotas_model->lista_frotas();

        $this->load->view('admin/frotas', $data);
	}

    public function edit_frota($frota_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar frota';
        $data['frota'] = $this->frotas_model->get_frota_by_id($frota_id);
        $data['id_frota'] = $frota_id;

        $this->load->view('admin/edit_frota', $data);
    }

    public function altera_status(){

        $data = array(
            'status'   => $_POST['status']
        );
        $this->db->where('id', $_POST['id']);
        $this->db->update('frotas', $data);
        echo json_encode($_POST['status']);
    }

    public function edit_frota_gravar(){
        $id_frota = $_POST['id'];
        // p($_POST);
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

        $uploadPath = "./assets/frotas/"; 
 
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
			$this->db->where('id', $id_frota);
			$this->db->update('frotas', $data);
        }
        // exit;
        $this->frotas_model->edit_frota($this->input->post(), $id_frota);
        
        redirect('admin/frotas/edit_frota/'.$id_frota);
    }

    public function add_frota(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar frota';

        $this->load->view('admin/add_frota', $data);
    }

    public function resetar_senha(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar frota';

        $this->load->view('admin/resetar_senha', $data);
    }

    public function add_frota_gravar(){

        // p($_POST);

        $frota = array(
		    'nome'          => $_POST['nome'],
			'status'        => ($_POST['status'] ? 1 : 0),
			'patrimonio'          => $_POST['patrimonio'],
			'modelo'       => $_POST['modelo'],
			'ano'         => $_POST['ano'],
			'perfuratriz'         => $_POST['perfuratriz'],
			'cor'      => $_POST['cor'],
			'placa'         => $_POST['placa'],
			'combustivel'  => $_POST['combustivel'],
			'tipo'      => $_POST['tipo'],
			'airtag'      => $_POST['airtag'],
			'seguro'      => $_POST['seguro'],
			'numero_seguro'        => $_POST['numero_seguro'],
			'vigente'        => $_POST['vigente']
        );

        $id_frota = $this->frotas_model->add_frota_gravar($frota);
        
        $uploadPath = "./assets/frotas/"; 
 
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
			$this->db->where('id', $id_frota);
			$this->db->update('frotas', $data);
        }

        redirect('admin/frotas/edit_frota/'.$id_frota);
    }

    public function resetar_senha_gravar(){

        $id = $_SESSION['backend']['id'];
        $senha = array(
            'senha'         => md5($_POST['password'])
        );

        $this->frotas_model->resetar_senha_gravar($senha, $id);
    
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

