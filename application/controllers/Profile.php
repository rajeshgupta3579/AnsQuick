<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Profile extends CI_Controller{
       public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->helper(array('form','url'));
            $this->load->database();
            //load the login model
            $this->load->model('Ansquick_model');
       }
       public function index(){
           $this->load->view('AnsQuick/profile.php');
       }
  }
?>
