<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Schedulesettingdata extends CI_Model{
    function __construct() {
        $this->schedulesettingTbl = 'schedule_time';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('*');
        $this->db->from($this->schedulesettingTbl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

   

    function getRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->schedulesettingTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    
    
    public function update($data = array(),$id) {
       
        //insert user data to users table
       $this->db->update($this->schedulesettingTbl, $data, array('id' => $id));   

       if ($this->db->trans_status() === FALSE)
        {

            $this->db->trans_rollback();
            return 'error';
        } 
        $this->db->trans_commit();

        return 'success';
       
    }

    
    
}