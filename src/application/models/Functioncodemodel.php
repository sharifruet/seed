<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Functioncodemodel extends MY_Model {
	var $displayName;
	var $functionGroup;
	var $codeNumber;
	var $actionUrl;
	var $isMenu;
	
	function __construct() {		parent::__construct ();	}
	public function getTableName() {	return 'functioncode';	}
	public function getOrderBy() {	return [ 'codeNumber' => 'ASC'	];	}
	
	protected function fetchFromInput(){
		parent::fetchFromInput();
		
		$this->displayName = $this->input->post('displayName');
		$this->functionGroup = $this->input->post('functionGroup');
		$this->codeNumber = $this->input->post('codeNumber');
		$this->actionUrl = $this->input->post('actionUrl');
		$this->isMenu = $this->input->post('isMenu');
	}
	
	public function setResultSetObject($rs){
		if($rs == null)
			return;
			parent::setResultSetObject($rs);
			$this->displayName = $rs->displayName;
			$this->functionGroup = $rs->functionGroup;
			$this->codeNumber = $rs->codeNumber;
			$this->actionUrl = $rs->actionUrl;
			$this->isMenu = $rs->isMenu;
	}
	
	public function getUiObject($rs){
		$input = parent::getUiObject($rs);
		
		$inp =  [
				'3' =>['type'=>'textfield', 'label' => 'Function',			'fielddata'=>['name' => 'uniqueCode', 		'class'=>'form-control',	'id' => 'uniqueCode', 		'value' => $this->uniqueCode,]],
				'4' =>['type'=>'textfield', 'label' => 'Display Name',		'fielddata'=>['name' => 'displayName', 		'class'=>'form-control',	'id' => 'displayName', 		'value' => $this->displayName,]],
				'5' =>['type'=>'textfield', 'label' => 'Function Group',	'fielddata'=>['name' => 'functionGroup', 	'class'=>'form-control',	'id' => 'functionGroup', 	'value' => $this->functionGroup,]],
				'6' =>['type'=>'textfield', 'label' => 'Code Number',		'fielddata'=>['name' => 'codeNumber', 		'class'=>'form-control',	'id' => 'codeNumber', 		'value' => $this->codeNumber,]],
				'7' =>['type'=>'textfield', 'label' => 'Action (URL)',		'fielddata'=>['name' => 'actionUrl', 		'class'=>'form-control',	'id' => 'actionUrl', 		'value' => $this->actionUrl,]],
				'8' =>['type'=>'checkbox', 	'label' => 'Menu ?',			'fielddata'=>['name' => 'isMenu', 			'class'=>'form-control',	'id' => 'isMenu', 			'value' => $this->isMenu,]],
		];
		
		foreach ($inp as $key => $value) {
			$input[$key] = $value;
		}
		
		return $input;
	}
	
	public function getUserMenu($userId) {
		$menus = $this->db->get_where ( 'vuserfunctions', [ 
				'isMenu' => 1,
				'userId' => $userId
		] )->result ();
		$ret = array ();
		foreach ( $menus as $menu ) {

			$m = ( array ) $menu;

			$m ['child'] = array ();

			$m = ( object ) $m;

			if (isset ( $ret [$m->parentMenuId] ) == false)

				$ret [$m->parentMenuId] = array ();

			array_push ( $ret [$m->parentMenuId], $m );
		}

		$final = array ();

		foreach ( $ret [0] as $r ) {

			if (isset ( $ret [$r->componentId] )) {

				$r->child = $ret [$r->componentId];
			}

			array_push ( $final, $r );
		}

		return $final;
	}
}

?>