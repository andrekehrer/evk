<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return;
	}

	public function alt_senha($id, $pass){
		$frota = array(
		    'senha'          => $pass
        );
        // echo '<pre>';print_r($data);exit;
		$this->db->where('id', $id);
		$this->db->update('funcionarios', $frota);
		if ($this->db->affected_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
	}

	public function loginAuthentication($mail, $pass)
	{
		// $query = $this->db->get_where('usuarios', array('email' => $mail, 'senha' => $pass, 'status' => 1 ))->result();

		// $query = $this->db->get_where('funcionarios', array('email' => $mail, 'senha' => $pass, 'status' => 1, 'permissao' => 1, 'permissao' => 2))->result();

        $this->db->select('*');
		$this->db->from('funcionarios');
		$this->db->where('email', $mail);
		$this->db->where('senha', $pass);
		$this->db->where('status', 1);

		$query = $this->db->get()->result();

		if (isset($query[0]->id)) {
		// if ($mail == 'admin' && $pass = 123) {
			$currentSession = session_id();
			// $clintIpAddress = $this->get_client_ip_server();
			$currentTime = time();

			$session_data = array(
				'id' 				=> $query[0]->id,
				'nome' 				=> $query[0]->nome,
				'permissao' 		=> $query[0]->permissao,
				'motorista' 		=> $query[0]->motorista,
				'sobrenome' 		=> $query[0]->sobrenome,
				'foto' 				=> $query[0]->foto,
				'currentSessionId'  => $currentSession,
				'currentTime' 		=> $currentTime,
			);

			return $session_data;
		} else {
			return false;
		}
	}
	
	public function checkemail($nome,$sobrenome,$insta,$quer, $mail, $pass)
	{	
		$query = $this->db->get_where('admin', array('email' => $mail))->result();
		if (isset($query[0]->id)) {
			return 1;
		} else {
			$data = array(
				'nome'  =>  $nome,
				'sobrenome' =>  $sobrenome,
				'instagram' =>  $insta,
				'email' =>  $mail,
				'password' =>  $pass,
				'querreceber' =>  $quer
			);
			$this->db->insert('user', $data);

			$session_data = array(
				'sobrenome' => $sobrenome,
			);
			$this->session->set_userdata('backend', $session_data);
			return 0;
		}
	}
	function get_client_ip_server()
	{
		$ipaddress = '';
		if ($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}
}
