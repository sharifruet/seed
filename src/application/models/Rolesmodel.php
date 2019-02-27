<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rolesmodel extends MY_Model {
        function __construct()  { 
        parent::__construct();
    }        public function getTableName(){ return 'roles'; }
    
}
?>