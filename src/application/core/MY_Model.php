<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    var $componentId;
    var $uniqueCode = '';
    var $version = 0;
    var $status = 0;

    // var $createdBy = 0;

    // var $createdDate = '2017-01-01';

    // var $updatedBy = 0;

    // var $updatedDate = '2017-01-01';
    protected function fetchFromInput(){
        $this->componentId = $this->input->post('componentId');
        $this->uniqueCode = $this->input->post('uniqueCode');
        $this->version = $this->input->post('version');
        $this->status = $this->input->post('status');
        
        if($this->componentId>0){
            $this->updatedBy = $this->session->userdata('userid');
            $this->updatedDate = date("Y-m-d H:i:s");
        }else{
            $this->createdBy = $this->session->userdata('userid');
            $this->createdDate = date("Y-m-d H:i:s");
        }
        
    }
    
    public function getTableName(){
       return 'abc';
    }

    public function setResultSetObject($rs){
        if($rs == null)
            return;
        $this->componentId = $rs->componentId;
        $this->version = $rs->version;
        $this->status = $rs->status;
        $this->uniqueCode = $rs->uniqueCode;
    }

    public function getUIObject($rs){
        $this->setResultSetObject($rs);

        return ['0' =>['type'=>'hidden',    'label' => '',      'fielddata'=>['name' => 'componentId',  'id' => 'componentId','type='>'hidden',  'value' => $this->componentId,]],
                '1' =>['type'=>'hidden',    'label' => '',      'fielddata'=>['name' => 'version',      'id' => 'version', 'type='>'hidden',     'value' => $this->version,]],
                '2' =>['type'=>'hidden',    'label' => '',      'fielddata'=>['name' => 'status',       'id' => 'status', 'type='>'hidden',      'value' => $this->status,]],
                '3' =>['type'=>'textfield', 'label' => 'Name',  'fielddata'=>['name' => 'uniqueCode',   'id' => 'uniqueCode',   'value' => $this->uniqueCode,]],
            ];
    }


    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function getOrderBy(){
        return ['componentId'=>'DESC'];
    }

    public function getAll()
    {
        $this->db->from($this->getTableName());
        foreach ($this->getOrderBy() as $key => $value) {
            $this->db->order_by($key, $value);
        }
        $query = $this->db->get(); 
        return $query->result();
    }
    public function getById1(){
        $id = $this->input->post('componentId');
        return $this->getById($id);
    }
    public function getById($id)
    {
        $ret = $this->getByFilter([
            'componentId' => $id
        ]);
        
        if (count($ret) > 0)
            
            $ret = $ret[0];
        
        return $ret;
        
        return $this->getByFilter([
            'componentId' => $id
        ]);
    }
    
    public function getByCode($code)
    {
        $ret = $this->getByFilter(['uniqueCode' => $code]);
        
        if (count($ret) > 0)
            $ret = $ret[0];
        
        return $ret;
            
    }

    public function getByFilter($filter)
    {
        $ret = $this->db->get_where($this->getTableName(), $filter)->result();
        
        return $ret;
    }

    public function update($id, $data)
    {


        $this->db->where('componentId', $id);
        
        return $this->db->update($this->getTableName(), $data);
    }

    public function delete($id)
    {
        $this->db->where('componentId', $id);
        
        return $this->db->delete($this->getTableName());
    }

    public function delete1(){
        $id = $this->input->post('componentId');

        return $this->delete($id);
    }
    
    public function save1(){
        $this->fetchFromInput();
       //echo "string ".$this->date;
        //exit();
        if($this->componentId > 0)
            return $this->update($this->componentId, $this);
        $this->db->insert($this->getTableName(), $this);
        return $this->db->insert_id();
    }

    public function save($data)
    {
        $this->db->insert($this->getTableName(), $data);
        
        return $this->db->insert_id();
    }
    
    public function getSequence($seqName){
        $query = $this->db->query("CALL getsequence('" . $seqName . "');");
        $res = $query->result_array();
        $query->next_result();
        $query->free_result();
        $currentValue = 0;
        foreach ($res as $row){
            $currentValue = $row['currentValue'];
        } 
        return $currentValue;
    }
    
    public function getMonthOptions(){
        return [1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',
            7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'];
    }
    
    public function getYearOptions(){
        $years = [];
        for($y=2016;$y<2028;$y++)
            $years[$y] = $y;
        
        return $years;
    }
    
    
}
?>