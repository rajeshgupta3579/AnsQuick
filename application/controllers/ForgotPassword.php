<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class ForgotPassword extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->database();
	          $this->load->model('Forgotpassword_model');
			}
			public function index(){
				$this->load->view('AnsQuick/recovery');
			}
			public function checkUser(){
					$userNameForgotPassword = $this->input->post("userNameForgotPassword");
					if($this->Forgotpassword_model->userExists($userNameForgotPassword)){
						echo "true";
					}
					else {
							echo "false";
					}
			}
			public function success(){
				$this->load->view('AnsQuick/success');
			}
			public function error(){
				$this->load->view('AnsQuick/error');
			}
		}
?>
