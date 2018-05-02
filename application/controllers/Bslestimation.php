<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bslestimation extends CI_Controller {

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
			 	$this->load->model('bslestimationdata');
			 	$this->load->model('userdata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['bslestimationdata']=$this->bslestimationdata->getRows();
		$data['title'] = "BSL Estimation List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/bslestimationlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/bslestimationjs.php');
	}


	public function addBslestimation()
	{
		$data['title'] = "Add BSL Estimation";
		$getdata['userData']=$this->userdata->getRows();
		$getdata['getbslestimationdata']= array();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/bslestimationadd',$getdata);
		$this->load->view('backend/footer');

	}

	public function editBslestimation($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update BSL Estimation";
	    $getdata['userData']=$this->userdata->getRows();
	    $getdata['getbslestimationdata']=$this->bslestimationdata->getRow($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/bslestimationedit', $getdata);
		$this->load->view('backend/footer');
	    
	}

	public function saveBslestimation() {
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('bsl_value', 'BSL value', 'trim|required|regex_match[/^0*[1-9]\d*$/]');
		$this->form_validation->set_rules('user_id', 'Patient Name', 'trim|required');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getbslestimationdata']= array(
					'id' => $_POST['id'],
				    'date'=>$_POST['date'],
				    'time'=>$_POST['time'],
				    'bsl_value'=>$_POST['bsl_value'],
				    'user_id'=>$_POST['user_id']
				);
				$data['title'] = "Update BSL Estimation";
				$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/bslestimationedit',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'user_id'=>$_POST['user_id'],
			    'time'=>$_POST['time'],
			    'bsl_value'=>$_POST['bsl_value'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->bslestimationdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'BSL Estimation Updated successfully');
				redirect('bslestimation');
			}else{
				$id = $_POST['id'];
				$this->session->set_flashdata('Something is wrong, please try again', 'error');
				redirect('bslestimation/editBslestimation/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add BSL Estimation";
	        	$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/bslestimationadd',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
		      	'user_id'=>$_POST['user_id'],
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'time'=>$_POST['time'],
			    'bsl_value'=>$_POST['bsl_value'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s'),
		    );
			$msg=$this->bslestimationdata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success', 'BSL Estimation Added successfully');
				redirect('bslestimation');
			}else{
				$this->session->set_flashdata('error', 'Something is wrong, please try again');
			    redirect('bslestimation/addBslestimation');
			}
		}
	}


	public function deleteBslestimation() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->bslestimationdata->deleteBslestimation($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success', 'BSL Estimation Deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  	public function getreportData() {
  		if(!empty($_POST)){
  			$dates = $values = $results = array();
  			$result=$this->bslestimationdata->getreportData($_POST);
  			for($i=0;$i<count($result);$i++)
			{
				$datestime = date('d-M',strtotime($result[$i]['date'])).' @ '.$result[$i]['time'];
				$results[$datestime][] = (int)$result[$i]['bsl_value'];

			}
			foreach ($results as $key => $value) {
				$dates[] = $key;
				$values[] = $value;
			}
			
			$resultArr = array('success' => true,'dates' => $dates, 'values' => $values);
			echo json_encode($resultArr);
  		}else{
  			$resultArr = array('success' => false);
  			echo json_encode($resultArr);
  		}
  	}
}
