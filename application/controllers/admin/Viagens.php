<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viagens extends CI_Controller {

	public function __construct()	
	{
		parent::__construct();
		$this->load->model('admin/viagem_model');
	}
	public function index(){   
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Minhas viagens';
        $data['viagens'] = $this->viagem_model->lista_viagens();

        $this->load->view('admin/viagens', $data);
	}

    public function add_viagens(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id = $_SESSION['backend']['id'];
		$data['title'] = 'Adicionar viagem';

        $this->load->view('admin/add_viagens', $data);
    }

    public function add_viagem_gravar(){
        $id = $_SESSION['backend']['id'];
        $viagem = array(
                'origem'        => $_POST['origem'],
                'destino'       => $_POST['destino'],
                'data'          => strtotime($_POST['data']),
                'id_usuario'    => $id
            );
        $data = $this->viagem_model->add_viagem_gravar($viagem);
        redirect('admin/viagens');
    }
    public function edit_viagem_gravar(){
        $id_viagem = $_POST['id'];
        $viagem = array(
            'origem'        => $_POST['origem'],
            'destino'       => $_POST['destino'],
            'data'          => strtotime($_POST['data'])
        );
        $data = $this->viagem_model->edit_viagem_gravar($viagem, $id_viagem);
        redirect('admin/edit_viagem/'.$id_viagem);
    }

    public function edit_viagem($viagem_id){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $user_id = $_SESSION['backend']['id'];
        $data['title'] = 'Editar minha viagem';
        $data['tipo_mala'] = $this->viagem_model->get_tipo_mala();
        $data['estilo_mala'] = $this->viagem_model->get_estilo_mala();
        $data['malas'] = $this->viagem_model->get_malas_usuario_viagem($viagem_id,$user_id);
        $data['viagem'] = $this->viagem_model->viagem_by_id($viagem_id,$user_id);
        $data['id_viagem'] = $viagem_id;

        $this->load->view('admin/edit_viagem', $data);
    }

    public function edit_bag(){
        $id = $_POST['id_mala'];
        $data['mala'] = $this->viagem_model->get_mala_by_id($id);
        echo json_encode($data['mala'][0]);
    }

    public function edit_bag_gravar(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id_usuario = $_SESSION['backend']['id'];
        $id_mala = $_POST['id_mala'];
        $id_viagem = $_POST['id_viagem'];

        $this->viagem_model->edit_bag($this->input->post(), $id_usuario, $id_mala);
        redirect('admin/edit_viagem/'.$id_viagem);
    }

    public function add_bag(){
        if (!isset($_SESSION['backend']['currentSessionId'])) {
            redirect('admin');
        }
        $id_usuario = $_SESSION['backend']['id'];
        $id_viagem = $_POST['id_viagem'];

        $this->viagem_model->add_bag($this->input->post(), $id_usuario, $id_viagem);
        redirect('admin/edit_viagem/'.$id_viagem);
        

        // if( $_FILES['file']['tmp_name'] ) {
        //         if($_FILES['file']['size'] > 52428800) { //10 MB (size is also in bytes)
        //         $data['error_message'] = "Image is too big.";
        //     } else {
        //          $this->viagem_model->add_bag($this->input->post(), $id_usuario, $id_viagem);
        //     }
        // }

		// $data['title'] = 'Adicionar viagem';

        // $this->load->view('admin/edit_viagem', $data);
    }

    public function gerar_pdf($id_viagem, $id_mala){
        $user_id = $_SESSION['backend']['id'];
        require 'vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf(['enable_remote' => true]); 
        
        $this->db->select('malas.*,estilo_mala.nome as estilo_mala, tipo_mala.nome as tipo_mala');
		$this->db->from('malas');
        $this->db->join('estilo_mala', 'estilo_mala.id = malas.estilo_mala');
        $this->db->join('tipo_mala', 'tipo_mala.id = malas.tipo_mala');
		$this->db->where('malas.id', $id_mala);
		$this->db->where('malas.id', $id_mala);
        $data_mala = $this->db->get()->result();
        if(count($data_mala) == 0){
            echo 'Não encontramos  esta viagem.';exit;
        }
        $data_viagem = $this->db->get_where('viagens', array('id' => $id_viagem, 'id_usuario' => $user_id))->result();
        if(count($data_viagem) == 0){
            echo 'Não encontramos  esta viagem.';exit;
        }

        if($data_mala[0]->foto_mala_fechada !== null){
            $foto_mala_fechada = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_mala_fechada.'" width="150">';
        }else{
            $foto_mala_fechada = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
        }

        if($data_mala[0]->foto_mala_pronta !== null){
            $foto_mala_pronta = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_mala_pronta.'" width="150">';
        }else{
            $foto_mala_pronta = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
        }   

        if($data_mala[0]->foto_fiscal !== null){
            $foto_fiscal = '<img src="'.base_url().'/assets/malas/'.$data_mala[0]->foto_fiscal.'" width="150">';
        }else{
            $foto_fiscal = '<img src="'.base_url().'/assets/malas/sem_imagem.jpg" width="150">';
        }




        // echo '<pre>';print_r($data_mala[0]);exit;

        $dados = '<div style="margin: 0 auto;text-align: center;">
                <style>h3{margin-bottom: 5px}*{font-family:sans-serif}</style>            
        ';
            $dados .= '<img src="'.base_url().'/assets/img/logo.png" width="150">';
            $dados .= '<h1>Registro da sua mala</h1>';
            $dados .= '<p style="margin:-10px !important">'.date('d/m/Y', $data_viagem[0]->data).'</p>';
            $dados .= '<h3>'.$data_viagem[0]->origem.' '.' -> '.' '.$data_viagem[0]->destino.'</h3>';
        $dados .= '</div>';
        $dados .= '<div>';
            $dados .='<h3>Marca da mala:</h3>';
            $dados .=$data_mala[0]->marca_mala.'<hr>';

            $dados .='<h3>Cor da mala:</h3>';
            $dados .=$data_mala[0]->cor_mala.'<hr>';

            $dados .='<h3>Tamanho da mala:</h3>';
            $dados .=$data_mala[0]->tamanho_mala.'<hr>';

            $dados .='<h3>Peso da mala:</h3>';
            $dados .=$data_mala[0]->peso_mala.'<hr>';

            $dados .='<h3>Tipo da mala:</h3>';
            $dados .=$data_mala[0]->tipo_mala.'<hr>';

            $dados .='<h3>Estilo da mala:</h3>';
            $dados .=$data_mala[0]->estilo_mala.'<hr>';

            $dados .='<h3>Conteúdo da mala:</h3>';
            $dados .=$data_mala[0]->conteudo_mala.'<hr>';

            $dados .='<h3>Valor da mala:</h3>';
            $dados .=$data_mala[0]->valor_mala.'<hr>';

            $dados .='<h3>FOTOS:</h3>';
            $dados .= '<table style="width:100%">
                        <thead>
                            <tr>
                            <th>Foto da mala fechada</th>
                            <th>Foto da mala Pronta</th>
                            <th>Foto do cupom Fiscal</th>
                            </tr>
                        </thead>
                        <tr>';
            $dados .= '<td style="text-align: center;">'.$foto_mala_fechada.'</td>';
            $dados .= '<td style="text-align: center;">'.$foto_mala_pronta.'</td>';
            $dados .= '<td style="text-align: center;">'.$foto_fiscal.'</td>';
            $dados .= ' </tr>
                       </table>';
        $dados .= '</div>';

        $dompdf->loadHtml($dados);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // $dompdf->stream();
        header('Content-type: application/pdf');
        echo $dompdf->output();

    }
    
}

