<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categorydata extends CI_Model{
    function __construct() {
        $this->categoryTbl = 'category';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('*');
        $this->db->from($this->categoryTbl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}