<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meal extends CI_Controller {

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
			 	$this->load->model('categorydata');
			 	$this->load->model('itemdata');
			 	$this->load->model('userdata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['mealdata']=$this->mealdata->getRows();
		$data['title'] = "Meal List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/meallist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/mealjs.php');
	}


	public function addMeal()
	{
		$data['title'] = "Add Meal";
		$getdata['getmealdata']= array();
		$getdata['userData']=$this->userdata->getRows();
		$getdata['categoryData']=$this->categorydata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/mealadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/mealjs.php');

	}

	public function editMeal($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update BSL Estimation";
	    $getdata['getmealdata']=$this->mealdata->getRow($data);
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/mealedit', $getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/mealjs.php');
	}

	public function getItems() {
		$category_id= $_POST['category_id'];
	  	$data=array(
	  		'category_id' => $category_id
  		);
	    $result=$this->itemdata->getRows($data);
	    echo json_encode($result);
	}

	public function getItemslabel() {
		$item_id= $_POST['item_id'];
	  	$data=array(
	  		'id' => $item_id
  		);
	    $result=$this->itemdata->getItemslabel($data);
	    echo json_encode($result);
	}

	public function saveMeal() {
		$this->form_validation->set_rules('sdate', 'Date', 'trim|required');
		$this->form_validation->set_rules('user_id', 'Patient Name', 'trim|required');
		$this->form_validation->set_rules('category_id', 'Food Category', 'trim|required');
		$this->form_validation->set_rules('item_id', 'Food Item', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
		$this->form_validation->set_rules('calories_taken', 'Calories taken', 'trim|required');
		

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getmealdata']= array(
					'id' => $_POST['id'],
				    'sdate'=>$_POST['sdate'],
				    'user_id'=>$_POST['user_id'],
				    'category_id'=>$_POST['category_id'],
				    'item_id'=>$_POST['item_id'],
				    'quantity'=>$_POST['quantity'],
				    'calories_taken'=>$_POST['calories_taken']
				);
				$data['title'] = "Update Meal";
				$getdata['getmealdata']= array();
				$getdata['userData']=$this->userdata->getRows();
				$getdata['categoryData']=$this->categorydata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/mealedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/mealjs.php');
	            return false;
	        }
			$data=array(      
			    'sdate'=>date('Y-m-d',strtotime($_POST['sdate'])),
			    'user_id'=>$_POST['user_id'],
			    'category_id'=>$_POST['category_id'],
			    'item_id'=>$_POST['item_id'],
			    'quantity'=>$_POST['quantity'],
			    'calories_taken'=>$_POST['calories_taken'],
		      	'updated_by' => $this->session->userdata['USER_ID'],
		      	'updated_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->mealdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success', 'Meal Updated successfully');
				redirect('meal');
			}else{
				$id = $_POST['id'];
				$this->session->set_flashdata('Something is wrong, please try again', 'error');
				redirect('meal/editmeal/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add Meal";
	        	$data['getmealdata']= array();
				$data['userData']=$this->userdata->getRows();
				$data['categoryData']=$this->categorydata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/mealadd',$data);
				$this->load->view('backend/footer');
				$this->load->view('backend/mealjs.php');
	            return false;
	        }
			$data=array(      
			    'sdate'=>date('Y-m-d',strtotime($_POST['sdate'])),
			    'user_id'=>$_POST['user_id'],
			    'category_id'=>$_POST['category_id'],
			    'item_id'=>$_POST['item_id'],
			    'quantity'=>$_POST['quantity'],
			    'calories_taken'=>$_POST['calories_taken'],
		      	'created_by' => $this->session->userdata['USER_ID'],
		      	'created_at' => date('Y-m-d H:i:s')
		    );
			$msg=$this->mealdata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success', 'Meal Added successfully');
				redirect('meal');
			}else{
				$this->session->set_flashdata('error', 'Something is wrong, please try again');
			    redirect('meal/addmeal');
			}
		}
	}


	public function deleteMeal() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID'],
	  		'deleted_at' => date('Y-m-d H:i:s')
  		);
	    $msg=$this->mealdata->deleteMeal($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success', 'Meal Deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}
}
