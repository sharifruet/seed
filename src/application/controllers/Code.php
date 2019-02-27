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
           $this->compoent = 'code';
           $this->load->model('codemodel');      
        }
        
        /**
         * *default functin, redirects to login page if no admin logged in yet**
         */
        public function index(){
            redirect(base_url() . $this->compoent.'/search', 'refresh');
        }
        
        public function commonTasks(){
            $data = parent::commonTasks();
            $data['component'] = $this->compoent;
            
            return $data;
        }
        
        public function search(){
            $data = $this->commonTasks();
            
            $data = $this->commonSearch($data);
            
            $data['type'] = '';
            
            if ($this->input->post('key') != null)
                $data['type'] = $this->input->post('type');
               
         
            $data['inputs']['type'] = ['type' => 'textfield',  'label' => 'Type',  'fielddata' => [  'name' => 'type', 'class'=>'form-control', 'value' => $data['type']   ]  ];
           
            $data['page_title'] = $this->compoent.' Search';
            $data['page_name'] = $this->compoent.' Search';
            $data['searchAction'] = base_url() . $this->compoent.'/search';
            
            $searchSQL = "SELECT c.componentId, c.uniqueCode, c.type, c.value FROM codes c      
			             WHERE c.uniqueCode LIKE '%" . $data['search'] . "%' AND  c.uniqueCode LIKE '%" . $data['type'] . "%' ";
                    
                        
            $pageSQL = " LIMIT " . ($data['pageNo'] - 1) * $data['limit'] . ",  " . $data['limit'];
            $query = $this->db->query($searchSQL);
            $data['total'] = $query->num_rows();
            $query1 = $this->db->query($searchSQL . $pageSQL);
            $data['searchData'] = $query1->result();
            $data['propertyArr'] = [ 'uniqueCode' => 'Code', 'type' => 'Type',  'value' => 'Value' ];
            $data['addmodifyAction'] = $this->compoent .'/add';
            $this->load->view('admin/'.$this->compoent .'/search/index.php', $data);
        }
        
        public function add($id = 0) {
            $data = $this->commonTasks();
            if ($id > 0)
                $data['page_title'] = 'Modify '.$this->compoent;
            else
                $data['page_title'] = 'Add '.$this->compoent;
            
            $data['page_name'] = 'home';
            
            $uniqueCode = '';
            $type = '';
            $value = '';
            
            if ($id > 0) {
                $result = $this->codemodel->getById($id );
                if ($result)
                {
                    $id = $result->componentId;
                    $uniqueCode = $result->uniqueCode;
                    $type = $result->type;
                    $value = $result->value;
                }
            }
     
            $data['inputs'] = [
                '0'     => [    'type' => 'hidden',                     'fielddata' => [ 'class' => 'form-control', 'name' => 'id',         'id' => 'id',           'value' => $id  ]  ],
                'code'  => [ 'type' => 'textfield',  'label' => 'Code', 'fielddata' => [ 'class' => 'form-control', 'name' => 'uniqueCode', 'id' => 'uniqueCode',   'value' => $uniqueCode  ] ],
                'type'  => [ 'type' => 'textfield',  'label' => 'Type', 'fielddata' => [ 'class' => 'form-control', 'name' => 'type',       'id' => 'type',         'value' => $type  ] ],
                'value' => [ 'type' => 'textfield',  'label' => 'Value','fielddata' => [ 'class' => 'form-control', 'name' => 'value',      'id' => 'value',        'value' => $value  ] ]
            ];
            
            $this->load->view('admin/'.$this->compoent.'/add/index', $data);
        }
        
        public function save($id = 0)
        
        {
            $data = $this->commonTasks();
            
            $data['page_title'] = 'Add '.$this->compoent;
            
            $data['page_name'] = 'home';
            
            $data['id'] = $this->input->post('id');
            
            $dataToSave['uniqueCode'] = $this->input->post('uniqueCode');
            
            $dataToSave['type'] = $this->input->post('type');
            
            $dataToSave['value'] = $this->input->post('value');
            
            $data['fail_message'] = array();
            
            if ($this->input->post('uniqueCode') == null) {
                
                array_push($data['fail_message'], 'Code can not be blank');
            }
            
            if ($this->input->post('value') == null) {
                
                array_push($data['fail_message'], 'Value can not be blank');
            }
            
            if (count($data['fail_message'])) {
                
                $data['componentId'] = $this->input->post('componentId');
                
                $data['uniqueCode'] = $this->input->post('uniqueCode');
                
                $data['type'] = $this->input->post('type');
                
                $data['value'] = $this->input->post('value');
                
                
                $this->load->view('admin/'.$this->compoent.'/add/index', $data);
                
                return;
            }
            
            if ($data['id'] > 0) {
                $this->codemodel->update($data['id'], $dataToSave);
            } else {  
                $this->codemodel->save($dataToSave);
            }
            
            redirect(base_url() .$this->compoent.'/search', 'refresh');
        }
        
        public function delete()
        
        {
            $data = $this->commonTasks();
            
            $data['page_title'] = 'Add '.$this->compoent;
            
            $data['page_name'] = 'home';
            
            $data['id'] = $this->input->post('id');

            if ($this->codemodel->delete($data['id'])) {
                
                redirect(base_url() . $this->compoent.'/search', 'refresh');
            } else {
                
                $this->load->view('admin/'.$this->compoent.'/add/index', $data);
            }
        }
    }