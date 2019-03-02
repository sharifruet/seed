<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');/** * This  is data access class for Codes component *  * @author Sharif Uddin * @since October 21, 2017 * */
class Codemodel extends MY_Model {
	var $type = '' ;
	var $value = '' ;
	
	function __construct()  {
		parent::__construct();
	}
	
	public function getTableName(){ return 'codes'; }
	
	protected function fetchFromInput(){
		parent::fetchFromInput();
		
		$this->type = $this->input->post('type');
		$this->value = $this->input->post('value');
	}
	
	public function setResultSetObject($rs){
		if($rs == null)
			return;
			parent::setResultSetObject($rs);
			$this->value = $rs->value;
			$this->type = $rs->type;
	}
	
	public function getUiObject($rs){
		$input = parent::getUiObject($rs);
		
		$inp =  [
				'3' =>['type'=>'textfield', 'label' => 'Code',	'fielddata'=>['name' => 'uniqueCode', 'class'=>'form-control',	'id' => 'uniqueCode', 	'value' => $this->uniqueCode,]],
				'4' =>['type'=>'textfield', 'label' => 'Type',	'fielddata'=>['name' => 'type', 	'class'=>'form-control',	'id' => 'type', 		'value' => $this->type,]],
				'5' =>['type'=>'textfield', 'label' => 'Value',	'fielddata'=>['name' => 'value', 'class'=>'form-control',	'id' => 'value',	'value' => $this->value,]],
				
		];
		
		foreach ($inp as $key => $value) {
			$input[$key] = $value;
		}
		
		return $input;
	}
}
?>