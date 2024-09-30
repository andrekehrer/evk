<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/cliente_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Clientes';
        $data['clientes'] = $this->cliente_model->lista_clientes();

        $this->load->view('admin/clientes', $data);
	}

    public function edit_cliente($cliente_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar cliente';
        $data['cliente'] = $this->cliente_model->get_cliente_by_id($cliente_id);
        $data['id_cliente'] = $cliente_id;

        $this->load->view('admin/edit_cliente', $data);
    }

    function convert_filesize($bytes, $decimals = 2) { 
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB'); 
        $factor = floor((strlen($bytes) - 1) / 3); 
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor]; 
    }

    function compressImage($source, $destination, $quality) { 

        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
         
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
        imagejpeg($image, $destination, $quality); 
        
        return $destination; 
    }
    
    public function edit_cliente_gravar(){
        $id_cliente = $_POST['id'];
        // p($_POST);
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }

       
        $uploadPath = "./assets/clientes/"; 
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
			$this->db->where('id', $id_cliente);
			$this->db->update('clientes', $data);
        }
        // exit;
        $this->cliente_model->edit_cliente($this->input->post(), $id_cliente);
        
        redirect('admin/clientes/edit_cliente/'.$id_cliente);
    }

    public function add_cliente(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar cliente';

        $this->load->view('admin/add_cliente', $data);
    }

    public function resetar_senha(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar cliente';

        $this->load->view('admin/resetar_senha', $data);
    }

    public function add_cliente_gravar(){

        // p($_POST);
        $cliente = array(
		    'nome'          => $_POST['nome'],
			'status'        => ($_POST['status'] ? 1 : 0),
			'cnpj'          => $_POST['cnpj'],
			'contato'       => $_POST['contato'],
			'email'         => $_POST['email'],
			'registro'      => $_POST['registro'],
			'cargo'         => $_POST['cargo'],
			'razao_social'  => $_POST['razao_social'],
			'telefone'      => $_POST['telefone'],
			'endereco'      => $_POST['endereco'],
            'numero'      	=> $_POST['numero'],
			'bairro'      	=> $_POST['bairro'],
			'cidade'        => $_POST['cidade'],
			'estado'        => $_POST['estado'],
			'cep'           => $_POST['CEP'],
        );

        $id_cliente = $this->cliente_model->add_cliente_gravar($cliente);
    
        redirect('admin/clientes');
    }

    public function resetar_senha_gravar(){

        $id = $_SESSION['backend']['id'];
        $senha = array(
            'senha'         => md5($_POST['password'])
        );

        $this->cliente_model->resetar_senha_gravar($senha, $id);
    
        redirect('admin/dashboard/');
    }

    // public function edit_cliente_gravar(){
    //     $id_cliente = $_POST['id'];
    //     $cliente = array(
    //         'origem'        => $_POST['origem'],
    //         'destino'       => $_POST['destino'],
    //         'data'          => strtotime($_POST['data'])
    //     );
    //     $data = $this->cliente_model->edit_cliente_gravar($cliente, $id_cliente);
    //     redirect('admin/edit_cliente/'.$id_cliente);
    // }

    // public function edit_cliente($cliente_id){
    //     if (!isset($_SESSION['backend']['currentSessionId'])) {
    //         redirect('admin');
    //     }
        
    //     $user_id = $_SESSION['backend']['id'];
    //     $data['title'] = 'Editar minha cliente';
    //     $data['cliente'] = $this->cliente_model->get_cliente_by_id($cliente_id);
    //     $data['id_cliente'] = $cliente_id;

    //     $this->load->view('admin/edit_cliente', $data);
    // }

    // public function edit_bag(){
    //     $id = $_POST['id_mala'];
    //     $data['mala'] = $this->cliente_model->get_mala_by_id($id);
    //     echo json_encode($data['mala'][0]);
    // }

    // public function edit_bag_gravar(){
    //     if (!isset($_SESSION['backend']['currentSessionId'])) {
    //         redirect('admin');
    //     }
    //     $id_usuario = $_SESSION['backend']['id'];
    //     $id_mala = $_POST['id_mala'];
    //     $id_cliente = $_POST['id_cliente'];

    //     $this->cliente_model->edit_bag($this->input->post(), $id_usuario, $id_mala);
    //     redirect('admin/edit_cliente/'.$id_cliente);
    // }

    // public function edit_foto(){
    //     // if (!isset($_SESSION['backend']['currentSessionId'])) {
    //     //     redirect('admin');
    //     // }
    //     p($_POST);
    //     $id_cliente = $_POST['id_cliente'];

    //     $this->cliente_model->add_bag($this->input->post(), $id_usuario, $id_cliente);
    //     redirect('admin/edit_cliente/'.$id_cliente);
        

    //     if( $_FILES['file']['tmp_name'] ) {
    //             if($_FILES['file']['size'] > 52428800) { //10 MB (size is also in bytes)
    //             $data['error_message'] = "Image is too big.";
    //         } else {
    //              $this->cliente_model->add_bag($this->input->post(), $id_usuario, $id_cliente);
    //         }
    //     }

	// 	$data['title'] = 'Adicionar cliente';

    //     $this->load->view('admin/edit_cliente', $data);
    // }

    // public function gerar_pdf($id_cliente, $id_mala){
    //     $user_id = $_SESSION['backend']['id'];
    //     require 'vendor/autoload.php';
    //     $dompdf = new Dompdf\Dompdf(['enable_remote' => true]); 
        
    //     $this->db->select('malas.*,estilo_mala.nome as estilo_mala, tipo_mala.nome as tipo_mala');
	// 	$this->db->from('malas');
    //     $this->db->join('estilo_mala', 'estilo_mala.id = malas.estilo_mala');
    //     $this->db->join('tipo_mala', 'tipo_mala.id = malas.tipo_mala');
	// 	$this->db->where('malas.id', $id_mala);
	// 	$this->db->where('malas.id', $id_mala);
    //     $data_mala = $this->db->get()->result();
    //     if(count($data_mala) == 0){
    //         echo 'Não encontramos  esta cliente.';exit;
    //     }
    //     $data_cliente = $this->db->get_where('clientes', array('id' => $id_cliente, 'id_usuario' => $user_id))->result();
    //     if(count($data_cliente) == 0){
    //         echo 'Não encontramos  esta cliente.';exit;
    //     }

    //     if($data_mala[0]->foto_mala_fechada !== null){
    //         $foto_mala_fechada = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_mala_fechada.'" width="150">';
    //     }else{
    //         $foto_mala_fechada = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
    //     }

    //     if($data_mala[0]->foto_mala_pronta !== null){
    //         $foto_mala_pronta = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_mala_pronta.'" width="150">';
    //     }else{
    //         $foto_mala_pronta = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
    //     }   

    //     if($data_mala[0]->foto_fiscal !== null){
    //         $foto_fiscal = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_fiscal.'" width="150">';
    //     }else{
    //         $foto_fiscal = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
    //     }




    //     // echo '<pre>';print_r($data_mala[0]);exit;

    //     $dados = '<div style="margin: 0 auto;text-align: center;">
    //             <style>h3{margin-bottom: 5px}*{font-family:sans-serif}</style>            
    //     ';
    //         $dados .= '<img src="'.base_url().'/assets/img/logo.png" width="150">';
    //         $dados .= '<h1>Registro da sua mala</h1>';
    //         $dados .= '<p style="margin:-10px !important">'.date('d/m/Y', $data_cliente[0]->data).'</p>';
    //         $dados .= '<h3>'.$data_cliente[0]->origem.' '.' -> '.' '.$data_cliente[0]->destino.'</h3>';
    //     $dados .= '</div>';
    //     $dados .= '<div>';
    //         $dados .='<h3>Marca da mala:</h3>';
    //         $dados .=$data_mala[0]->marca_mala.'<hr>';

    //         $dados .='<h3>Cor da mala:</h3>';
    //         $dados .=$data_mala[0]->cor_mala.'<hr>';

    //         $dados .='<h3>Tamanho da mala:</h3>';
    //         $dados .=$data_mala[0]->tamanho_mala.'<hr>';

    //         $dados .='<h3>Peso da mala:</h3>';
    //         $dados .=$data_mala[0]->peso_mala.'<hr>';

    //         $dados .='<h3>Tipo da mala:</h3>';
    //         $dados .=$data_mala[0]->tipo_mala.'<hr>';

    //         $dados .='<h3>Estilo da mala:</h3>';
    //         $dados .=$data_mala[0]->estilo_mala.'<hr>';

    //         $dados .='<h3>Conteúdo da mala:</h3>';
    //         $dados .=$data_mala[0]->conteudo_mala.'<hr>';

    //         $dados .='<h3>Valor da mala:</h3>';
    //         $dados .=$data_mala[0]->valor_mala.'<hr>';

    //         $dados .='<h3>FOTOS:</h3>';
    //         $dados .= '<table style="width:100%">
    //                     <thead>
    //                         <tr>
    //                         <th>Foto da mala fechada</th>
    //                         <th>Foto da mala Pronta</th>
    //                         <th>Foto do cupom Fiscal</th>
    //                         </tr>
    //                     </thead>
    //                     <tr>';
    //         $dados .= '<td style="text-align: center;">'.$foto_mala_fechada.'</td>';
    //         $dados .= '<td style="text-align: center;">'.$foto_mala_pronta.'</td>';
    //         $dados .= '<td style="text-align: center;">'.$foto_fiscal.'</td>';
    //         $dados .= ' </tr>
    //                    </table>';
    //     $dados .= '</div>';

    //     $dompdf->loadHtml($dados);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     // $dompdf->stream();
    //     header('Content-type: application/pdf');
    //     echo $dompdf->output();

    // }
    
}

