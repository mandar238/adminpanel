<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedulesetting extends CI_Controller {

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
			 	$this->load->model('schedulesettingdata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['schedulesettingdata']=$this->schedulesettingdata->getRows();
		$data['title'] = "Schedule Setting List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/schedulesettinglist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/bslestimationjs.php');
	}


	public function editSchedulesetting($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update Schedule Setting";
	    $getdata['getschedulesettingdata']=$this->schedulesettingdata->getRow($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/schedulesettingedit', $getdata);
		$this->load->view('backend/footer');
	    
	}

	public function saveSchedulesetting() {
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('part_day', 'Part Day', 'required');
		

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getschedulesettingdata']= array(
					'id' => $_POST['id'],
				    'part_day'=>$_POST['part_day'],
				    'time'=>$_POST['time']
				);
				$data['title'] = "Update BSL Estimation";
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/schedulesettingedit',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
			    'time'=>$_POST['time'],
			    'part_day'=>$_POST['part_day']
		    );
			$msg=$this->schedulesettingdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'Schedule Setting Updated successfully');
				redirect('schedulesetting');
			}else{
				$id = $_POST['id'];
				$this->session->set_flashdata('Something is wrong, please try again', 'error');
				redirect('schedulesetting/editSchedulesetting/'.$id);
			}
		}
	}

}
