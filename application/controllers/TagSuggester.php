<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class TagSuggester extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->database();
						$this->load->library('session');
	          $this->load->model('Ansquick_model');
			}
			public function index(){
				//echo "asdas";
				$this->Ansquick_model->searchTags();
			//	$this->load->view('AnsQuick/aq.php');
			}
		}
?>
