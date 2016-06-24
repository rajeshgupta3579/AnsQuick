<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Signup extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
		        $this->load->database();
		        $this->load->model('Ansquick_model');
			}


			function index(){
					$password = $this->input->post('password');
					$salt 		= 	uniqid(mt_rand(), true);
					$encryptedPassword = $this->Ansquick_model->encryptPassword($password,$salt);
        	$data = array(
	          'firstName' => $this->input->post('firstName'),
	          'lastName'  => $this->input->post('lastName'),
						'userName'  => $this->input->post('userName'),
	          'emailID' 	=> $this->input->post('emailID'),
	          'password'  => $encryptedPassword,
						'salt'  => $salt
        	);
				  if($this->Ansquick_model->insertUser($data)){
						redirect('AnsQuick/success');
					}
    	}

		}
?>
