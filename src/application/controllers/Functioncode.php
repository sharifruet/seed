<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @author : Sharif Uddin
 * date : April 01, 2016
 */
class Functioncode extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->component = 'functioncode';
        $this->load->model('functioncodemodel');
        $this->model = $this->functioncodemodel;
    }

    /**
     * *default functin, redirects to login page if no admin logged in yet**
     */
    public function index(){
    	redirect(base_url($this->component.'/search'), 'refresh');
    }

    public function commonTasks(){
        $data = parent::commonTasks();
        
        $data['component'] = $this->component;
        
        return $data;
    }

    public function search() {
        $data = $this->commonTasks();
        
        $data = $this->commonSearch($data);
        
        if ($this->input->post('search') != null)
            
            $data['search'] = $this->input->post('search');
        
        $data['page_title'] = 'Functions';
        
        $data['page_name'] = 'home';
        
        $data['searchAction'] = base_url($this->component.'/search');
        
        $data['searchDisplayTxt'] = 'searchDisplayTxt';
        
        $searchSQL = "SELECT componentId, uniqueCode, displayName, functionGroup, actionUrl, isMenu FROM functioncode WHERE uniqueCode LIKE '%" . $data['search'] . "%' ";
        
        $pageSQL = " LIMIT " . ($data['pageNo'] - 1) * $data['limit'] . ",  " . $data['limit'];
        
        $query = $this->db->query($searchSQL);
        
        $data['total'] = $query->num_rows();
        
        $query1 = $this->db->query($searchSQL . $pageSQL);
        
        $data['searchData'] = $query1->result();
        
        $data['propertyArr'] = [
            'uniqueCode' => 'Name',
            'displayName' => 'Display Name',
            'functionGroup' => 'Group',
            'actionUrl' => 'URL',
            'isMenu' => 'Menu'
        ];
        
        $data['addmodifyAction'] = $this->component.'/add';
        
        // Capitalize the first letter
        
        $this->load->view($this->userType . '/'.$this->component.'/search/index.php', $data);
    }

    public function add($id = 0) {
    	$data = $this->commonTasks();
    	if ($id > 0)
    		$data['page_title'] = 'Modify '.$this->component;
    		else
    			$data['page_title'] = 'Add '.$this->component;
    			
    			$data['page_name'] = $this->component;
    			
    			$rsObj = $this->model->getById($id);
    			$data['inputs'] = $this->model->getUiObject($rsObj);
    			
    			$this->load->view($this->userType . '/'.$this->component.'/add/index', $data);
    }
    
    public function save($id = 0)
    
    {
    	$data = $this->commonTasks();
    	
    	$data['page_title'] = 'Add '.$this->component;
    	
    	$data['page_name'] = 'home';
    	
    	$this->model->save1();
    	
    	redirect(base_url() .$this->component.'/search', 'refresh');
    }
    
    public function delete(){
    	$data = $this->commonTasks();
    	$data['page_title'] = 'Delete '.ucfirst($this->component);
    	$data['page_name'] = $this->component;;
    	
    	if ($this->model->delete1()) {
    		redirect(base_url($this->component.'/search'), 'refresh');
    	} else {
    		$rsObj = $this->model->getById($id);
    		$data['inputs'] = $this->model->getUiObject($rsObj);
    		$this->load->view($this->userType . '/' . $this->component . '/add/index', $data);
    	}
    }

    public function assignment()
    
    {
        $data = $this->commonTasks();
        
        $data['page_title'] = 'Role-Function Assignment';
        
        $data['page_name'] = 'home';
        
        $roleId = - 1;
        
        if ($this->input->post('roleId') != null) {
            
            $roleId = $this->input->post('roleId');
        }
        
        if ($this->input->post('assign') != null && $roleId !=-1) {
            
            $functions = $this->input->post('functions');
            
            $roleId = $this->input->post('roleId');
            
            $this->db->where('roleId', $roleId);
            
            $this->db->delete('functionrole');
            
            foreach ($functions as $functionId) :
                $this->db->insert('functionrole', [ 'functionId' => $functionId,  'roleId' => $roleId ]);
            endforeach
            ;
        }
        
        $data['searchAction'] = 'functioncode/assignment';
        
        $data['roleId'] = $roleId;
        
        $data['role'] = array(
            '-1' => 'Select role'
        );
        
        foreach ($this->load('role') as $row) {
            
            $data['role'][$row->componentId] = $row->uniqueCode;
        }
        $sql = "SELECT f.componentId, f.uniqueCode, f.displayName, IFNULL(fr.roleId, 0) assigned
    			FROM functioncode f
    			LEFT JOIN functionrole fr ON (f.componentId = fr.functionId AND fr.roleId = $roleId)
                ORDER BY f.uniqueCode ";
        $query = $this->db->query($sql);
        //echo $sql;
        $data['searchData'] = $query->result();
        
        $this->load->view($this->userType . '/' . $this->component . '/functionassign/index', $data);
    }
}
