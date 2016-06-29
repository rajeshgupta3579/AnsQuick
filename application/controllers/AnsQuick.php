<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class AnsQuick extends CI_Controller {
			/***Function Header
			*Constructor for the Controller
			*Loads the helper for form and base_url, loads the database and the Model
			*
			***/
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->driver('session');
						$this->load->library('session');
			}
			public function index(){
				$this->load->view('AnsQuick/index');
			}
			public function success(){
				$this->load->view('AnsQuick/success');
			}
			public function error(){
				$this->load->view('AnsQuick/error');
			}
			public function logout(){
   			$this->session->unset_userdata('userName');
				$this->session->unset_userdata('userID');
   			$this->session->unset_userdata('loginUser');
        session_destroy();
				redirect(base_url());
			}
		}
?>
