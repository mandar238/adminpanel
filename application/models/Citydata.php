<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Citydata extends CI_Model{
    function __construct() {
        $this->cityTbl = 'cities';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('id,name');
        $this->db->from($this->cityTbl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}