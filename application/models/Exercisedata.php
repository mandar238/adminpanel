<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exercisedata extends CI_Model{
    function __construct() {
        $this->exerciseTbl = 'exercise';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('*');
        $this->db->from($this->exerciseTbl);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getRow($params){
        $this->db->select('*');
        $this->db->from($this->exerciseTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getRowedit($params = array()){
        $this->db->select('*');
        $this->db->from($this->exerciseTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function insert($data = array()) {
        $this->db->from($this->exerciseTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->exerciseTbl, $data);
        
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
       $this->db->update($this->exerciseTbl, $data, array('id' => $id));   

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


    public function deleteexercise($data = array(),$id)
    {
        $this->db->update($this->exerciseTbl, $data, array('id' => $id));
        return 'success';
    }

}