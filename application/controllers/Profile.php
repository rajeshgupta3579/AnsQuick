<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->library('session');
          $this->load->helper(array('form','url'));
          $this->load->database();
          //load the login model
          $this->load->model('AnsQuick_model');
     }
      public function index()
     {
         $this->load->view('AnsQuick/profile.php');
     }
		 public function checkUser(){
          $userNameLogin = $this->input->post("userNameLogin");
          $passwordLogin = $this->input->post("passwordLogin");
          if ($this->AnsQuick_model->userExists($userNameLogin,$passwordLogin)){
              $sessiondata = array(
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
