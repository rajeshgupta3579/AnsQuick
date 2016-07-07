<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Recent extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->library('session');
						$this->load->model('Ansquick_model');
						$this->load->library('pagination');
			}
			public function index(){
				$this->recent();
			}
			public function recent(){
					$currentUserID = $this->session->userdata('userID');
				  $start=0;$end=0;
					$recentFeed = $this->Ansquick_model->getRecentFeed($start,$end);
					$recentFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
					$this->load->view('AnsQuick/index',$recentFeed);
			}

		}
?>
