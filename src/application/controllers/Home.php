<?php
if (! defined('BASEPATH'))
    
    exit('No direct script access allowed');

/*
 *
 * @author : Sharif Uddin
 *
 * date : April 01, 2016
 *
 */
class Home extends MY_Controller{

    function __construct(){
        parent::__construct();
    }

    /**
     * *default functin, redirects to login page if no admin logged in yet**
     */
    public function index(){
        // commonTasks();
        redirect(base_url() . 'home/dashboard', 'refresh');
    }

    public function dashboard(){
        $data = $this->commonTasks();
        
        $data['page_title'] = 'Dashboard';
        
        $data['page_name'] = 'home';
        
        $functions =  $this->session->userdata('functions');
        
        $data['summery'] = false;
        if(in_array(Applicationconst::DASHBOARD_SUMMERY, $functions)){
            $data['summery'] = true;
            
            $data['cash'] = $this->getBalance(Applicationconst::ACCOUNT_HEAD_CASH_IN_HAND);
            $data['expense'] = $this->getBalance(- 1, Applicationconst::ACCOUNT_CAT1_EXPENSE);
            $data['revenue'] = $this->getBalance(- 1, Applicationconst::ACCOUNT_CAT1_REVENUE);
            
            $data['cashToday'] = $this->getBalance(Applicationconst::ACCOUNT_HEAD_CASH_IN_HAND, "-1", "-1", "-1", date("Y-m-d"));
            $data['expenseToday'] = $this->getBalance(- 1, Applicationconst::ACCOUNT_CAT1_EXPENSE, "-1", "-1", date("Y-m-d"));
            $data['revenueToday'] = $this->getBalance(- 1, Applicationconst::ACCOUNT_CAT1_REVENUE, "-1", "-1", date("Y-m-d"));
        }
        
        $data['links'] = false;
        if(in_array(Applicationconst::DASHBOARD_LINKS, $functions)){
            $data['links'] = true;
        }
        
        
        $this->load->view($this->userType.'/home/dashboard/index', $data);
    }

    public function accessdenied()
    {
        $data = $this->commonTasks();
        
        $data['page_title'] = 'AccessDenied';
        
        $data['page_name'] = 'home';
        
        $this->load->view('urlvalidation/index', $data);
    }
}
