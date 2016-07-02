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
						$this->load->library('session');
						$this->load->model('Ansquick_model');
			}
			public function index(){
				$this->recent();
			}
			public function recent(){

				//var_dump($_REQUEST);
				//var_dump($_GET);
					$currentUserID = $this->session->userdata('userID');
				  $start=0;$end=0;
					$recentFeed = $this->Ansquick_model->getRecentFeed($start,$end);
					$recentFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
					//var_dump($recentFeed);
					$this->load->view('AnsQuick/index',$recentFeed);
			}

		}
?>
