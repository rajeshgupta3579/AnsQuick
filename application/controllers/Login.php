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

		 public function index(){
	      	//get the posted values
          $userName = $this->input->post("userName");
          $password = $this->input->post("password");
          if ($this->AnsQuick_model->userExists($userName,$password)){
          	$sessiondata = array(
            	'username' => $userName,
              'loginUser' => TRUE
            );
            $this->session->set_userdata($sessiondata);
            	redirect('AnsQuick/success');
          }
          else{
              redirect('AnsQuick/error');
          }
      }

		}
?>
