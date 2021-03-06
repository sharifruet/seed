<?php
class Login extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		$this->load->model ( 'codemodel' );
		// $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		// $this->output->set_header('Pragma: no-cache');
	}
	public function index() {
		if ($this->session->userdata ( 'username' ) != FALSE) {
			redirect ( base_url () . 'home/dashboard', 'refresh' );
		}
		$data ['title'] = ucfirst ( 'login' ); // Capitalize the first letter
		$data ['errormsg'] = '';
		$this->load->view ( 'login.php', $data );
	}
	public function four_zero_four() {
		$data ['title'] = '404';
		$this->load->view ( '404.php', $data );
	}
	public function authenticate() {
		$data ['title'] = ucfirst ( 'login' ); // Capitalize the first letter
		$data ['errormsg'] = '';
		$password = $this->input->post ( 'password' );
		$username = $this->input->post ( 'username' );
		$ret = $this->login ( $username, $password );

		if ($ret == false) {
			$data ['title'] = ucfirst ( 'login' ); // Capitalize the first lette
			$data ['errormsg'] = 'Invalid userid / password.';
			$this->load->view ( 'login.php', $data );
		} else {
			redirect ( base_url () . 'home/dashboard', 'refresh' );
		}
	}
	private function login($username, $password) {
		$ret = $this->validateUser ( $username, $password );
		if ($ret != null) {
			$this->session->set_userdata ( Applicationconst::SESSION_USERNAME, $username );
			$this->session->set_userdata ( Applicationconst::SESSION_USER_ID, $ret->componentId );
			$this->session->set_userdata ( Applicationconst::SESSION_USER_DISPLAY_NAME, $ret->firstName.' '.$ret->lastName );
			$this->session->set_userdata ( Applicationconst::SESSION_USER_TYPE, $ret->type );

			$query = $this->db->query ( "SELECT * FROM vuserfunctions WHERE userid = " . $ret->componentId . " ORDER BY codeNumber " );
			$menu = [ ];
			$functions = [ ];
			foreach ( $query->result () as $row ) {
				$functions[$row->uniqueCode] = $row;
				$menu [$row->functionGroup] [$row->componentId] = $row;
			}

			$this->session->set_userdata ( Applicationconst::SESSION_MENU, $menu );
			$this->session->set_userdata ( Applicationconst::SESSION_FUNCTIONS, $functions );

			$systemName = $this->codemodel->getByCode ( Applicationconst::SESSION_SYSTEM_NAME )->value;
			$systemTitle = $this->codemodel->getByCode ( Applicationconst::SESSION_SYSTEM_TITLE )->value;
			$this->session->set_userdata ( Applicationconst::SESSION_SYSTEM_NAME, $systemName );
			$this->session->set_userdata ( Applicationconst::SESSION_SYSTEM_TITLE, $systemTitle );

			return true;
		}
		return false;
	}
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( base_url () . 'login', 'refresh' );
	}
	private function validateUser($username, $password) {
		$query = $this->db->query ( "SELECT * FROM user WHERE uniqueCode = '$username'" );
		foreach ( $query->result () as $row ) {
			if ($row->password == md5 ( $password )) {
				return $row;
			}
		}
		return null;
	}
}