<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 

 */  
require_once APPPATH."/third-party/PHPExcel.php"; 
require_once APPPATH."/third-party/PHPExcel/IOFactory.php"; 
 
class Excell extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 
}