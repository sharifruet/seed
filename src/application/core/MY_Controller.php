<?php
class MY_Controller extends CI_Controller {
	var $component = 'user';
	var $userType = 'ADMIN';
	var $model;
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
		// $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		// $this->output->set_header('Pragma: no-cache');
		$this->load->model ( 'codemodel' );
		$this->model = $this->codemodel;
	}
	public function index() {
		return;
	}
	public function commonSearch($pageVar) 
	{
		$pageVar ['limit'] = 1000;

		$pageVar ['pageNo'] = 1;

		$pageVar ['search'] = '';

		$pageVar ['typeArr'] = [ ];

		if ($this->input->post ( 'search' ) != null)

			$pageVar ['search'] = $this->input->post ( 'search' );

		if ($this->input->get ( 'pageNo' ) != null)

			$pageVar ['pageNo'] = $this->input->get ( 'pageNo' );

		if ($this->input->post ( 'pageNo' ) != null)

			$pageVar ['pageNo'] = $this->input->post ( 'pageNo' );

		$pageVar ['inputs'] = [ 

				'pageNo' => [ 
						'type' => 'hidden',
						'fielddata' => [ 
								'name' => 'pageNo',
								'id' => 'pageNo',
								'value' => $pageVar ['pageNo']
						]
				],

				'search' => [ 
						'type' => 'textfield',
						'label' => 'Search text',
						'fielddata' => [ 
								'name' => 'search',
								'id' => 'search',
								'class' => 'form-control',
								'value' => $pageVar ['search']
						]
				]
		];

		return $pageVar;
	}
	public function isLoggedIn() {
		if ($this->session->userdata ( Applicationconst::SESSION_USERNAME ))
			return true;
		else
			return false;
	}
	public function commonTasks() {
		$data = array ();
		$data [Applicationconst::SESSION_SYSTEM_NAME] = $this->session->userdata ( Applicationconst::SESSION_SYSTEM_NAME );
		$data [Applicationconst::SESSION_SYSTEM_TITLE] = $this->session->userdata ( Applicationconst::SESSION_SYSTEM_TITLE );
		$this->userType = $this->session->userdata (Applicationconst::SESSION_USER_TYPE);
		$data ['pageTitle'] = 'Dashboard';
		$component = $this->router->fetch_class ();
		$method = $this->router->fetch_method ();
		$acl = $component . $method;
		if ($method == 'save')
			$acl = $component . 'add';

		if ($this->isLoggedIn () == false) {
			redirect ( base_url () . 'index.php/login', 'refresh' );
		} else {
			$accessDenied = true;

			$functions = $this->session->userdata ( Applicationconst::SESSION_FUNCTIONS);

			if (in_array ( $acl, array_keys($functions) )) {
				$accessDenied = false;
				
			}

			$data ['menu'] = $this->session->userdata ( Applicationconst::SESSION_MENU ); // $menu;

			$data ['username'] = $this->session->userdata ( Applicationconst::SESSION_USERNAME );
			//echo ($acl);die();
			if($accessDenied == false){
				$data ['functionName'] = $functions[$acl]->displayName;
				$data ['functionGroup'] = $functions[$acl]->functionGroup;
			}else if($acl == "homedashboard"){
				$data ['functionName'] = 'Dashboard';
				$data ['functionGroup'] = 'Home';
			}else {	
				show_error ( "You are not authorized to access this. Please contact with system  administrator.", 403 );
			}

			return $data;
		}
	}

	public function load($tableName, $where = "") {
		$query = $this->db->query ( "SELECT * FROM $tableName $where " );

		return $query->result ();
	}
}
class MY_RestController extends MY_Controller {
	var $model;
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'my_model' );
		$this->model = $this->my_model;
	}
	public function index() {
		return;
	}
	private function checkAuthentication($request) {
		if ($request == null)
			return false;

		if ($this->session->userdata ( 'username' ))
			return true;
		else
			return false;
		return true;
	}
	private function checkAuthorization($request) {
		if ($request == null)
			return false;

		return true;
	}

	/**
	 *
	 *
	 *
	 *
	 *
	 * All requests should go through this method
	 *
	 *
	 *
	 * This method contains authentication and authorization activities.
	 *
	 *
	 *
	 * @param string $param
	 *
	 *
	 *
	 *
	 *
	 */
	public function post($param = '') {
		$response = [ 

				"success" => false,
				"errorMessage" => "",
				"errorCode" => 1
		];

		$_POST = json_decode ( file_get_contents ( 'php://input' ), true );

		if ($_POST) {

			$request = $this->input->post ();
			$isLoggedin = $this->checkAuthentication ( $request );
			$isAuthorized = $this->checkAuthorization ( $request );
			$operation = $request ['operation'];
			if ($isLoggedin == false) {

				echo json_encode ( $response );

				return;
			}
			if ($operation == null) {
				// TODO implement operan null case
				;
			} else {
				switch ($operation) {
					case Applicationconst::OPERATION_ADD :
						$response ['data'] = $this->add ( $request ['data'] );
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_MODIFY :
						$response ['data'] = $this->modify ();
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_DELETE :
						$response ['data'] = $this->delete ();
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_GET :
						$response ['data'] = $this->get ( $request ['componentId'] );
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_GET_ALL :
						$response ['data'] = $this->getAll ();
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_GET_BY_FILTER :
						$response ['data'] = $this->getByFilter ( $request ['filter'] );
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					case Applicationconst::OPERATION_CUSTOM :
						$response ['data'] = $this->custom ( $request ['filter'] );
						$response ['success'] = true;
						$response ['errorCode'] = 0;
						break;
					default :
						$response ['success'] = false;
						$response ['errorMessage'] = 'Invalid operation';
						$response ['errorCode'] = 2;
				}
			}
		} else {
			$response ["errorMessage"] = "Input parameters missing";
			$response ['errorCode'] = 1;
		}
		header ( 'Content-Type: application/json;charset=utf-8' );
		echo json_encode ( $response );
		return;
	}
	public function getItems($param = '') {
		$response = [ 

				"success" => false,
				"errorMessage" => "",
				"errorCode" => 1
		];

		$response ['data'] = $this->getAll ();
		$response ['success'] = true;
		$response ['errorCode'] = 0;

		header ( 'Content-Type: application/json;charset=utf-8' );
		echo json_encode ( $response );
		return;
	}

	/**

	 */
	protected function add($object) {
		$object = $this->updateAuditInfo ( $object );
		return $this->model->save ( $object );
	}
	protected function updateAuditInfo($object) 
	{
		$object ['createdby'] = $this->session->userdata ( 'userid' );

		$object ['createddate'] = date ( "Y-m-d h:i:s" );

		return $object;
	}

	/**

	 */
	protected function modify($objectId, $object) 
	{
		return $this->model->update ( $objectId, $object );
	}

	/**
	 *
	 * delete data

	 */
	protected function delete($objectId) 
	{
		return $this->model->delete ( $objectId );
	}

	/**

	 * fetch all data

	 *
	 */
	protected function getAll() {
		return $this->model->getAll ();
	}

	/**
	 */
	protected function get($objectId) {
		return $this->model->getById ( $objectId );
	}

	/**
	 *
	 * fetch data by filter
	 */
	protected function getByFilter($filter) {
		return $this->model->getByFilter ( $filter );
	}
	protected function custom($req) {
		return null;
	}
}