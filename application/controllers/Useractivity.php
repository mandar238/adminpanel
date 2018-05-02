<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useractivity extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


		function __construct() {
			parent::__construct();
			$user = $this->session->userdata;
			if(isset($user['USER_NAME'])){
			 	$this->load->model('useractivitydata');
			 	$this->load->model('userdata');
			 	$this->load->model('activitydata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['useractivityData']=$this->useractivitydata->getRows();
		$data['title'] = "User Activity List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/useractivitylist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/useractivityjs.php');
	}


	public function addUseractivity()
	{
		$data['title'] = "Add User Activity";
		$getdata['getuseractivityData']= array();
		$getdata['userData']=$this->userdata->getRows();
		$getdata['activityData']=$this->activitydata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/useractivityadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/useractivityjs.php');

	}

	public function editUseractivity($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update User Activity";
	    $getdata['userData']=$this->userdata->getRows();
	    $getdata['activityData']=$this->activitydata->getRows();
	    $getdata['getuseractivityData']=$this->useractivitydata->getRow($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/useractivityedit', $getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/useractivityjs.php');
	    
	}

	public function saveUseractivity() {
		$this->form_validation->set_rules('activity_id', 'Activity', 'trim|required');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required|regex_match[/^0*[1-9]\d*$/]');
		$this->form_validation->set_rules('calories_spent', 'Calories spent', 'required|regex_match[/^0*[1-9]\d*$/]');
		$this->form_validation->set_rules('user_id', 'Patient Name', 'trim|required');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getuseractivityData']= array(
					'id' => $_POST['id'],
					'activity_id'=>$_POST['activity_id'],
				    'date'=>$_POST['date'],
				    'duration'=>$_POST['duration'],
				    'calories_spent'=>$_POST['calories_spent'],
				    'user_id' =>$_POST['user_id']
				);
				$data['title'] = "Update User Activity";
				$getdata['userData']=$this->userdata->getRows();
				$getdata['activityData']=$this->activitydata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/useractivityedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/useractivityjs.php');
	            return false;
	        }
			$data=array(      
		      	'activity_id'=>$_POST['activity_id'],
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'duration'=>$_POST['duration'],
			    'calories_spent'=>$_POST['calories_spent'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->useractivitydata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success','User activity updated successfully');
				redirect('useractivity');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('useractivity/editUseractivity/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add User Activity";
	        	$getdata['userData']=$this->userdata->getRows();
	        	$getdata['activityData']=$this->activitydata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/useractivityadd',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/useractivityjs.php');
	            return false;
	        }
			$data=array(      
		      	'activity_id'=>$_POST['activity_id'],
		      	'user_id' =>$_POST['user_id'],
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'duration'=>$_POST['duration'],
			    'calories_spent'=>$_POST['calories_spent'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s'),

		    );
			$msg=$this->useractivitydata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success','User activity updated successfully', 'success');
				redirect('useractivity');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('useractivity/addUseractivity');
			}
		}
	}


	public function deleteUseractivity() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->useractivitydata->deleteUseractivity($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success','User activity deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  	public function getActivity() {
		$activity_id= $_POST['activity_id'];
	  	$data=array(
	  		'id' => $activity_id
  		);
	    $result=$this->activitydata->getRow($data);
	    echo json_encode($result);
	}

}
