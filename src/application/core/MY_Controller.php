<?php

class MY_Controller extends CI_Controller{
    var $compoent = 'user';
    public function __construct(){
        parent::__construct();
        $this->load->database();
       // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        
       // $this->output->set_header('Pragma: no-cache');
        
        $this->load->model('codemodel');
    }

    public function index(){
        return;
    }

    protected function getBalance($accountId = -1, $cat1 = '-1', $cat2 = '-1', $cat3 = '-1', $dateFrom = '2000-01-01', $dateTo = "-1", $userId = -1){
        if ($dateTo == "-1")
            $dateTo = date("Y-m-d");
        $sql = "SELECT IFNULL(SUM(d.type*quantity*unitPrice*(CASE WHEN a.category1='" . Applicationconst::ACCOUNT_CAT1_LIABILITY . "' OR a.category1='" . Applicationconst::ACCOUNT_CAT1_REVENUE . "' THEN -1 ELSE 1 END) ),0) AS balance
        FROM transaction_detail d
        INNER JOIN account a ON (d.accountId = a.componentId)
        INNER JOIN transaction t ON (d.transactionId = t.componentId)
        WHERE t.tdate BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "' ";
        if ($accountId > 0)
            $sql .= " AND accountId = $accountId ";                if ($userId > 0)             $sql .= " AND userId = $userId ";
        if ($cat1 != "-1")
            $sql .= " AND a.category1 = '" . $cat1 . "' ";
        $query = $this->db->query($sql);
        $rs = $query->result();
        foreach ($rs as $row) {
            return $row->balance;
        }
        return 0;
    }
    public function commonSearch($pageVar)
    {
        $pageVar['limit'] = 100;
        $pageVar['pageNo'] = 1;
        $pageVar['search'] = '';
        $pageVar['typeArr'] = [];

        if ($this->input->post('search') != null)
            $pageVar['search'] = $this->input->post('search');
        
        if ($this->input->get('pageNo') != null)
            $pageVar['pageNo'] = $this->input->get('pageNo');
        
        if ($this->input->post('pageNo') != null)
            $pageVar['pageNo'] = $this->input->post('pageNo');
        
        $pageVar['inputs'] = [
            'pageNo' => [ 'type' => 'hidden',  'fielddata' => [ 'name' => 'pageNo',  'id' => 'pageNo', 'value' => $pageVar['pageNo']  ] ],
            'search' => [  'type' => 'textfield', 'label' => 'Search text', 'fielddata' => [ 'name' => 'search', 'id' => 'search',  'class' => 'form-control',  'value' => $pageVar['search'] ] ] 
        ];
        
        return $pageVar;
    }

    public function isLoggedIn(){
        if ($this->session->userdata('username'))
            return true;
        else
            return false;
    }

    public function commonTasks(){
        $data = array();
        $data['system_name'] = $this->session->userdata(Codemodel::SYSTEM_NAME);//$this->codemodel->getByCode(Codemodel::SYSTEM_NAME)->value;
        $data['system_title'] = $this->session->userdata(Codemodel::SYSTEM_TITLE); //$this->codemodel->getByCode(Codemodel::SYSTEM_TITLE)->value;;
        $component = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        $acl = $component . $method;
        if ($method == 'save')
            $acl = $component . 'add';
        if ($this->isLoggedIn() == false)
            redirect(base_url() . 'index.php/login', 'refresh');
        else {
            $userId = $this->session->userdata('userid');
            $accessDenied = true;
            $functions =  $this->session->userdata('functions');
            if(in_array($acl, $functions)){
                 $accessDenied = false;
            }

            $data['menu'] = $this->session->userdata('menu');//$menu;
            $data['username'] = $this->session->userdata('username');
            if ($accessDenied == true && $acl != "homedashboard" && $acl != "homeaccessdenied"){
                show_error("You are not authorized to access this. Please contact with system  administrator.",403 );
            }
            
            return $data;
        }
    }

