<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "/libraries/REST_Controller.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}


class Api extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
		$this->load->helper('jwt');
	}
	public function __destruct() {  
	    $this->db->close();  
	} 
    
	public function index_get()
	{
		$this->response('NULL');
	}
	public function validLogin_post()
	{
		$username = $this->post('username');
		$password = $this->post('password');
		$result = $this->Api_model->login($username, $password);
		
		if ($result['success']) {
			// user logged in, generate a token and return
			$id = $result['reg_no'];
			$token = array();
			$token['reg_no'] = $id;
			$result['token'] = JWT::encode($token, $this->config->item('jwt_key'));
			$result['name'] = $result['name'];
			$result['utype'] = $result['utype'];
			$this->response($result);
		} else {
			// authentication failed, return error
			$this->response(
				array(
					"success"	=> $result['success'], 
					"error"		=> $result['error'],
				)
			);
		}
	}	
		
	function getData($type, $params=null) {
		$success = true;
		$error = '';
		$result = '';
		$response = [];
				
		if(!$_SERVER['HTTP_TOKEN']) {
			$success = false;
			$error = "Token not provided";
		}
		
		if ($success) {
			try 
			{
				$token = JWT::decode($_SERVER['HTTP_TOKEN'], $this->config->item('jwt_key'));
	
				if ($token->reg_no) {		
					switch($type) {
						case 'userData'				: $result = $this->Api_model->userData($token->reg_no); break;
						case 'changePassword'		: $result = $this->Api_model->changePassword($token->reg_no, $params); break;
						case 'addbooking'		    : $result = $this->Api_model->addbooking($params); break;
						// venkat
						case 'addtype'		        : $result = $this->Api_model->addtype($params); break;
						case 'getroomtype'		  	: $result = $this->Api_model->getroomtype(); break;
						case 'addregistration'		: $result = $this->Api_model->addregistration($params); break;
						// case 'getStaff'				: $result = $this->api_model->getStaff($token->reg_no, $params); break;
						// case 'Upload'				: $result = $this->Api_model->Upload($token->reg_no,$params); break;
						case 'getlist'		: $result = $this->Api_model->getlist($params); break;
						case 'insertlist'		: $result = $this->Api_model->insertlist($params); break;
						case 'itemoutlist'		: $result = $this->Api_model->itemoutlist($params); break;
						case 'addnewitem'		: $result = $this->Api_model->addnewitem($params); break;
						case 'menulist'		: $result = $this->Api_model->menulist($params); break;
					case 'getmenulist' : $result = $this->Api_model->getmenulist($params); break;
					case 'updatelist' : $result = $this->Api_model->updatelist($params); break;

					case 'stockRegister'		: $result = $this->Api_model->stockRegister($params); break;
						case 'stockBalance'			: $result = $this->Api_model->stockBalance($params); break;
					}

				
					$success = true;
				}
			} 
			catch (Exception $e)
			{
				$success = false;
				$error = "Token authentication failed";
			}					
		}
		
		$response['success'] = $success;
		$response['error'] = $error;
		if ($success) {
			$response['data'] = $result;
		}		
		$this->response($response);
	}


	// Add new Booking post
	public function addbooking_post(){
		$data['startdate']=$this->post('startdate');		
		$data['enddate']=$this->post('enddate');
		$data['description']=$this->post('description');
	    $this->getData('addbooking',$data);	    	
	    $this->response(true);
	}

	// venkat
	// Add room type post
	public function addtype_post(){
		// $data['typeid']=$this->post('typeid');		
		$data['type']=$this->post('type');
		$data['totalcount']=$this->post('totalcount');
		$data['cost']=$this->post('cost');
		$data['totaldues']=$this->post('totaldues');		
	    $this->getData('addtype',$data);	    	
	    $this->response(true);
	}


	// roomtype get view
	public function roomtype_get(){		    
	    // $result=$this->Api_model->getroomtype();
	    $data=[];
	    $this->getData('getroomtype',$data);	
	     // $this->response($result);	
	}	

	// Add registration post
	public function addregistration_post(){	
		$data['studentname']=$this->post('studentname');
		$data['dateofbirth']=$this->post('dateofbirth');
		$data['pwd']=$this->post('pwd');
		$data['reg_no']=$this->post('reg_no');
		$data['distance']=$this->post('distance');
		$data['roomtype']=$this->post('roomtype');
		$data['priority']=$this->post('priority');
		$data['fathername']=$this->post('fathername');
		$data['occupation']=$this->post('occupation');
		$data['parentmobile']=$this->post('parentmobile');
		$data['parentemail']=$this->post('parentemail');
		$data['parentaddress']=$this->post('parentaddress');
		$data['permanentaddress']=$this->post('permanentaddress');
		$data['guardianname']=$this->post('guardianname');
		$data['guardianrelation']=$this->post('guardianrelation');
		$data['guardianmobile']=$this->post('guardianmobile');
		$data['guardianemail']=$this->post('guardianemail');
		$data['guardianaddress']=$this->post('guardianaddress');
		$data['guardianpermanentaddress']=$this->post('guardianpermanentaddress');		
	    $this->getData('addregistration',$data);	    	
	    // $this->response(true);
	}



	// Get Multiple query results function
	public function GetMultipleQueryResult($queryString)
    {
	    if (empty($queryString)) {
	                return false;
	            }

	    $index     = 0;
	    $ResultSet = array();

	    /* execute multi query */
	    if (mysqli_multi_query($this->db->conn_id, $queryString)) {
	        do {
	            if (false != $result = mysqli_store_result($this->db->conn_id)) {
	                $rowID = 0;
	                while ($row = $result->fetch_assoc()) {
	                    $ResultSet[$index][$rowID] = $row;
	                    $rowID++;
	                }
	            }
	            $index++;
	        } while (mysqli_more_results($this->db->conn_id) && mysqli_next_result($this->db->conn_id));
	    }

	    return $ResultSet;
    }






    //Mess Incharge
    public function insertlist_post(){
    	$data=array(
    		'type' => $this->post('type'),
    		'insert_date' => $this->post('insert_date'),
    		'active_list' => $this->post('activeList'),
    		'reg_no' => $this->post('reg_no')
           );	
	    $this->getData('insertlist',$data);	    	
	    $this->response(true);
	}
	public function itemoutlist_post()
	{
		$time=  $this->post('out_date1');
		$start = date('h:i:s');
       echo $time.' '.$start;
		$data=array(
			'slot' => $this->post('slot'),
            'type' => $this->post('type'),
			'active_list1' => $this->post('activeList1'),
			'out_date' => $time.' '.$start,
			'reg_no' => $this->post('reg_no')
			);
		  $this->getData('itemoutlist',$data);	    	
	    $this->response(true);
	}
	public function getlist_get(){		    
	    
	    $data=[];
	    $this->getData('getlist');	
	    	
	}
	public function addnewitem_post()
	{
		$data=array(
			'item' => $this->post('item')
			);
		// $data['item']=$this->post('item');
		$this->getData('addnewitem',$data);
	}
	public function menulist_post()
	{
		$data=array(
			'mday' => $this->post('day'),
            'breakfast' => $this->post('breakfast'),
			'lunch' => $this->post('lunch'),
			'snacks' => $this->post('snacks'),
			'dinner' => $this->post('dinner')
			);
		  $this->getData('menulist',$data);	    	
	    $this->response(true);
	}
	public function getmenulist_get(){		    
	    
	    $data=[];
	    $this->getData('getmenulist');	
	    	
	}
	public function updatelist_post()
	{
		$data=array(
			'id' => $this->post('id'),
            'breakfast' => $this->post('breakfast'),
			'lunch' => $this->post('lunch'),
			'snacks' => $this->post('snacks'),
			'dinner' => $this->post('dinner')
			);
		  $this->getData('updatelist',$data);	    	
	    $this->response(true);
	}
	public function stockRegister_get(){
		$this->getData('stockRegister');
	}

	public function stockBalance_get(){
		$this->getData('stockBalance');
	}

	
}