<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hbaestimation extends CI_Controller {

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
			 	$this->load->model('hbaestimationdata');
			 	$this->load->model('userdata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['hbaestimationdata']=$this->hbaestimationdata->getRows();
		$data['title'] = "HBA1c Estimation List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/hbaestimationlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/hbaestimationjs.php');
	}


	public function addHbaestimation()
	{
		$data['title'] = "Add HBA1c Estimation";
		$getdata['gethbaestimationdata']= array();
		$getdata['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/hbaestimationadd',$getdata);
		$this->load->view('backend/footer');

	}

	public function editHbaestimation($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update HBA1c Estimation";
	    $getdata['gethbaestimationdata']=$this->hbaestimationdata->getRow($data);
	    $getdata['userData']=$this->userdata->getRows();
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/hbaestimationedit', $getdata);
		$this->load->view('backend/footer');
	    
	}

	public function saveHbaestimation() {
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('user_id', 'Patient Name', 'trim|required');
		$this->form_validation->set_rules('hba_value', 'HBA1c value', 'trim|required|regex_match[/^0*[1-9]\d*$/]');
		

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['gethbaestimationdata']= array(
					'id' => $_POST['id'],
				    'date'=>$_POST['date'],
				    'time'=>$_POST['time'],
				    'hba_value'=>$_POST['hba_value'],
				    'user_id'=>$_POST['user_id']
				);
				$data['title'] = "Update HBA Estimation";
				$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/hbaestimationedit',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'time'=>$_POST['time'],
			    'hba_value'=>$_POST['hba_value'],
			    'user_id'=>$_POST['user_id'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->hbaestimationdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'HBA1c updated successfully');
				redirect('hbaestimation');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('hbaestimation/edithbaestimation/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add HBA1c Estimation";
	        	$getdata['userData']=$this->userdata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/hbaestimationadd',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
		      	'user_id'=> 1,
			    'date'=>date('Y-m-d',strtotime($_POST['date'])),
			    'time'=>$_POST['time'],
			    'hba_value'=>$_POST['hba_value'],
			    'user_id'=>$_POST['user_id'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s'),
		    );
			$msg=$this->hbaestimationdata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success', 'HBA1c updated successfully');
				redirect('hbaestimation');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('hbaestimation/addhbaestimation');
			}
		}
	}


	public function deleteHbaestimation() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->hbaestimationdata->deleteHbaestimation($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success', 'HBA1c deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('Something is wrong, please try again', 'error');
	    	return 'error';
	    }
  	}


  	public function getreportData() {
  		if(!empty($_POST)){
  			$dates = $values = $results = array();
  			$result=$this->hbaestimationdata->getreportData($_POST);
  			for($i=0;$i<count($result);$i++)
			{
				$datestime = date('d-M',strtotime($result[$i]['date'])).' @ '.$result[$i]['time'];
				$results[$datestime][] = (int)$result[$i]['hba_value'];

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