    public function getSequence($seqName)
    {
        $query = $this->db->query("CALL getsequence('" . $seqName . "');");
        
        $res = $query->result_array();
        
        $query->next_result();
        
        $query->free_result();
        
        $currentValue = 0;
        
        foreach ($res as $row) 
        {
            
            $currentValue = $row['currentValue'];
        }
        
        return $currentValue;
    }

    public function load($tableName, $where = "")
    {
        $query = $this->db->query("SELECT * FROM $tableName $where ");
        
        return $query->result();
    }
}

class MY_RestController extends MY_Controller{
    var $model;    
    public function __construct(){
        parent::__construct();        $this->load->model('my_model');
        $this->model = $this->my_model;
    }    
    public function index(){
        return;
    }

    private function checkAuthentication($request){
        if ($request == null)
            return false;
        if ($this->session->userdata('username'))
            return true;
        else
            return false;
        return true;
    }

    private function checkAuthorization($request){
        if ($request == null)
            return false;
        return true;
    }

    /**
     *
     *
     * All requests should go through this method
     *
     * This method contains authentication and authorization activities.
     *
     * @param string $param
     *
     *
     */
    public function post($param = ''){
        $response = [
            "success" => false,            "errorMessage"=>"",
            "errorCode" =>1
        ];
        $_POST = json_decode(file_get_contents('php://input'), true);               if($_POST){    
            $request = $this->input->post();            $isLoggedin = $this->checkAuthentication($request);            $isAuthorized = $this->checkAuthorization($request);            $operation = $request['operation'];            if($isLoggedin == false){  
                echo json_encode($response);    
                return;    
            }            if ($operation == null) {                // TODO implement operan null case                ;    
            } else {                switch ($operation) {                    case Applicationconst::OPERATION_ADD:                        $response['data'] = $this->add($request['data']);                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_MODIFY:                        $response['data'] = $this->modify();                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_DELETE:                        $response['data'] = $this->delete();                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_GET:                        $response['data'] = $this->get($request['componentId']);                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_GET_ALL:                        $response['data'] = $this->getAll();                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_GET_BY_FILTER:                        $response['data'] = $this->getByFilter($request['filter']);                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    case Applicationconst::OPERATION_CUSTOM:                        $response['data'] = $this->custom($request['filter']);                        $response['success'] = true;                        $response['errorCode'] = 0;                        break;                    default:                        $response['success'] = false;                        $response['errorMessage'] = 'Invalid operation';                        $response['errorCode'] = 2;                }    
            }
        }else{            $response["errorMessage"] = "Input parameters missing";            $response['errorCode'] = 1;        }        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($response);        return;
    }        public function getItems($param = ''){        $response = [                        "success" => false,            "errorMessage"=>"",            "errorCode" =>1                    ];                $response['data'] = $this->getAll();        $response['success'] = true;        $response['errorCode'] = 0;        header('Content-Type: application/json;charset=utf-8');        echo json_encode($response);        return;            }

    /**
     *
     *
     * Save data
     *
     *
     * @param unknown $object
     *
     *
     */
    protected function add($object){
        $object = $this->updateAuditInfo($object);
        return $this->model->save($object);
    }

    protected function updateAuditInfo($object)
    {
        $object['createdby'] = $this->session->userdata('userid');
        
        $object['createddate'] = date("Y-m-d h:i:s");
        
        return $object;
    }

    /**
     *
     *
     * Modify data
     *
     *
     * @param unknown $object
     *
     *
     */
    protected function modify($objectId, $object)
    {
        return $this->model->update($objectId, $object);
    }

    /**
     *
     *
     * delete data
     *
     *
     * @param unknown $object
     *
     *
     */
    protected function delete($objectId)
    {
        return $this->model->delete($objectId);
    }

    /**
     *
     *
     * fetch all data
     *
     *
     * @param unknown $object
     *
     *
     */
    protected function getAll(){
        return $this->model->getAll();
    }
    /**
     * fetch data
     * @param unknown $object
     */
    protected function get($objectId){
        return $this->model->getById($objectId);
    }

    /**
     * fetch data by filter
     * @param unknown $object
     */
    protected function getByFilter($filter){
        return $this->model->getByFilter($filter);
    }        protected function custom($req){        return null;    }
    
}