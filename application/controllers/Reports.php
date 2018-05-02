<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
			 	$this->load->model('mealdata');
			 	$this->load->model('userdata');
			 	$this->load->model('userexercisedata');
			 	$this->load->model('useractivitydata');
			 	$this->load->model('bslestimationdata');
			 	$this->load->model('hbaestimationdata');
			 	$this->load->model('prescriptiondata');
			 	$this->load->model('itemdata', 'import');
			 	$this->load->model('citydata');

			}else{
				redirect('login', 'refresh');
			}
		}

	public function bslreportform(){
  		$data['title'] = "BSL Estimation Report";
		$getdata['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/bslestimationreport',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/bslestimationchartjs.php');
  	}

  	public function userreportform(){
  		$data['title'] = "User Report";
  		$getdata['userreportData']= array();
  		$getdata['cityData']=$this->citydata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/userreport',$getdata);
		$this->load->view('backend/footer');
  	}

  	public function hbareportform(){
  		$data['title'] = "HBA1c Estimation Report";
		$getdata['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/hbaestimationreport',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/hbachartjs.php');
  	}

  	public function caloriesreportform(){
  		$data['title'] = "Calories Balance Report";
		$getdata['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/caloriesreport',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/calorieschartjs.php');
  	}


  	public function getcaloriesData() {
  		if(!empty($_POST)){
  			$mdates = $mvalues = array();
  			$adates = $avalues = array();
  			$mresult=$this->mealdata->getcaloriesData($_POST);

  			for($i=0;$i<count($mresult);$i++)
			{
				$mdates[] = date('d-M',strtotime($mresult[$i]['sdate']));
				$mvalues[] = (int)$mresult[$i]['calories_taken'];
			}

			$aresult=$this->useractivitydata->getcaloriesData($_POST);
			
  			for($i=0;$i<count($aresult);$i++)
			{
				$adates[] = date('d-M',strtotime($aresult[$i]['date']));
				$avalues[] = (int)$aresult[$i]['calories_spent'];
			}
			if(count($adates) > count($mdates)){
				$getdates = array_unique($adates);
				$resultArr = array('success' => true,'mdates' => $getdates, 'mvalues' => $mvalues, 'avalues' => $avalues);
			} else if(count($adates) < count($mdates)){
				$getdates = array_unique($mdates);
				$resultArr = array('success' => true,'mdates' => $getdates, 'mvalues' => $mvalues, 'avalues' => $avalues);
			} else {
				$getdates = array_unique($mdates);
				$resultArr = array('success' => true,'mdates' => $getdates, 'mvalues' => $mvalues, 'avalues' => $avalues);
			}
			
			echo json_encode($resultArr);
  		}else{
  			$resultArr = array('success' => false);
  			echo json_encode($resultArr);
  		}
  	}



  	public function generateBslReport()
  	{
  		
  		$data['title'] = "BSL Report";
  		$data1= array('id'=>$_POST['user_id']);  
	    $getdata['userData']=$this->userdata->getRow($data1);
	    $getdata['bslreportData']=$this->bslestimationdata->getreportData($_POST);
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/bslreportview',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/bslestimationchartjs.php');
  	}

  	public function generateUserReport()
  	{
  		
  		if(empty($_POST['gender']) && empty($_POST['lifestyle']) && empty($_POST['user_status']) && empty($_POST['city_id'])){
  			
	  		$this->session->set_flashdata('error','Please apply atleast one filter');
			redirect('reports/userreportform');
		}else{

			$condition = '';
			$data['title'] = "User Report";
	  		if(!empty($_POST['gender'])){
	  			$gender = $_POST['gender'];
	  			$condition .= "users.gender ='$gender'"; 
	  		}
	  		if(!empty($_POST['lifestyle'])){
	  			$lifestyle = $_POST['lifestyle'];
	  			
	  			if(!empty($_POST['gender'])){
	  				$condition .= " AND users.lifestyle ='$lifestyle'";
	  			}else{
	  				$condition .= "users.lifestyle ='$lifestyle'";
	  			}
	  		}
	  		 if(!empty($_POST['user_status'])){
	  		 	if($_POST['user_status'] != 2){
	  				$user_status = $_POST['user_status'];
	  			}else{
	  				$user_status = 0;
	  			}
	  			if(!empty($_POST['gender']) || !empty($_POST['lifestyle'])){
	  				$condition .= " AND users.user_status =$user_status";
	  			}else{
	  				$condition .= "users.user_status =$user_status";
	  			}
	  		}
	  		 if(!empty($_POST['city_id'])){
	  			$city_id = $_POST['city_id'];
	  			if(!empty($_POST['gender']) || !empty($_POST['lifestyle']) || !empty($_POST['user_status'])){
	  				$condition .= " AND users.city_id =$city_id";
	  			}else{
	  				$condition .= "users.city_id =$city_id";
	  			}
	  		}
	  		
		    $getdata['userreportData']=$this->userdata->getreportData($condition);
		    $getdata['cityData']=$this->citydata->getRows();
			$this->load->view('backend/header', $data);
			$this->load->view('backend/sidebar');
			$this->load->view('backend/userreport',$getdata);
			$this->load->view('backend/footer');
			
		}
  	}


  	public function userReportPDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 
 
		//now pass the data//
	    	$condition = '';
			$data['title'] = "User Report";
	  		if(!empty($_POST['gender'])){
	  			$gender = $_POST['gender'];
	  			$condition .= "users.gender ='$gender'"; 
	  		}
	  		if(!empty($_POST['lifestyle'])){
	  			$lifestyle = $_POST['lifestyle'];
	  			
	  			if(!empty($_POST['gender'])){
	  				$condition .= " AND users.lifestyle ='$lifestyle'";
	  			}else{
	  				$condition .= "users.lifestyle ='$lifestyle'";
	  			}
	  		}
	  		 if(!empty($_POST['user_status'])){
	  		 	if($_POST['user_status'] != 2){
	  				$user_status = $_POST['user_status'];
	  			}else{
	  				$user_status = 0;
	  			}
	  			if(!empty($_POST['gender']) || !empty($_POST['lifestyle'])){
	  				$condition .= " AND users.user_status =$user_status";
	  			}else{
	  				$condition .= "users.user_status =$user_status";
	  			}
	  		}
	  		 if(!empty($_POST['city_id'])){
	  			$city_id = $_POST['city_id'];
	  			if(!empty($_POST['gender']) || !empty($_POST['lifestyle']) || !empty($_POST['user_status'])){
	  				$condition .= " AND users.city_id =$city_id";
	  			}else{
	  				$condition .= "users.city_id =$city_id";
	  			}
	  		}
	  		
		    $userreportData=$this->userdata->getreportData($condition);

  			

		
		$pdfFilePath = "Users-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

	    if(!empty($userreportData))
	    {
	    
	        $count = 1;
	        foreach ($userreportData as $key => $value) {
	    	if($value['user_status'] == 1){
	    		$status= "Active";
	    	}else{
	    		$status= "Inactive";
	    	}
            $html.="<tr>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    <div>
                                <span>
                                    ".$value['username']."
                                </span>
                                <br>
                                <span class='f-s-12'>
                                   ".$value['email_id']."
                                </span>
                                <span class='f-s-12'>
                                    ".$value['mobile_no']."
                                </span>
                            </div>
		                </td>
		                
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    ".$value['gender']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    ".date('d-M-Y',strtotime($value['birthdate']))."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    Weigth :".$value['weight']."<br>
		                    Height :".$value['height']."
		                </td>

		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    ".$value['city_name']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    ".$value['lifestyle']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;'>
		                    ".$status."
		                </td>
		            </tr>";

                  $count++;
          	}
        }

        $pdf->WriteHTML(
			'<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>User List Report</title>
				
				<style>
					.table-bord,.table-bord th,.table-bord td{
						border:1px solid #ddd;
						border-collapse: collapse;
						padding: 3px;
					}
					
					.bord-div{
					        *border-top: 1px solid #000;
					        *border-left: 1px solid #000;
					        *border-right: 1px solid #000;
					}
				</style>
				</head>
				<body>
                    <table width="700" class="bord-div"  align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="padding: 0px;">
                        <tbody>
                            <tr>
                                <td width="100%">
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #000;width: 120px;" align="center">
                                                                        
                                                                </td>
                                                                <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 700;border-bottom: 1px solid #000; " st-title="fulltext-title">
                                                                    <h4 style="margin-top: 10px;">Users List Report</h4>
                                                                </td>
                                                            	<td style="border-bottom: 1px solid #000;" align="center">
                                                                </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td>	</tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" height="10"> &nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr style="height: 35px;background: rgba(236, 236, 236, 0.49)";>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                       	<thead>
		                                                   	<tr>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Sr.No.</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>User Details</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Gender</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Date Of Birth</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Weight/Height</th>
		                                                        
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>City</th>
		                                                   		<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Lifestyle</th>
		                                                   		<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Status</th>
		                                                   	</tr>
                                                       	</thead>
                                                        <tbody>'.
                                                        	$html.'
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
        </html>');
		$pdf->Output($pdfFilePath, "D");
                                            
		//generate the PDF!
		
		//offer it to user via browser download! (Th
  	}


  	public function generateHbaReport()
  	{
  		
  		$data['title'] = "HBA1c Report";
  		$data1= array('id'=>$_POST['user_id']);  
	    $getdata['userData']=$this->userdata->getRow($data1);
	    $getdata['hbareportData']=$this->hbaestimationdata->getreportData($_POST);
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/hbareportview',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/hbachartjs.php');
  	}


  	public function getcaloriesReport() {
  		if(!empty($_POST)){
  			$mdates = $mvalues = array();
  			$adates = $avalues = array();
  			$mresult=$this->useractivitydata->getcaloriesReport($_POST);

  			

			$data1= array('id'=>$_POST['user_id']);  
	    	$getdata['userData']=$this->userdata->getRow($data1);
	    	$getdata['caloriesData'] = $mresult;

			$data['title'] = "Calories Balance Report";
			$this->load->view('backend/header', $data);
			$this->load->view('backend/sidebar');
			$this->load->view('backend/caloriesreportview',$getdata);
			$this->load->view('backend/footer');
			$this->load->view('backend/calorieschartjs.php');
  		}
  	}


  	public function prescriptionReport()
  	{
  		
  		$data['title'] = "Prescription Report";
  		$getdata['userData']=$this->userdata->getRows();
  		//$data1= array('id'=>$_POST['user_id']);  
	    //$getdata['userData']=$this->userdata->getRow($data1);
	    //$getdata['prescriptionData']=$this->prescriptiondata->getreportData($_POST);
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/prescriptionreportview',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/prescriptionjs.php');
  	}

  	public function generateprescriptionReport()
  	{
  		
  		$data['title'] = "Prescription Report";
  		//$getdata['userData']=$this->userdata->getRows();
  		$data1= array('id'=>$_POST['user_id']);  
	    $getdata['userData']=$this->userdata->getRow($data1);
	    $getdata['prescriptionData']=$this->prescriptiondata->getreportData($_POST);
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		
		$this->load->view('backend/footer');
		$this->load->view('backend/prescriptionreport',$getdata);
		//$this->load->view('backend/prescriptionjs.php');
  	}


  	public function caloriesBalancePDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 
 
		//now pass the data//
	    $mresult=$this->useractivitydata->getcaloriesReport($_POST);

  			

		$data1= array('id'=>$_POST['user_id']);  
    	$userData=$this->userdata->getRow($data1);
    	$caloriesData = $mresult;
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$getdata, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath =ucfirst($userData['username'])."Calories-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

        if(!empty($caloriesData))
     	{
    
	        $count = 1;
	        foreach ($caloriesData as $key => $value) {
	    
	            $html.="<tr>
			                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
			                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
			                    ".date('d-M-Y',strtotime($value['date']))."
			                </td>
			                
			                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
			                    ".$value['calories_taken']."
			                </td>
			                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
			                    ".$value['calories_spent']."
			                </td>
			            </tr>";

	                  $count++;
	      	}
     	}
                                            
		//generate the PDF!
		$pdf->WriteHTML(
			'<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Calories Balance Report</title>
				
				<style>
					.table-bord,.table-bord th,.table-bord td{
						border:1px solid #ddd;
						border-collapse: collapse;
						padding: 3px;
					}
					
					.bord-div{
					        *border-top: 1px solid #000;
					        *border-left: 1px solid #000;
					        *border-right: 1px solid #000;
					}
				</style>
				</head>
					<body>
                        <table width="700" class="bord-div"  align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="padding: 0px;">
                            <tbody>
	                            <tr>
                                    <td width="100%">
                                        <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                            <tbody>
                                                <tr>
                                                    <td width="100%" height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td width="700">
                                                        <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                                                            <tbody>
                                                                <!-- title -->
                                                                <tr>
                                                                    <td style="border-bottom: 1px solid #000;width: 120px;" align="center">
                                                                            
                                                                    </td>
                                                                    <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 700;border-bottom: 1px solid #000; " st-title="fulltext-title">
                                                                            <h4 style="margin-top: 10px;">Calories Balance Report</h4>
                                                                    </td>
                                                                    <td style="border-bottom: 1px solid #000;" align="center">
                                                                    </td>
                                                                </tr>
                                                                <tr><td>&nbsp;</td></tr>
                                                                <!-- end of title -->
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="10"> &nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                            <tbody>
                                                <tr>
                                                	<td width="100%" height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td width="700">
                                                        <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                            <tbody>
                                                                <!-- title -->
                                                                <tr>
                                                                    <td style="width:350px;">
                                                                            <b>Patient Name&nbsp;:&nbsp;</b>
                                                                            <span>' . ucfirst($userData['username']) . '</span>
                                                                    </td>
                                                                    <td style="width:350px;text-align: right;">
                                                                            <b>Contact No&nbsp;:&nbsp;</b>' . $userData['mobile_no'] . '
                                                                    </td>
                                                                </tr>
                                                                <!-- end of title -->
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
	                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
	                                        <tbody>
	                                            <tr>
	                                                <td width="700">
	                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
	                                                        <tbody>
	                                                            <!-- title -->
	                                                            <tr>
	                                                                <td style="width: 350px;">
	                                                                        <b>Date from&nbsp;:&nbsp;</b>' . $_POST['fromDate'] . '<b>&nbsp;to&nbsp;</b>'.$_POST['toDate'].'
	                                                                </td>
	                                                                <td style="width: 350px;text-align: right;">
	                                                                        <b>Date&nbsp;:&nbsp;</b>' . date('d-m-Y') . '
	                                                                </td>
	                                                            </tr>
	                                                            <!-- end of title -->
	                                                        </tbody>
	                                                    </table>
	                                                </td>
	                                            </tr>
	                                        </tbody>
	                                    </table>
	                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
	                                        <tbody>
	                                            <tr style="height: 35px;background: rgba(236, 236, 236, 0.49)";>
	                                                <td width="700">
	                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
	                                                       	<thead>
		                                                       	<tr>
			                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Sr.No.</th>
			                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Date</th>
			                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;color:blue;">Calories Gained</th>
			                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;color:red;">Calories Burnt</th>
		                                                       	</tr>
	                                                       	</thead>
	                                                        <tbody>'.
	                                                        	$html.'
	                                                        </tbody>
	                                                    </table>
	                                                </td>
	                                            </tr>
	                                        </tbody>
	                                    </table>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </body>
	        </html>');
			$pdf->Output($pdfFilePath, "D");
		//offer it to user via browser download! (Th
  	}



	public function bslPDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 
 
		//now pass the data//
	    $bslreportData=$this->bslestimationdata->getreportData($_POST);

  			

		$data1= array('id'=>$_POST['user_id']);  
    	$userData=$this->userdata->getRow($data1);
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$getdata, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath =ucfirst($userData['username'])."BSL-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

	    if(!empty($bslreportData))
	    {
	    
	        $count = 1;
	        foreach ($bslreportData as $key => $value) {
	    
            $html.="<tr>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".date('d-M-Y',strtotime($value['date']))."
		                </td>
		                
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".$value['time']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".$value['bsl_value']."
		                </td>
		            </tr>";

                  $count++;
          	}
        }
                                            
		//generate the PDF!
		$pdf->WriteHTML(
			'<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>BSL Report</title>
				
				<style>
					.table-bord,.table-bord th,.table-bord td{
						border:1px solid #ddd;
						border-collapse: collapse;
						padding: 3px;
					}
					
					.bord-div{
					        *border-top: 1px solid #000;
					        *border-left: 1px solid #000;
					        *border-right: 1px solid #000;
					}
				</style>
				</head>
				<body>
                    <table width="700" class="bord-div"  align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="padding: 0px;">
                        <tbody>
                            <tr>
                                <td width="100%">
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #000;width: 120px;" align="center">
                                                                        
                                                                </td>
                                                                <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 700;border-bottom: 1px solid #000; " st-title="fulltext-title">
                                                                    <h4 style="margin-top: 10px;">BSL Report</h4>
                                                                </td>
                                                            	<td style="border-bottom: 1px solid #000;" align="center">
                                                                </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td>	</tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" height="10"> &nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width:350px;">
                                                                        <b>Patient Name&nbsp;:&nbsp;</b>
                                                                        <span>' . ucfirst($userData['username']) . '</span>
                                                                </td>
                                                        
                                                                <td style="width:350px;text-align: right;">
                                                                        <b>Contact No&nbsp;:&nbsp;</b>' . $userData['mobile_no'] . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width: 350px;">
                                                                        <b>Date from&nbsp;:&nbsp;</b>' . $_POST['fromDate'] . '<b>&nbsp;to&nbsp;</b>'.$_POST['toDate'].'
                                                                </td>
                                                                <td style="width: 350px;text-align: right;">
                                                                        <b>Date&nbsp;:&nbsp;</b>' . date('d-m-Y') . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr style="height: 35px;background: rgba(236, 236, 236, 0.49)";>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                       	<thead>
		                                                   	<tr>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Sr.No.</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Date</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Time</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>BSL (mg%)</th>
		                                                   	</tr>
                                                       	</thead>
                                                        <tbody>'.
                                                        	$html.'
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
        </html>');
		$pdf->Output($pdfFilePath, "D");
		//offer it to user via browser download! (Th
  	}


  	public function hbaPDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 
 
		//now pass the data//
	    $bslreportData=$this->hbaestimationdata->getreportData($_POST);

  			

		$data1= array('id'=>$_POST['user_id']);  
    	$userData=$this->userdata->getRow($data1);
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$getdata, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath =ucfirst($userData['username'])."HBA1c-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

		if(!empty($bslreportData))
		{

			$count = 1;
			foreach ($bslreportData as $key => $value) {

			    $html.="<tr>
			        <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
			        <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
			            ".date('d-M-Y',strtotime($value['date']))."
			        </td>
			        
			        <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
			            ".$value['hba_value']."
			        </td>
			    </tr>";

	            $count++;
            }
		}
                                            
		//generate the PDF!
		$pdf->WriteHTML(
			'<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>HBA1c Report</title>
				
					<style>
						.table-bord,.table-bord th,.table-bord td{
							border:1px solid #ddd;
							border-collapse: collapse;
							padding: 3px;
						}
						
						.bord-div{
						        *border-top: 1px solid #000;
						        *border-left: 1px solid #000;
						        *border-right: 1px solid #000;
						}
					</style>
				</head>
				<body>
                    <table width="700" class="bord-div"  align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="padding: 0px;">
                        <tbody>
                            <tr>
                                <td width="100%">
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #000;width: 120px;" align="center">
                                                                        
                                                                </td>
                                                                <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 700;border-bottom: 1px solid #000; " st-title="fulltext-title">
                                                                        <h4 style="margin-top: 10px;">HBA1c Report</h4>
                                                                </td>
                                                                <td style="border-bottom: 1px solid #000;" align="center">
                                                                </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td>	</tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" height="10"> &nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width:350px;">
                                                                    <b>Patient Name&nbsp;:&nbsp;</b>
                                                                    <span>' . ucfirst($userData['username']) . '</span>
                                                                </td>
                                                        
                                                                <td style="width:350px;text-align: right;">
                                                                    <b>Contact No&nbsp;:&nbsp;</b>' . $userData['mobile_no'] . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width: 350px;">
                                                                    <b>Date from&nbsp;:&nbsp;</b>' . $_POST['fromDate'] . '<b>&nbsp;to&nbsp;</b>'.$_POST['toDate'].'
                                                                </td>
                                                                <td style="width: 350px;text-align: right;">
                                                                        <b>Date&nbsp;:&nbsp;</b>' . date('d-m-Y') . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr style="height: 35px;background: rgba(236, 236, 236, 0.49)";>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                       	<thead>
                                                       	<tr>
	                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Sr.No.</th>
	                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Date</th>
	                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>HBA1c %</th>
                                                       	</tr>
                                                       	</thead>
                                                        <tbody>'.
                                                        	$html.'
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                        
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
        </html>');
		$pdf->Output($pdfFilePath, "D");
		//offer it to user via browser download! (Th
  	}


  	public function prescriptionPDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 		
 
		//now pass the data//
	    

  			

		$data1= array('id'=>$_POST['user_id']);  
    	$userData=$this->userdata->getRow($data1);

	    $prescriptionData=$this->prescriptiondata->getreportData($_POST);
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$getdata, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath =ucfirst($userData['username'])."Prescription-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

	    if(!empty($prescriptionData))
	    {
	    
	        $count = 1;
	        foreach ($prescriptionData as $key => $value) {
	    	$dose_details = explode(',', $value['dose_details']);
              
            $html.="<tr>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".date('d-M-Y',strtotime($value['date']))."
		                </td>
		                
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".'Dr.'.$value['fname'].' '.$value['lname']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".$value['drug_name']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ".$value['duration_days']."
		                </td>
		                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
		                    ";
		                for($i=0;$i<count($dose_details);$i++){
		                $html.= $dose_details[$i]."<br>";
		                }              			
		                
		            $html.="</td></tr>";

                  $count++;
          	}
        }
                                            
		//generate the PDF!
		$pdf->WriteHTML(
			'<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Prescription Report</title>
				
				<style>
					.table-bord,.table-bord th,.table-bord td{
						border:1px solid #ddd;
						border-collapse: collapse;
						padding: 3px;
					}
					
					.bord-div{
					        *border-top: 1px solid #000;
					        *border-left: 1px solid #000;
					        *border-right: 1px solid #000;
					}
				</style>
				</head>
				<body>
                    <table width="700" class="bord-div"  align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="padding: 0px;">
                        <tbody>
                            <tr>
                                <td width="100%">
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #000;width: 120px;" align="center">
                                                                        
                                                                </td>
                                                                <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 700;border-bottom: 1px solid #000; " st-title="fulltext-title">
                                                                    <h4 style="margin-top: 10px;">Prescription Report</h4>
                                                                </td>
                                                            	<td style="border-bottom: 1px solid #000;" align="center">
                                                                </td>
                                                            </tr>
                                                            <tr><td>&nbsp;</td>	</tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" height="10"> &nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" >
                                        <tbody>
                                            <tr>
                                                <td width="100%" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width:350px;">
                                                                        <b>Patient Name&nbsp;:&nbsp;</b>
                                                                        <span>' . ucfirst($userData['username']) . '</span>
                                                                </td>
                                                        
                                                                <td style="width:350px;text-align: right;">
                                                                        <b>Contact No&nbsp;:&nbsp;</b>' . $userData['mobile_no'] . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="width: 350px;">
                                                                        <b>Date from&nbsp;:&nbsp;</b>' . $_POST['fromDate'] . '<b>&nbsp;to&nbsp;</b>'.$_POST['toDate'].'
                                                                </td>
                                                                <td style="width: 350px;text-align: right;">
                                                                        <b>Date&nbsp;:&nbsp;</b>' . date('d-m-Y') . '
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="700"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                        <tbody>
                                            <tr style="height: 35px;background: rgba(236, 236, 236, 0.49)";>
                                                <td width="700">
                                                    <table width="700" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="padding: 0 6px;">
                                                       	<thead>
		                                                   	<tr>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Sr.No.</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Date</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Doctor Name</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Drug Name</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Duration</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center";>Dose Details</th>
		                                                   	</tr>
                                                       	</thead>
                                                        <tbody>'.
                                                        	$html.'
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
        </html>');
		$pdf->Output($pdfFilePath, "D");
		//offer it to user via browser download! (Th
  	}


  	public function importfile() {
        $data['page'] = 'import';
        $data['title'] = 'Import XLSX | TechArise';
        $this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/import',$data);
		$this->load->view('backend/footer');
    }

  	public function importData()
  	{
  		ini_set("memory_limit","1024M");
  		$this->load->library('excel');
        
       		if(!empty($_FILES["importfile"]["name"])){
            $path = BASEPATH."../uploads/";
            //if(!empty($_FILES["importfile"]["name"])){
	        	
			$target_file = $path . basename($_FILES["importfile"]["name"]);
			move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_file);
			$import_xls_file = basename($_FILES["importfile"]["name"]);
	       // }
				
            $inputFileName = $path . $import_xls_file;
            //echo $inputFileName;exit;
            //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
			 $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
	          //Set to read only
	          $objReader->setReadDataOnly(true); 		  
	        //Load excel file
			 $objPHPExcel=$objReader->load($inputFileName);		 
	         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
	         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
	          //loop from first data untill last data
	         //echo $totalrows;exit;
	          for($i=2;$i<=$totalrows;$i++)
	          {
          		//if(isset($objWorksheet->getCellByColumnAndRow(0,$i)->getValue())){
	              $FirstName= trim($objWorksheet->getCellByColumnAndRow(0,$i)->getValue());			
	              $LastName= trim($objWorksheet->getCellByColumnAndRow(1,$i)->getValue()); //Excel Column 1
				  $Email= trim($objWorksheet->getCellByColumnAndRow(2,$i)->getValue()); //Excel Column 2
				  $data_user=array('category_id' =>8, 'item_name' => $FirstName, 'quantity_label' => $LastName, 'calories' => $Email);
				  //$this->import->Add_User($data_user);
	             //}	  
	          }
      		}
        
        
  	}


}
