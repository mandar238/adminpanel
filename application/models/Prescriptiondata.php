<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prescriptiondata extends CI_Model{
    function __construct() {
        $this->prescriptionTbl = 'prescription';
        $this->scheduleTbl = 'schedule_time';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('prescription.*,users.username as pname,doctors.fname as fname,doctors.lname as lname');
        $this->db->join('users', 'prescription.user_id = users.id');
        $this->db->join('doctors', 'prescription.doctor_id = doctors.id');
        $this->db->from($this->prescriptionTbl);
        $this->db->where('prescription.is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->prescriptionTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function getTime($params){
        $this->db->select('*');
        $this->db->from($this->scheduleTbl);
        $this->db->where('part_day',$params);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    
    public function insert($data = array()) {
        $this->db->from($this->prescriptionTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->prescriptionTbl, $data);
        
        //return the status
        if($insert){
            
             return 'success';
            //return $this->db->insert_id();;
        }else{
            return 'error';
        }
    }
    public function update($data = array(),$id) {
       
        //insert user data to users table
       $this->db->update($this->prescriptionTbl, $data, array('id' => $id));   

       if ($this->db->trans_status() === FALSE)
        {


           // echo 'error';die;
            $this->db->trans_rollback();
           // $this->set_error('update_unsuccessful');
            return 'error';
        } 
        $this->db->trans_commit();

      
        //$this->set_message('update_successful');
        return 'success';

        //echo '<pre>',print_r($update);
        //return the status
       
    }

    
    public function deleteBslestimation($data = array(),$id)
    {
        $this->db->update($this->prescriptionTbl, $data, array('id' => $id));
        return 'success';
    }

    function getreportData($params = array()) {
        $user_id = $params['user_id'];
        $fromDate = date('Y-m-d',strtotime($params['fromDate']));
        $toDate = date('Y-m-d',strtotime($params['toDate']));
        $this->db->select('*');
        $this->db->select('prescription.*,doctors.fname as fname,doctors.lname as lname');
        $this->db->join('doctors', 'prescription.doctor_id = doctors.id');
        $this->db->from($this->prescriptionTbl);
        $this->db->where('prescription.user_id',$user_id);
        $this->db->where('prescription.date >=',$fromDate);
        $this->db->where('prescription.date <=',$toDate);        
        $this->db->where('prescription.is_deleted',0);
        $this->db->order_by('prescription.date');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}