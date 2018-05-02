<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

				$this->load->model('userdata');
		}

	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('backend/login',$data);
		
	}

	public function checkLogin()
	{
		$userName= trim($this->input->post('email_id'));
		$password= trim($this->input->post('password'));

		$query = $this->userdata->processLogin($userName,$password);

		$query1 = $this->userdata->activeLogin($userName,$password);

		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_rules('email_id', 'Email Id', 'required|callback_validateUser[' . $query->num_rows() . ']|callback_activeUser[' . $query1->num_rows() . ']');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Enter %s');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('backend/login');
		}else{
			if($query){
				$query = $query->result();
				$user = array(
				 'USER_ID' => $query[0]->id,
				 'USER_NAME' => $query[0]->username,
				 'EMAIL' => $query[0]->email_id,
				 'USER_TYPE' => $query[0]->user_type_id,
				);

				$this->session->set_userdata($user);
				if($this->session->userdata['USER_TYPE'] == 1){
					redirect('dashboard/admin');
				}else if($this->session->userdata['USER_TYPE'] == 2){
					redirect('dashboard/');
				}
			}
		}

		
	}

	public function validateUser($userName,$recordCount){
		if ($recordCount != 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('validateUser', 'Invalid %s or Password');
			return FALSE;
		}
	 }

	 public function activeUser($userName,$recordCount){
		if ($recordCount != 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('activeUser', 'Your acount is not activated, Please contact your admin');
			return FALSE;
		}
	 }

	public function error_page()
	{
		$data['title'] = "404 Error Page";
		$this->load->view('backend/error404',$data);
	}

	public function forgotPassword()
	{
		$data['title'] = "Login";
		$this->load->view('backend/forgotPassword',$data);
	}

	public function logout()
	{
	    $user_data = $this->session->all_userdata();
	        foreach ($user_data as $key => $value) {
	            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	                $this->session->unset_userdata($key);
	            }
	        }
	    $this->session->sess_destroy();
	    redirect('login/');
	}

	
}
