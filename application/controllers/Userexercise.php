<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userexercise extends CI_Controller {

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
			 	$this->load->model('userexercisedata');
			 	$this->load->model('userdata');
			 	$this->load->model('exercisedata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['userexerciseData']=$this->userexercisedata->getRows();
		$data['title'] = "User Exercise List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/userexerciselist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/userexercisejs.php');
	}


	public function addUserexercise()
	{
		$data['title'] = "Add User Exercise";
		$getdata['getuserexerciseData']= array();
		$getdata['userData']=$this->userdata->getRows();
		$getdata['exerciseData']=$this->exercisedata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/userexerciseadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/userexercisejs.php');

	}

	public function editUserexercise($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update User Exercise";
	    $getdata['getuserexerciseData']=$this->userexercisedata->getRow($data);
	    $getdata['userData']=$this->userdata->getRows();
	    $getdata['exerciseData']=$this->exercisedata->getRows();
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/userexerciseedit', $getdata);
		$this->load->view('backend/footer');
	    $this->load->view('backend/userexercisejs.php');
	}

	public function saveUserexercise() {
		$this->form_validation->set_rules('exercise_id', 'Exercise', 'trim|required');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required|regex_match[/^0*[1-9]\d*$/]');
		$this->form_validation->set_rules('calories_spent', 'Calories spent', 'required|regex_match[/^0*[1-9]\d*$/]');
		$this->form_validation->set_rules('user_id', 'Patient Name', 'trim|required');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getuserexerciseData']= array(
					'id' => $_POST['id'],
					'exercise_id'=>$_POST['exercise_id'],
				    'date'=>$_POST['date'],
				    'duration'=>$_POST['duration'],
				    'calories_spent'=>$_POST['calories_spent'],
				    'user_id' =>$_POST['user_id']
				);
				$data['title'] = "Update User Exercise";
				$getdata['userData']=$this->userdata->getRows();
				$getdata['exerciseData']=$this->exercisedata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/userexerciseedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/userexercisejs.php');
	            return false;
	        }
			$data=array(      
		      	'exercise_id'=>$_POST['exercise_id'],
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'duration'=>$_POST['duration'],
			    'user_id' =>$_POST['user_id'],
			    'calories_spent'=>$_POST['calories_spent'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->userexercisedata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success','User exercise updated successfully');
				redirect('userexercise');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('userexercise/editUserexercise/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add User Exercise";
	        	$getdata['userData']=$this->userdata->getRows();
	        	$getdata['exerciseData']=$this->exercisedata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/userexerciseadd',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/userexercisejs.php');
	            return false;
	        }
			$data=array(      
		      	'exercise_id'=>$_POST['exercise_id'],
		      	'user_id' =>$_POST['user_id'],
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'duration'=>$_POST['duration'],
			    'calories_spent'=>$_POST['calories_spent'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->userexercisedata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success','User exercise added successfully');
				redirect('userexercise');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('userexercise/addUserexercise');
			}
		}
	}


	public function deleteUserexercise() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->userexercisedata->deleteUserexercise($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success','User exercise deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  	public function getExercise() {
		$exercise_id= $_POST['exercise_id'];
	  	$data=array(
	  		'id' => $exercise_id
  		);
	    $result=$this->exercisedata->getRow($data);
	    echo json_encode($result);
	}
}
