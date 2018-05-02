<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription extends CI_Controller {

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
			 	$this->load->model('prescriptiondata');
			 	$this->load->model('userdata');
			 	$this->load->model('doctordata');
			}else{
				redirect('login', 'refresh');
			}
		}


	public function index()
	{
		$data['prescriptionData']=$this->prescriptiondata->getRows();
		$data['title'] = "Prescription List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/prescriptionlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/prescriptionjs.php');
	}


	public function addPrescription()
	{

		$data['title'] = "Add Prescription";
		$data['userData']=$this->userdata->getRows();
		$data['doctorData']=$this->doctordata->getRows();
		$this->load->view('backend/header', $data);

		$this->load->view('backend/sidebar');

		$this->load->view('backend/prescriptionadd', $data);

		$this->load->view('backend/footer');
		$this->load->view('backend/prescriptionjs.php');


	}

	

	public function getTime() {
		$data = $_POST['data'];
		$getdata=$this->prescriptiondata->getTime($data);
		echo json_encode($getdata['time']);
	}

	public function savePrescription() {
		
		$userId = $_POST['data']['user_id'];
		$doctorId = $_POST['data']['doctor_id'];
		$ddate = date('Y-m-d',strtotime($_POST['data']['ddate']));
		
		for($i=0;$i<count($_POST['dosedetails']);$i++){
			$DrugName = $_POST['dosedetails'][$i]['DrugName'];
			$Days = $_POST['dosedetails'][$i]['Days'];
			$Takeat = $_POST['dosedetails'][$i]['Takeat'];
			$data=array(
				'user_id' => $userId,
				'doctor_id' => $doctorId,
				'date' => $ddate,
				'drug_name' => $DrugName,
				'duration_days' => $Days,
				'dose_details' => $Takeat,
		  		'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s')
	  		);
		    $msg=$this->prescriptiondata->insert($data);
		    if($msg == "success"){
		    	echo "success";
		    }else{
		    	echo "error";
		    }
		}

	}

	


}
