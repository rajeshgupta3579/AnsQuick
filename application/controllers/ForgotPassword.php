<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class ForgotPassword extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->database();
						$this->load->library('session');
	          $this->load->model('Ansquick_model');
						$this->load->library('pagination');
			}
			public function index(){
				$this->load->view('AnsQuick/recovery');
			}
			public function checkUser(){
					$userNameForgotPassword = $this->input->post("userNameForgotPassword");
					if($this->Ansquick_model->userNameExists($userNameForgotPassword)){
						echo "true";
					}
					else {
							echo "false";
					}
			}
			public function changePassword($userName,$salt){
					$row = $this->Ansquick_model->getUserDetails($userName);
	        if(count($row)){
						if($salt==md5($row[0]->salt)){
							$data = Array(
		            'userName'  => $row[0]->userName
							);
							$this->load->view('AnsQuick/changePassword',$data);
						}
						else{
							echo "Permission Denied";
						}
					}
					else {
							echo "Permission Denied";
					}
			}
			public function sendmail() {
        $userNameForgotPassword = $this->input->post('userNameForgotPassword');
        $row = $this->Ansquick_model->getUserDetails($userNameForgotPassword);
        if(count($row)){
          $config = unserialize(EMAIL_CONFIG);
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");

          $from_email = EMAIL_ADDRESS;
          $this->email->from($from_email, HOST_NAME);
          $this->email->to($row[0]->emailID);
          $this->email->subject('Password Recovery');
					$message = FORGOT_PASSWORD_MAIL_MESSAGE;
          $this->email->message($message.base_url()."index.php/ForgotPassword/changePassword/".$row[0]->userName."/".md5($row[0]->salt));
          if($this->email->send())
						echo "true";
					else
						echo $this->email->print_debugger();

        }
        else
          echo "false";
      }
			public function setPassword(){
				$userName = $this->input->post('userName');
				$newPassword = $this->input->post('newPassword');
				$cnewPassword = $this->input->post('cnewPassword');
				if($newPassword!=$cnewPassword){
					echo "Passwords do not Match";
					return ;
				}
				if($this->Ansquick_model->userNameExists($userName)){
					$salt 		= 	uniqid(mt_rand(), true);
					$encryptedPassword = $this->Ansquick_model->encryptPassword($newPassword,$salt);
					$data = array(
	          'password'  => $encryptedPassword,
						'salt'  		=> $salt
        	);
				  if($this->Ansquick_model->updateUser($data,$userName)){
						redirect(base_url());
					}
					else{
						echo "Password could not be changed";
					}

				}
				else{
					echo "User is Not registered";
					return ;
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
