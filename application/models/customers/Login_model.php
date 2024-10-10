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

	public function loginAuthentication($mail, $pass)
	{
		$query = $this->db->get_where('usuarios', array('email' => $mail, 'senha' => $pass, 'status' => 1 ))->result();
		if (isset($query[0]->id)) {
			$currentSession = session_id();
			$clintIpAddress = $this->get_client_ip_server();
			$currentTime = time();

			$session_data = array(
				'id' => $query[0]->id,
				'nome' => $query[0]->nome,
				'sobrenome' => $query[0]->sobrenome,
				'currentSessionId' => $currentSession,
				'clintIpAddress' => $clintIpAddress,
				'currentTime' => $currentTime,
			);

			return $session_data;
		} else {
			return false;
		}
	}
	public function loginAuthenticationAdm($mail, $pass)
	{
		$query = $this->db->get_where('admin', array('email' => $mail, 'password' => $pass))->result();

		if (isset($query[0]->id)) {
			$currentSession = session_id();
			$clintIpAddress = $this->get_client_ip_server();
			$currentTime = time();

			$session_data = array(
				'userid' => $query[0]->id,
				'currentSessionId' => $currentSession,
				'clintIpAddress' => $clintIpAddress,
				'currentTime' => $currentTime,
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
