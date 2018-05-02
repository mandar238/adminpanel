<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
			 	$this->load->model('citydata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		if($this->session->userdata['USER_TYPE'] == 1){
			 redirect('user/userlist');
		}
		$data['title'] = "User List";
		$data['userData']=$this->userdata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/userlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/userjs.php');
	}

	public function userlist()
	{
		$data['title'] = "User List";
		$data['userData']=$this->userdata->getallRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/alluserlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/userjs.php');
	}


	public function addUser()
	{
		$data['title'] = "Add User";
		$getdata['getUserData']= array();
		$getdata['cityData']=$this->citydata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/useradd',$getdata);
		$this->load->view('backend/footer');
	}

	public function editUser($id) {
		$data1['title'] = "Update User";
	    $data= array('id'=>$id);  
	    $getdata['getUserData']=$this->userdata->getRow($data);
	    $getdata['cityData']=$this->citydata->getRows();
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/useredit', $getdata);
		$this->load->view('backend/footer');
	    
	}

	public function saveUser() {

		if(isset($_POST['id'])){
			$data= array('id'=>$_POST['id']);
			$getdata['getUserData']=$this->userdata->getRow($data);
			$original_username = $getdata['getUserData']['username'];
			$original_email = $getdata['getUserData']['email_id'];
			$original_mobile = $getdata['getUserData']['mobile_no'];

			
			if($this->input->post('email_id') != $original_email) {
			   $email_unique = '|is_unique[users.email_id]';
			} else {
			   $email_unique = '';
			}
			if($this->input->post('mobile_no') != $original_mobile) {
			   $mobile_unique = '|is_unique[users.mobile_no]';
			} else {
			   $mobile_unique = '';
			}
		}else{
		    $email_unique = '|is_unique[users.email_id]';
		    $mobile_unique = '|is_unique[users.mobile_no]';
		}
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('relation', 'Relation', 'required');
		$this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
		$this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email'.$email_unique);
		$this->form_validation->set_rules('mobile_no', 'Mobile Number ', 'required|regex_match[/^[789]\d{9}$/]'.$mobile_unique);
		$this->form_validation->set_rules('weight', 'Weight', 'required');
		$this->form_validation->set_rules('height', 'Height', 'required');
		$this->form_validation->set_rules('lifestyle', 'Lifstyle', 'required');
		$this->form_validation->set_rules('city_id', 'City', 'required');
		
		if(isset($_POST['user_status'])){
			$user_status = 1;
		}else{
			$user_status = 0;
		}
		$password = substr($_POST['mobile_no'],4,10);
		$password = base64_encode($password);
		

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Update User";
				$getdata['getUserData']= array(
					'id' => $_POST['id'],
					'username'=>$_POST['username'],
				    'relation'=>$_POST['relation'],
				    'birthdate'=>date('Y-m-d',strtotime($_POST['birthdate'])),
				    'gender'=>$_POST['gender'],
				    'email_id'=>$_POST['email_id'],
				    'mobile_no'=>$_POST['mobile_no'],
				    'weight'=>$_POST['weight'],
				    'height'=>$_POST['height'],
				    'lifestyle'=>$_POST['lifestyle'],
				    'city_id'=>$_POST['city_id'],
				    'pincode'=>$_POST['pincode'],
				    'user_status' => $user_status
				);
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/useredit',$getdata);
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
		      'username'=>ucfirst($_POST['username']),
		      'relation'=>$_POST['relation'],
		      'birthdate'=>date('Y-m-d',strtotime($_POST['birthdate'])),
		      'gender'=>$_POST['gender'],
		      'email_id'=>$_POST['email_id'],
		      'mobile_no'=>$_POST['mobile_no'],
		      'weight'=>$_POST['weight'],
		      'height'=>$_POST['height'],
		      'lifestyle'=>$_POST['lifestyle'],
		      'city_id'=>$_POST['city_id'],
			  'pincode'=>$_POST['pincode'],
		      'user_status'=>$user_status,
		      'updated_by' => $this->session->userdata['USER_ID'],
		      'updated_at' => date('Y-m-d H:i:s'),
		    );
			$msg=$this->userdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'User Updated successfully');
				redirect('user');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('user/editUser/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add User";
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/useradd');
				$this->load->view('backend/footer');
	            return false;
	        }
			$data=array(      
		      'username'=>ucfirst($_POST['username']),
		      'password'=> $password,
		      'relation'=>$_POST['relation'],
		      'birthdate'=>date('Y-m-d',strtotime($_POST['birthdate'])),
		      'gender'=>$_POST['gender'],
		      'email_id'=>$_POST['email_id'],
		      'mobile_no'=>$_POST['mobile_no'],
		      'weight'=>$_POST['weight'],
		      'height'=>$_POST['height'],
		      'lifestyle'=>$_POST['lifestyle'],
		      'city_id'=>$_POST['city_id'],
			  'pincode'=>$_POST['pincode'],
		      'user_status'=>$user_status,
		      'created_by' => $this->session->userdata['USER_ID'],
		      'created_at' => date('Y-m-d H:i:s'),
		    );
			$msg=$this->userdata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success', 'New User Added successfully');
				redirect('user');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('user/addUser');
			}
		}
	}


	public function deleteUser() {
	  	$id= $_POST['id'];
	  	$status = $_POST['status'];
	  	$data=array( 
	  		'user_status' => $status,
	  		'updated_by' => $this->session->userdata['USER_ID'],
	        'updated_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->userdata->deleteUser($data,$id);
	    if($msg == 'success'){
	    	$result = array('msg' => 'success');
	    }else{
	    	$result = array('msg' => 'error');
	    }
	    echo json_encode($result);
  	}

  	public function userSettings()
	{
		$data['title'] = "Change Settings";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/usersettings');
		$this->load->view('backend/footer');
	}


	public function changeSettings()
	{
		$emailID = trim($this->session->userdata['EMAIL']);
		$userName = trim($this->input->post('username'));
		$oldPassword = trim($this->input->post('oldPassword'));
		$newPassword = base64_encode($this->input->post('newPassword'));

		$query = $this->userdata->processLogin($emailID,$oldPassword);
		$this->form_validation->set_rules('oldPassword', 'Old Password', 'required|callback_oldpassword_check[' . $query->num_rows() . ']');
		$this->form_validation->set_rules('newPassword', 'New Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]');
		if ($this->form_validation->run() == FALSE)
        {
        	$data['title'] = "Change Settings";
			$this->load->view('backend/header', $data);
			$this->load->view('backend/sidebar');
			$this->load->view('backend/usersettings');
			$this->load->view('backend/footer');
            return false;
        }else{
        	$result = $this->userdata->saveNewPass($newPassword,$emailID);
        	if($result == TRUE){
        		$this->session->set_flashdata('success', 'Password changed successfully');
        		redirect('dashboard');
        	}else{
        		$this->session->set_flashdata('error', 'Something is wrong, please try again');
        		redirect('user/userSettings');
        	}

        }
	}

	public function oldpassword_check($old_password,$recordCount){
	  if ($recordCount != 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('oldpassword_check', 'Old password not match');
			return FALSE;
		}
	}

	public function userPDF()
  	{
  		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library
 	

    	$userData=$this->userdata->getRows();
    	
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$getdata, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		$pdfFilePath = "Users-Report".date('d-m-Y').".pdf";
 
		$html="";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

	     if(!empty($userData))
	     {
	    
	        $count = 1;
	        foreach ($userData as $key => $value) {
	    
	            $html.="<tr>
	                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>$count</td>
	                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
	                    ".ucfirst($value['username'])."
	                </td>
	                
	                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
	                    ".$value['email_id']."
	                </td>
	                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
	                    ".$value['mobile_no']."
	                </td>
	                <td style='border: 1px solid #ccc; border-collapse: collapse;text-align:center;'>
	                    ".date('d-m-Y h:i:s',strtotime($value['created_at']))."
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
				<title>User Report List</title>
			
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
                                                                    <h4 style="margin-top: 10px;">User Report List</h4>
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
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Sr.No.</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Name</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Email</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Mobile Number</th>
		                                                       	<th style="border: 1px solid #ccc; border-collapse: collapse;text-align:center;">Registered On</th>
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
}
