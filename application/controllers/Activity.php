<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

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
			 	$this->load->model('userdata');
			 	$this->load->model('activitydata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['activityData']=$this->activitydata->getRows();
		$data['title'] = "Activity List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/activitylist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/activityjs.php');
	}


	public function addactivity()
	{
		$data['title'] = "Add Activity";
		$getdata['getactivityData']= array();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/activityadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/activityjs.php');
	}

	public function editactivity($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update Activity";
	    $getdata['getactivityData']=$this->activitydata->getRowedit($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/activityedit', $getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/activityjs.php');    
	}

	public function saveactivity() {
		$this->form_validation->set_rules('activity_name', 'Activity Name', 'trim|required');
		$this->form_validation->set_rules('calories_spent', 'Calories spent', 'required|regex_match[/^0*[1-9]\d*$/]');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getactivityData']= array(
					'id' => $_POST['id'],
					'activity_name'=>$_POST['activity_name'],
				    'calories_spent'=>$_POST['calories_spent']
				);
				$data['title'] = "Update Activity";
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/activityedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/activityjs.php');
	            return false;
	        }
			$data=array(      
		      	'activity_name'=>$_POST['activity_name'],
			    'calories_spent'=>$_POST['calories_spent']
		    );
			$msg=$this->activitydata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success','Activity updated successfully');
				redirect('activity');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('activity/editactivity/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add Activity";
	        	$getdata['getactivityData']= array();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/activityadd',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/activityjs.php');
	            return false;
	        }
			$data=array(      
		      	'activity_name'=>$_POST['activity_name'],
			    'calories_spent'=>$_POST['calories_spent']
		    );
			$msg=$this->activitydata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success','Activity added successfully', 'success');
				redirect('activity');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('activity/addactivity');
			}
		}
	}


	public function deleteactivity() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID']
  		);
	    $msg=$this->activitydata->deleteactivity($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success','Activity deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  	
}
