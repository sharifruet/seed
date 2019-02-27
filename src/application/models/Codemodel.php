<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');/** * This  is data access class for Codes component *  * @author Sharif Uddin * @since October 21, 2017 * */
class Codemodel extends MY_Model {        const OFFICE_ADDRESS = 'head_office_address';    const OFFICE_PHONE = 'head_office_phone';    const SYSTEM_NAME = 'system_name';    const SYSTEM_TITLE = 'system_title';    
    function __construct(){
        parent::__construct();
    }        public function getTableName(){ return 'codes'; }        public function getCodesByType($type){    	$rs = $this->getByFilter(['type'=>$type]);    	$ret = [];    	foreach ($rs as $row){    		$ret[$row->uniqueCode] = $row->value;    	}    	    	return $ret;    }
}
?>