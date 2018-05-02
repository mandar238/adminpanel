<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itemdata extends CI_Model{
    function __construct() {
        $this->itemTbl = 'items';
    }
    /*
     * get rows from the users table
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->itemTbl);
        $this->db->where('category_id',$params['category_id']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getItemslabel($params = array()){
        $this->db->select('*');
        $this->db->from($this->itemTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function Add_User($data_user){
        $this->db->insert('items', $data_user);
    }


    function getallRows(){
        $this->db->select('items.*,category.category_name');
        $this->db->join('category', 'items.category_id = category.id');
        $this->db->from($this->itemTbl);
        $this->db->where('items.is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }



     function getRowedit($params = array()){
        $this->db->select('*');
        $this->db->from($this->itemTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function insert($data = array()) {
        $this->db->from($this->itemTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->itemTbl, $data);
        
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
       $this->db->update($this->itemTbl, $data, array('id' => $id));   

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


    public function deleteitem($data = array(),$id)
    {
        $this->db->update($this->itemTbl, $data, array('id' => $id));
        return 'success';
    }

}