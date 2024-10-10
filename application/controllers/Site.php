<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function  __construct() {
        parent::__construct();
		$this->load->model('carrinho_model');
    }

	public function index(){	
		$data['title'] = 'MyThreePi';
	 	// $data['produtos'] = $this->db->get('produtos')->result();
		$qtd = $this->carrinho_model->lista();

		$data['qtd_carrinho'] = count($qtd);
		$this->load->view('index_site', $data);
	}

	public function retorno_pedido(){	
		$data['title'] = 'MyThreePi - Pagamento Confirmado';
		$data['coisas_carrinho'] = $this->carrinho_model->lista();
		
		$data['qtd_carrinho'] = count($data['coisas_carrinho']);
		$this->load->view('retorno_pedido', $data);
	}

	public function carrinho(){	
		$data['title'] = 'Carrinho - MyThreePi';
		$data['coisas_carrinho'] = $this->carrinho_model->lista();
		$total_cart = 0;
		foreach($data['coisas_carrinho'] as $row){
			$total_cart += $row->preco_final;
		}
		$data['qtd_carrinho'] = count($data['coisas_carrinho']);
		$data['total_carrinho'] = $total_cart;
		$this->load->view('carrinho', $data);
	}

	public function add_carrinho(){	
		if(!$_SESSION['carrinho'] || $_SESSION['carrinho'] == ''){
			$_SESSION['carrinho'] = rand(100000, 1000000000);
		}
		if($_POST){
			$this->db->where('status', 0);
			$this->db->where('sessao_id', $_SESSION['carrinho']);
			$carrinho_sessao = $this->db->get('carrinho_temporario');

			if($carrinho_sessao->num_rows() == 0){

				$data = array(
						'sessao_id'         => $_SESSION['carrinho'],
						'product_id'        => $_POST['id'],
						'nome'        		=> $_POST['nome'],
						'preco'             => $_POST['preco'],
						'qtd'             	=> 1,
						'preco_final'       => $_POST['preco']
					);
				$this->db->insert('carrinho_temporario', $data);
				
			}else{

				$this->db->where('status', 0);
				$this->db->where('product_id', $_POST['id']);
				$carrinho_produto = $this->db->get('carrinho_temporario');
				
				if($carrinho_produto->num_rows() == 0){
					$data = array(
						'sessao_id'         => $_SESSION['carrinho'],
						'product_id'        => $_POST['id'],
						'nome'        		=> $_POST['nome'],
						'preco'             => $_POST['preco'],
						'qtd'             	=> 1,
						'preco_final'       => $_POST['preco']
					);
					$this->db->insert('carrinho_temporario', $data);
				}else{
					$this->db->where('product_id', $_POST['id']);
					$this->db->where('status', 0);
					$carrinho_produto = $this->db->get('carrinho_temporario')->result();
					$qtd = $carrinho_produto[0]->qtd;
					$qtd++;
					$id = $carrinho_produto[0]->id;
					$valor_final = ($_POST['preco'] * $qtd);

					$data = array(
						'sessao_id'         => $_SESSION['carrinho'],
						'product_id'        => $_POST['id'],
						'nome'        		=> $_POST['nome'],
						'preco'             => $_POST['preco'],
						'qtd'             	=> $qtd,
						'preco_final'       => $valor_final
					);
					$this->db->where('id', $id);
					$this->db->update('carrinho_temporario', $data);
					
				}
			}
			$data['coisas_carrinho'] = $this->carrinho_model->lista();
			$qtd_cart = count($data['coisas_carrinho']);
			$data_cart['qtd_cart'] = $qtd_cart;
			echo json_encode($qtd_cart, true);
		}
		
	}

	public function edit_carrinho(){	
		if($_POST){
			
			$this->db->where('sessao_id', $_SESSION['carrinho']);
			$this->db->where('product_id', $_POST['id']);
			$this->db->where('status', 0);
			$carrinho_produto = $this->db->get('carrinho_temporario')->result();
			$qtd = $carrinho_produto[0]->qtd;
			$id = $carrinho_produto[0]->id;
			if($_POST['tipo'] == 'tirar'){
				$qtd--;
			}
			if($_POST['tipo'] == 'adicionar'){
				$qtd++;
			}
			if($qtd == 0){
				$this->db->where('id', $id);
				$this->db->where('status', 0);
				$this->db->delete('carrinho_temporario');
				echo json_encode('1');
			}else{
				
				$valor_final = ($carrinho_produto[0]->preco * $qtd);
				$data = array(
					'sessao_id'         => $_SESSION['carrinho'],
					'product_id'        => $_POST['id'],
					'qtd'             	=> $qtd,
					'preco_final'       => $valor_final
				);
				$this->db->where('id', $id);
				$this->db->where('status', 0);
				$this->db->update('carrinho_temporario', $data);
				echo json_encode('1');
			}
			
		}
		
	}

	public function salva_compra(){

		$session_id = $_SESSION['carrinho'];
		$id_transaction = $_POST['id_transaction'];
		$user_id = $_SESSION['backend']['id'];
		$now = time();
		$this->db->where('sessao_id', $session_id);
		$this->db->where('status', 0);
		$carrinho_produto = $this->db->get('carrinho_temporario')->result();
		$total_cart = 0;
		
		foreach($carrinho_produto as $row){

			$total_cart += $row->preco_final;
			$x = 1;
			while ($x <= $row->qtd) {
				$data = array(
					'usuario_id'        => $user_id,
					'session_id'        => $session_id,
					'produto_id'        => $row->product_id,
					'data_compra'       => $now,
					'usando'            => 0
				);
				$this->db->insert('usuario_produto', $data);
				$x++;
			}
		}

		$pedido = array(
			'usuario_id'        => $user_id,
			'sessao_id'         => $session_id,
			'valor_total'       => $total_cart,
			'status'       		=> 'COMPLETED',
			'id_transaction'    => $id_transaction
		);
		$this->db->insert('pedidos', $pedido);


		$data = array(
			'status'         => 1
		);
		$this->db->where('sessao_id', $session_id);
		$this->db->where('status', 0);
		$this->db->update('carrinho_temporario', $data);

		redirect('retorno_pedido/');
	}

}
