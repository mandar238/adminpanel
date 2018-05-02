<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Useractivitydata extends CI_Model{
    function __construct() {
        $this->useractivityTbl = 'user_activities';
    }
    /*
     * get rows from the users table
     */
    function getRows(){
        $this->db->select('user_activities.*,users.username,activity.activity_name');
        $this->db->join('users', 'user_activities.user_id = users.id');
        $this->db->join('activity', 'user_activities.activity_id = activity.id');
        $this->db->from($this->useractivityTbl);
        $this->db->where('user_activities.is_deleted',0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

   

    function getRow($params = array()){
        $this->db->select('*');
        $this->db->from($this->useractivityTbl);
        $this->db->where('id',$params['id']);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    
    public function insert($data = array()) {
        $this->db->from($this->useractivityTbl);
        $query = $this->db->get();
        $result = $query->row_array();
        
        $insert = $this->db->insert($this->useractivityTbl, $data);
        
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
       $this->db->update($this->useractivityTbl, $data, array('id' => $id));   

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

    
    public function deleteUseractivity($data = array(),$id)
    {
        $this->db->update($this->useractivityTbl, $data, array('id' => $id));
        return 'success';
    }


     public function getcaloriesData($data = array())
    {
        $user_id = $data['user_id'];
        $fromDate = date('Y-m-d',strtotime($data['fromDate']));
        $toDate = date('Y-m-d',strtotime($data['toDate']));

        $query = $this->db->query("SELECT data.date,SUM(data.calories_spent) AS calories_spent 
                                    FROM 
                                    (SELECT `date`,`calories_spent` FROM `user_exercise` WHERE user_id = $user_id AND date >= '$fromDate' AND date <= '$toDate'
                                    UNION ALL
                                    SELECT `date`,`calories_spent` FROM `user_activities` WHERE user_id = $user_id AND date >= '$fromDate' AND date <= '$toDate'
                                    ORDER BY `date`) data 
                                    GROUP BY data.date");
        $result = $query->result_array();
        return $result;
    }

    public function getcaloriesReport($data = array())
    {
        $user_id = $data['user_id'];
        $fromDate = date('Y-m-d',strtotime($data['fromDate']));
        $toDate = date('Y-m-d',strtotime($data['toDate']));

        $query = $this->db->query("SELECT data.date,SUM(data.calories_spent) AS calories_spent, `meal`.`calories_taken` 
                                    FROM 
                                    (SELECT `date`,`calories_spent` FROM `user_exercise` WHERE user_id = $user_id AND date >= '$fromDate' AND date <= '$toDate'
                                    UNION ALL
                                    SELECT `date`,`calories_spent` FROM `user_activities` WHERE user_id = $user_id AND date >= '$fromDate' AND date <= '$toDate'
                                    ORDER BY `date`) data LEFT JOIN `meal` ON meal.sdate = data.date GROUP BY data.date");
        $result = $query->result_array();
        return $result;
    }

}