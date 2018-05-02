<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mealdata extends CI_Model{
    function __construct() {
        $this->mealTbl = 'meal';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('meal.*,users.username as pname,category.category_name as category_name,items.item_name as item_name,items.quantity_label');
        $this->db->join('users', 'meal.user_id = users.id');
        $this->db->join('category', 'meal.category_id = category.id');
        $this->db->join('items', 'meal.item_id = items.id');
        $this->db->from($this->mealTbl);
        $this->db->where('meal.is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

   

    function getRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->mealTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    
    public function insert($data = array()) {
        $this->db->from($this->mealTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->mealTbl, $data);
        
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
       $this->db->update($this->mealTbl, $data, array('id' => $id));   

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

    
    public function deleteMeal($data = array(),$id)
    {
        $this->db->update($this->mealTbl, $data, array('id' => $id));
        return 'success';
    }

    public function getcaloriesData($data = array())
    {

        $user_id = $data['user_id'];
        $fromDate = date('Y-m-d',strtotime($data['fromDate']));
        $toDate = date('Y-m-d',strtotime($data['toDate']));
        $this->db->select('*,sum(calories_taken) as calories_taken');
        $this->db->from($this->mealTbl);
        $this->db->where('user_id',$user_id);
        $this->db->where('sdate >=',$fromDate);
        $this->db->where('sdate <=',$toDate);
        $this->db->where('is_deleted',0);
        $this->db->group_by('sdate');
        $query = $this->db->get();


        $result = $query->result_array();
        return $result;
    }
}