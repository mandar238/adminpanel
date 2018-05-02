<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

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
			 	$this->load->model('doctordata');
			 	$this->load->model('userdata');
			}else{
				redirect('login', 'refresh');
			}
		}


	public function index()
	{
		$data['doctorData']=$this->doctordata->getRows();
		$data['title'] = "Doctor List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/doctorlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/doctorjs.php');
	}


	public function addDoctor()
	{
		$data['title'] = "Add Doctor";
		$getdata['getdoctordata']= array();
		$getdata['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/doctoradd',$getdata);
		$this->load->view('backend/footer');

	}

	public function editDoctor($id) {
	    $data= array('id'=>$id);  
	    $getdata['userData']=$this->userdata->getRows();
	    $data1['title'] = "Update Doctor";
	    $getdata['getdoctordata']=$this->doctordata->getRow($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/doctoredit', $getdata);
		$this->load->view('backend/footer');
	    
	}

	public function saveDoctor() {
		$this->form_validation->set_rules('user_id', 'Patient Name', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'last Name', 'trim|required');
		$this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact_no', 'Mobile Number ', 'required|regex_match[/^[789]\d{9}$/]');
		

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getdoctordata']= array(
					'id' => $_POST['id'],
					'fname'=>$_POST['fname'],
				    'lname'=>$_POST['lname'],
				    'email_id'=>$_POST['email_id'],
				    'contact_no'=>$_POST['contact_no'],
				    'user_id' => $_POST['user_id']
				);
				$data['title'] = "Update Doctor";
				$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/doctoredit',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
				'user_id' => $_POST['user_id'],
		      	'fname'=>ucfirst($_POST['fname']),
			    'lname'=>ucfirst($_POST['lname']),
			    'email_id'=>$_POST['email_id'],
			    'contact_no'=>$_POST['contact_no'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->doctordata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'Doctor updated successfully');
				redirect('doctor');
			}else{
				$this->session->set_flashdata('error', 'Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('doctor/editDoctor/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add Doctor";
	        	$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/doctoradd', $getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
				'user_id' => $_POST['user_id'],
		      	'fname'=>ucfirst($_POST['fname']),
			    'lname'=>ucfirst($_POST['lname']),
			    'email_id'=>$_POST['email_id'],
			    'contact_no'=>$_POST['contact_no'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s'),
		    );
			$msg=$this->doctordata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success', 'Doctor added successfully');
				redirect('doctor');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('doctor/addDoctor');
			}
		}
	}


	public function deleteDoctor() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->doctordata->deleteDoctor($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success', 'Doctor deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}
}
