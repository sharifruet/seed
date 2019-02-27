<?php
/*	
 *	@author : Sharif Uddin
 *	date	: April 01, 2016
 */
class User extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index(){
        //commonTasks();
        redirect(base_url() . 'index.php/admin/dashboard', 'refresh');
    }
    public function commonTasks(){
    	$data = parent::commonTasks();
    	$data['component'] = 'user';
    	return $data;
    }
    public function search(){
    	$data = $this->commonTasks();
    	$data = $this->commonSearch($data);
    	$data['search'] = '';
    	if($this->input->post('search')!=null)
    		$data['search'] = $this->input->post('search');
    	$data['page_title'] = 'Users';
    	$data['page_name'] = 'home';
    	$data['searchAction'] = 'user/search';
    	$data['searchDisplayTxt'] = 'searchDisplayTxt';
    	$data['propertyArr'] = ['firstName'=>'First Name', 'lastName'=>'Last Name', 'uniqueCode'=>'User Name'];
    public function add($id = 0){
    	$data['page_title'] = 'Add User';
    	$data['userId'] = 0;
    public function save($id = 0){
    public function delete(){