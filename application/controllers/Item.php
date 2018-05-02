<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

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
			 	$this->load->model('itemdata');
			 	$this->load->model('categorydata');
			}else{
				redirect('login', 'refresh');
			}
		}

	public function index()
	{
		$data['itemData']=$this->itemdata->getallRows();
		$data['title'] = "Item List";
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/itemlist', $data);
		$this->load->view('backend/footer');
		$this->load->view('backend/itemjs.php');
	}


	public function additem()
	{
		$data['title'] = "Add Item";
		$getdata['getitemData']= array();
		$getdata['categoryData']=$this->categorydata->getRows();
		$this->load->view('backend/header', $data);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/itemadd',$getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/itemjs.php');
	}

	public function edititem($id) {
	    $data= array('id'=>$id);  
	    $data1['title'] = "Update Item";
	    $getdata['getitemData']=$this->itemdata->getRowedit($data);
	    $getdata['categoryData']=$this->categorydata->getRows();
	    $this->load->view('backend/header', $data1);
		$this->load->view('backend/sidebar');
		$this->load->view('backend/itemedit', $getdata);
		$this->load->view('backend/footer');
		$this->load->view('backend/itemjs.php');    
	}

	public function saveitem() {
		$this->form_validation->set_rules('category_id', 'Item Category', 'trim|required');
		$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
		$this->form_validation->set_rules('quantity_label', 'Quantity Label', 'trim|required');
		$this->form_validation->set_rules('calories', 'Calories', 'required|regex_match[/^0*[1-9]\d*$/]');

		if(isset($_POST['id']) && $_POST['id'] > 0){
			if ($this->form_validation->run() == FALSE)
	        {
				$getdata['getitemData']= array(
					'id' => $_POST['id'],
					'category_id'=>$_POST['category_id'],
					'item_name'=>$_POST['item_name'],
					'quantity_label'=>$_POST['quantity_label'],
				    'calories'=>$_POST['calories']
				);
				$data['title'] = "Update item";
				$getdata['categoryData']=$this->categorydata->getRows();
				$this->load->view('backend/header',$data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/itemedit',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/itemjs.php');
	            return false;
	        }
			$data=array(      
		      		'category_id'=>$_POST['category_id'],
					'item_name'=>$_POST['item_name'],
					'quantity_label'=>$_POST['quantity_label'],
				    'calories'=>$_POST['calories']
		    );
			$msg=$this->itemdata->update($data,$_POST['id']);
			if($msg =='success'){
				$this->session->set_flashdata('success','Item updated successfully');
				redirect('item');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
				$id = $_POST['id'];
				redirect('item/edititem/'.$id);
			}
		}else{
			if ($this->form_validation->run() == FALSE)
	        {
	        	$data['title'] = "Add item";
	        	$getdata['getitemData']= array();
	        	$getdata['categoryData']=$this->categorydata->getRows();
				$this->load->view('backend/header', $data);
				$this->load->view('backend/sidebar');
				$this->load->view('backend/itemadd',$getdata);
				$this->load->view('backend/footer');
				$this->load->view('backend/itemjs.php');
	            return false;
	        }
			$data=array(      
		      	'category_id'=>$_POST['category_id'],
				'item_name'=>$_POST['item_name'],
				'quantity_label'=>$_POST['quantity_label'],
			    'calories'=>$_POST['calories']
		    );
			$msg=$this->itemdata->insert($data);
			if($msg == 'success'){
				$this->session->set_flashdata('success','Item added successfully', 'success');
				redirect('item');
			}else{
				$this->session->set_flashdata('error','Something is wrong, please try again');
			    redirect('item/additem');
			}
		}
	}


	public function deleteitem() {
	  	$id= $_POST['id'];
	  	$data=array( 
	  		'is_deleted' => 1,
	  		'deleted_by' => $this->session->userdata['USER_ID']
  		);
	    $msg=$this->itemdata->deleteitem($data,$id);
	    if($msg == 'success'){
	    	$this->session->set_flashdata('success','Item deleted successfully');
	    	return 'success';
	    }else{
	    	$this->session->set_flashdata('error','Something is wrong, please try again');
	    	return 'error';
	    }
  	}

  

}
