<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercise extends CI_Controller {

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
			 	$this->load->model('exercisedata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['exercisedata']=$this->exercisedata->getRows();
		$data['title'] = "Exercise List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/exerciselist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/exercisejs.php');
	}


	public function addexercise()
	{
		$data['title'] = "Add Exercise";
		$getdata['getexerciseData']= array();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/exerciseadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/exercisejs.php');
	}

	public function editexercise($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update Exercise";
	    $getdata['getexerciseData']=$this->exercisedata->getRowedit($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/exerciseedit', $getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/exercisejs.php');    
	}

	public function saveExercise() {
		$this->form_validation->set_rules('exercise_name', 'Exercise Name', 'trim|required');
		$this->form_validation->set_rules('calories_spent', 'Calories spent', 'required|regex_match[/^0*[1-9]\d*$/]');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getexerciseData']= array(
					'id' => $_POST['id'],
					'exercise_name'=>$_POST['exercise_name'],
				    'calories_spent'=>$_POST['calories_spent']
				);
				$data['title'] = "Update Exercise";
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/exerciseedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/exercisejs.php');
	            return false;
	        }
			$data=array(      
		      	'exercise_name'=>$_POST['exercise_name'],
			    'calories_spent'=>$_POST['calories_spent']
		    );
			$msg=$this->exercisedata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success','Exercise updated successfully');
				redirect('exercise');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('exercise/editexercise/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add Exercise";
	        	$getdata['getexerciseData']= array();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/exerciseadd',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/exercisejs.php');
	            return false;
	        }
			$data=array(      
		      	'exercise_name'=>$_POST['exercise_name'],
			    'calories_spent'=>$_POST['calories_spent']
		    );
			$msg=$this->exercisedata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success','Exercise added successfully', 'success');
				redirect('exercise');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('exercise/addexercise');
			}
		}
	}


	public function deleteexercise() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID']
  		);
	    $msg=$this->exercisedata->deleteexercise($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success','Exercise deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  	

}
