<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signup extends CI_Controller {
			public function __construct(){
		        parent::__construct();

		        $this->load->helper(array('form','url'));
		        $this->load->database();
						$this->load->library(array('session', 'form_validation', 'email'));
		        $this->load->model('Ansquick_model');
			}
			function index(){
					$password = $this->input->post('password');
					$userName = $this->input->post('userName');
					$emailID = $this->input->post('emailID');
					if($this->Ansquick_model->userNameExists($userName)){
							echo "userNameExists";
					}
					else if($this->Ansquick_model->userNameExists($emailID)){
							echo "emailIDExists";
					}
					else{
						$salt 		= 	uniqid(mt_rand(), true);
						$encryptedPassword = $this->Ansquick_model->encryptPassword($password,$salt);
	        	$data = array(
		          'firstName' => $this->input->post('firstName'),
		          'lastName'  => $this->input->post('lastName'),
							'userName'  => $userName,
		          'emailID' 	=> $emailID,
		          'password'  => $encryptedPassword,
							'salt'  		=> $salt
	        	);
					  if($this->Ansquick_model->insertUser($data)){
							echo "true";
						}
						else{
							echo "false";
						}
					}
    	}
			function success(){
				redirect(base_url());
			}

		}
?>
