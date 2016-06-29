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
			public function changePassword($userName,$password,$salt){
					$query = $this->Forgotpassword_model->get_user($userName);
	        if($query->num_rows()>0){
	          $row = $query->result();
						echo "true";
					}
					else {
							echo "false";
					}
			}
			public function sendmail() {
        $userNameForgotPassword = $this->input->post('userNameForgotPassword');
        $query = $this->Forgotpassword_model->get_user($userNameForgotPassword);
        if($query->num_rows()>0){
          $row = $query->result();
          $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' =>  465,
            'smtp_user' => 'quickanswer16@gmail.com',
            'smtp_pass' => 'Jindal9@',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
          );
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");

          $from_email = "quickanswer16@gmail.com";
          $this->email->from($from_email, 'AnsQuick');
          $this->email->to($row[0]->emailID);
          $this->email->subject('Password Recovery');
          $this->email->message(base_url()."index.php/ForgotPassword/changePassword/".$row[0]->userName."/".$row[0]->password."/".$row[0]->salt);
          if($this->email->send())
            echo "true";
          else
            echo "false";
        }
        else
          echo "false";
      }
			public function success(){
				$this->load->view('AnsQuick/success');
			}
			public function error(){
				$this->load->view('AnsQuick/error');
			}

		}
?>
