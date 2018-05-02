<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hbaestimationdata extends CI_Model{
    function __construct() {
        $this->hbaestimationTbl = 'hba_estimation';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('hba_estimation.*,users.username');
        $this->db->join('users', 'hba_estimation.user_id = users.id');
        $this->db->from($this->hbaestimationTbl);
        $this->db->where('hba_estimation.is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

   

    function getRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->hbaestimationTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function getreportData($params = array()) {
        $user_id = $params['user_id'];
        $fromDate = date('Y-m-d',strtotime($params['fromDate']));
        $toDate = date('Y-m-d',strtotime($params['toDate']));
        $this->db->select('*');
        $this->db->from($this->hbaestimationTbl);
        $this->db->where('user_id',$user_id);
        $this->db->where('date >=',$fromDate);
        $this->db->where('date <=',$toDate);
        $this->db->where('is_deleted',0);
        $this->db->order_by('date');
        $this->db->order_by('time');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    
    public function insert($data = array()) {
        $this->db->from($this->hbaestimationTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->hbaestimationTbl, $data);
        
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
       $this->db->update($this->hbaestimationTbl, $data, array('id' => $id));   

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

    
    public function deleteHbaestimation($data = array(),$id)
    {
        $this->db->update($this->hbaestimationTbl, $data, array('id' => $id));
        return 'success';
    }
}