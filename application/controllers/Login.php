<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->library('session');
          $this->load->helper(array('form','url'));
          $this->load->database();
          //load the login model
          $this->load->model('AnsQuick_model');
     }

		 public function checkUser(){
          $userNameLogin = $this->input->post("userNameLogin");
          $passwordLogin = $this->input->post("passwordLogin");
          if ($this->AnsQuick_model->userExists($userNameLogin,$passwordLogin)){
              $query = $this->AnsQuick_model->get_user($userNameLogin);
              $row = $query->result();
              $sessiondata = array(
                   'firstName' => $row[0]->firstName,
                   'lastName'  => $row[0]->lastName,
                   'userID'    => $row[0]->userID,
                   'profilePic'=> $row[0]->profilePic,
                 	 'userName'  => $userNameLogin,
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
