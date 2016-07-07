<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->library('session');
          $this->load->helper(array('form','url'));
          $this->load->database();
          $this->load->model('Ansquick_model');
     }

		 public function checkUser(){
          $userNameLogin = $this->input->post("userNameLogin");
          $passwordLogin = $this->input->post("passwordLogin");
          if ($this->Ansquick_model->userExists($userNameLogin,$passwordLogin)){
              $row = $this->Ansquick_model->getUserDetails($userNameLogin);              
              $sessiondata = array(
                   'firstName' => $row[0]->firstName,
                   'lastName'  => $row[0]->lastName,
                   'userID'    => $row[0]->userID,
                   'profilePic'=> $row[0]->profilePic,
                 	 'userName'  => $row[0]->userName,
                   'loginUser' => TRUE
              );
              $this->session->set_userdata($sessiondata);
              echo "true";
          }
          else{
              echo "false";
          }
      }
      public function success(){
           redirect(base_url());
       }
		}
?>
