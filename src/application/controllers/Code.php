<?php
if (! defined('BASEPATH'))
    
    exit('No direct script access allowed');

/*
 *
 * @author : Sharif Uddin
 * date : October 21, 2017
 */
    class Code extends MY_Controller{
        
        function __construct(){
           parent::__construct();
           $this->component = 'code';
           $this->load->model('codemodel');   
           $this->model = $this->codemodel;
        }
        
        /**
         * *default functin, redirects to login page if no admin logged in yet**
         */
        public function index(){
            redirect(base_url() . $this->component.'/search', 'refresh');
        }
        
        public function commonTasks(){
            $data = parent::commonTasks();
            $data['component'] = $this->component;
            
            return $data;
        }
        
        public function search(){
            $data = $this->commonTasks();
            
            $data = $this->commonSearch($data);
            
            $data['type'] = '';
            
            if ($this->input->post('key') != null)
                $data['type'] = $this->input->post('type');
               
         
            $data['inputs']['type'] = ['type' => 'textfield',  'label' => 'Type',  'fielddata' => [  'name' => 'type', 'class'=>'form-control', 'value' => $data['type']   ]  ];
           
            $data['page_title'] = $this->component.' Search';
            $data['page_name'] = $this->component.' Search';
            $data['searchAction'] = base_url() . $this->component.'/search';
            
            $searchSQL = "SELECT c.componentId, c.uniqueCode, c.type, c.value FROM codes c      
			             WHERE c.uniqueCode LIKE '%" . $data['search'] . "%' AND  c.type LIKE '%" . $data['type'] . "%' ";
                    
                        
            $pageSQL = " LIMIT " . ($data['pageNo'] - 1) * $data['limit'] . ",  " . $data['limit'];
            $query = $this->db->query($searchSQL);
            $data['total'] = $query->num_rows();
            $query1 = $this->db->query($searchSQL . $pageSQL);
            $data['searchData'] = $query1->result();
            $data['propertyArr'] = [ 'uniqueCode' => 'Code', 'type' => 'Type',  'value' => 'Value' ];
            $data['addmodifyAction'] = $this->component .'/add';
            $this->load->view($this->userType . '/'.$this->component .'/search/index.php', $data);
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
        	$data['page_name'] = $this->component;
        	
        	if ($this->model->delete1()) {
        		redirect(base_url($this->component.'/search'), 'refresh');
        	} else {
        		$rsObj = $this->model->getById($id);
        		$data['inputs'] = $this->model->getUiObject($rsObj);
        		$this->load->view($this->userType . '/' . $this->component . '/add/index', $data);
        	}
        }
    }