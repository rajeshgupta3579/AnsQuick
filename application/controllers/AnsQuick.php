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
		        $this->load->database();
		        $this->load->model('Ansquick_model');
			}
			public function index(){
				$this->load->view('AnsQuick/HomePage');
			}
			public function success(){
				$this->load->view('AnsQuick/success');
			}
			public function error(){
				$this->load->view('AnsQuick/error');
			}
		}
?>
