<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
	
	/*
	 *
	 *
	 * @author : Sharif Uddin
	 * date : April 01, 2016
	 */
	class Event extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			
			$this->load->model('eventmodel');
			$this->model = $this->eventmodel;
			$this->component = 'event';
		}
		
		/**
		 * *default functin, redirects to login page if no admin logged in yet**
		 */
		public function index()
		{
			// commonTasks();
			redirect(base_url($this->component . '/search'), 'refresh');
		}
		
		public function commonTasks()
		{
			$data = parent::commonTasks();
			
			$data['component'] = $this->component;
			return $data;
		}
		
		public function search($param = "")
		{
			$data = $this->commonTasks();
			$data = $this->commonSearch($data);
			// echo $data['pageNo'].'-------->';
			$name = '';
			$uniqueCode = '';
			$contact = '';
			$email = '';
			if ($this->input->post('name') != null)
				$name = $this->input->post('name');
				if ($this->input->post('uniqueCode') != null)
					$uniqueCode = $this->input->post('uniqueCode');
					
					if ($this->input->post('contact') != null)
						$contact = $this->input->post('contact');
						if ($this->input->post('email') != null)
							$email = $this->input->post('email');
							
							$data['inputs']['search'] = [
									'type' => 'textfield',
									'label' => 'Username',
									'fielddata' => [
											'name' => 'uniqueCode',
											'class' => 'form-control',
											'value' => $uniqueCode
									]
							];
							$data['inputs']['name'] = [
									'type' => 'textfield',
									'label' => 'Name',
									'fielddata' => [
											'name' => 'name',
											'class' => 'form-control',
											'value' => $name
									]
							];
							$data['inputs']['contact'] = [
									'type' => 'textfield',
									'label' => 'Contact',
									'fielddata' => [
											'name' => 'contact',
											'class' => 'form-control',
											'value' => $contact
									]
							];
							
							$data['inputs']['email'] = [
									'type' => 'textfield',
									'label' => 'Email',
									'fielddata' => [
											'name' => 'email',
											'class' => 'form-control',
											'value' => $email
									]
							];
							
							
							$data['page_title'] = ucfirst($this->component) . ' List';
							$data['page_name'] = $this->component;
							
							$data['searchAction'] = base_url($this->component . '/search');
							
							$searchSQL = "SELECT * FROM event WHERE uniqueCode LIKE '%" . $uniqueCode . "%' ";
							if ($name != '')
								$searchSQL .= " AND (firstName LIKE '%" . $name . "%' OR lastName LIKE '%" . $name . "%' )";
								
								if ($contact != '')
									$searchSQL .= " AND contact LIKE '%" . $contact . "%'";
									
									if ($email != '')
										$searchSQL .= " AND email LIKE '%" . $email . "%'";
										
										$pageSQL = " LIMIT " . ($data['pageNo'] - 1) * $data['limit'] . ",  " . $data['limit'];
										$query = $this->db->query($searchSQL);
										$data['total'] = $query->num_rows();
										$query1 = $this->db->query($searchSQL . $pageSQL);
										$data['searchData'] = $query1->result();
										$data['propertyArr'] = [
												'date' => 'Date',
												'title' => 'Title',
												'description' => 'Description',
												'locationAddr1' => 'Address 1',
												'locationAddr2' => 'Address 2',
												'city' => 'City',
												'zip' => 'ZIP'
										];
										$data['addmodifyAction'] = $this->component . '/add';
										$this->load->view($this->userType . '/' . $this->component . '/search/index.php', $data);
										
		}
		
		public function add($id = 0)
		{
			$data = $this->commonTasks();
			if ($id > 0)
				$data['page_title'] = 'Modify '.ucfirst($this->component);
				else
					$data['page_title'] = 'Add '.ucfirst($this->component);
					
					$data['page_name'] = $this->component;
					
					$rsObj = $this->model->getById($id);
					$data['inputs'] = $this->model->getUiObject($rsObj);
					$this->load->view($this->userType . '/' . $this->component . '/add/index', $data);
		}
		
		public function save($id = 0)
		{
			$data = $this->commonTasks();
			$data['page_title'] = 'Add '.ucfirst($this->component);
			$data['page_name'] = $this->component;
			
			$this->model->save1();
			
			redirect(base_url($this->component . '/search'), 'refresh');
		}
		
		public function delete()
		{
			$data = $this->commonTasks();
			$data['page_title'] = 'Delete '.ucfirst($this->component);
			$data['page_name'] = $this->component;
			
			if ($this->model->delete1()) {
				redirect(base_url($this->component . '/search'), 'refresh');
			} else {
				$rsObj = $this->model->getById($id);
				$data['inputs'] = $this->model->getUiObject($rsObj);
				$this->load->view($this->userType . '/' . $this->component . '/add/index', $data);
			}
		}
	}
	
	
	


