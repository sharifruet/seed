<?php
class Applicationconst {
    const TRANSACTION_TYPE_JOURNAL = 'JOURNAL';
    const TRANSACTION_TYPE_PURCHASE = 'PURCHASE';
    const TRANSACTION_TYPE_PURCHASE_RETURN = 'PURCHASE-RETURN';
    const TRANSACTION_TYPE_SALE = 'SALES';    const TRANSACTION_TYPE_SALARY_PAYABLE = 'SALARY-PAYABLE';    const TRANSACTION_TYPE_SALARY = 'SALARY';
    const TRANSACTION_TYPE_SALE_RETURN = 'SALE-RETURN';
    const TRANSACTION_TYPE_PAYMENT = 'PAYMENT';
    const TRANSACTION_TYPE_RECEIVE = 'RECEIVE';    const TRANSACTION_TYPE_EXPENSE = 'EXPENSE';    const TRANSACTION_TYPE_WRITE_OFF = 'WRITE-OFF';	const TRANSACTION_TYPE_LOAN = 'LOAN';    const TRANSACTION_TYPE_TRANSFER = 'TRANSFER';
    
    const ACCOUNT_CAT1_ASSET = 'ASSET';
    const ACCOUNT_CAT1_LIABILITY = 'LIABILITY';
    const ACCOUNT_CAT2_OPERATING_EXPENSE = 'OPERATING EXPENSE';
    const ACCOUNT_CAT1_EXPENSE = 'EXPENSE';
    
    const ACCOUNT_CAT1_REVENUE = 'REVENUE';
    
    const ACCOUNT_CAT2_CURRENT_ASSET = 'CURRENT ASSET';
    const ACCOUNT_CAT2_CURRENT_LIABILITY = 'CURRENT LIABILITY';
    const ACCOUNT_CAT2_OTHER_LIABILITY = 'OTHER LIABILITY';
    const ACCOUNT_CAT2_FIXED_ASSET = 'FIXED ASSET';    const ACCOUNT_CAT2_OTHER_REVENUE = 'OTHER REVENUE';
    
    const ACCOUNT_CAT3_CASH = 'CASH';
    const ACCOUNT_CAT3_BANK = 'BANK';    const ACCOUNT_HEAD_CASH_IN_HAND = 1;            const ACCOUNT_HEAD_RECEIVABLE = 4;    const ACCOUNT_HEAD_PAYABLE = 5;    const ACCOUNT_HEAD_CASH_ADVANCE = 6;    const ACCOUNT_HEAD_SUSPENSION = 7;    const ACCOUNT_HEAD_PURCHASE_COMMISSION = 8;    const ACCOUNT_HEAD_SALE_DISCOUNT = 9;    const ACCOUNT_HEAD_COGS = 10;    const ACCOUNT_HEAD_INVENTORY = 11;
    const ACCOUNT_HEAD_PURCHASE = 12;
    const ACCOUNT_HEAD_SALE = 13;    const ACCOUNT_HEAD_BAD_DEBT = 14;    const ACCOUNT_HEAD_SALARY = 15;      
    const ITEM_TYPE_INVENTORY = 'INVENTORY';
    const ITEM_TYPE_OTHERS = 'OTHERS';
    
    const ITEM_CASH = 1;
    const USER_COMPANY = 1;
    
    const TRANSACTION_DOC_CHALLAN = 'CHALLAN';
    const TRANSACTION_DOC_INVOICE = 'INVOICE';
    
    const EMAIL_FROM = 'info@netsoft.com.bd';
	
    const CUSTOMER_GROUP_DEFAULT = 'SELECT';
    const OPTION_ALL = 'ALL';
    const CUSTOMER_GROUP_GUDHOLI = 'GUDHOLI';
    const CUSTOMER_GROUP_PADDMA = 'PADDMA';
    const CUSTOMER_TYPE_SAVING = 'SAVING ACCOUNT';
    const CUSTOMER_TYPE_LOAN = 'LOAN ACCOUNT';
    
    
    const OPERATION_ADD = 'add';
    const OPERATION_MODIFY = 'modify';
    const OPERATION_DELETE = 'delete';
    const OPERATION_GET = 'get';
    const OPERATION_GET_ALL = 'getAll';
    const OPERATION_GET_BY_FILTER = 'getByFilter';    const OPERATION_CUSTOM = 'custom';    const MONTHS = [1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December'];        const SESSION_SYSTEM_NAME = 'system_name';    const SESSION_SYSTEM_TITLE = 'system_title';    const SESSION_USER_TYPE = "userType";    const SESSION_USER_ID = "userId";    const SESSION_USERNAME = "username";    const SESSION_USER_DISPLAY_NAME = "userDisplayName";    const SESSION_MENU = "menu";    const SESSION_FUNCTIONS = "functions";        public static function getYears(){        $years = [];        for($y = 2017; $y<=date('Y')+3;$y++){            $years[$y] = $y;        }        return $years;    }    
    
    public static function checkAndConv($inp){
    	if (is_numeric($inp)){
    		return number_format($inp,2);
    	}else {
    		return $inp;
    	}
    }
    public static function convertNumber($inp){
    	
    	return number_format((float)$inp, 2, ".");
    	
    }
	
	public static function convertWord($inp){
    	return number_format((float)$inp, 2);
    }        public static function convertDate($inp){    	return date('d M Y', strtotime($inp));    }
	public static function convert_number($number) {
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= ApplicationConst::convert_number($Gn) .  " Million";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .ApplicationConst::convert_number($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .ApplicationConst::convert_number($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
	}
	/*
	const CUSTOMER_OPTIONS = [Applicationconst::OPTION_ALL=>Applicationconst::OPTION_ALL,
			Applicationconst::CUSTOMER_TYPE_SAVING=>Applicationconst::CUSTOMER_TYPE_SAVING,
			Applicationconst::CUSTOMER_TYPE_LOAN=>Applicationconst::CUSTOMER_TYPE_LOAN];*/
		const ALLOW_MULTIPLE = true;		const DASHBOARD_SUMMERY = 'dashboardsummery';	const DASHBOARD_LINKS = 'dashboardlinks';		const DATA_TYPE_FLOAT = 'float';	const DATA_TYPE_INT = 'int';	const DATA_TYPE_MONEY = 'money';	const DATA_TYPE_DATE = 'date';
}