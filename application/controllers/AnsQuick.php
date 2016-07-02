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
				//var_dump($_REQUEST);
				//var_dump($_GET);
				/*	$start=0;$end=0;
					$topFeed = $this->Ansquick_model->getTopFeed($start,$end);
					//var_dump($recentFeed);
					$this->load->view('AnsQuick/index',$topFeed);
					*/
					$this->recent();
			}
			public function top(){
				if($this->session->userdata('userID')){
					$currentUserID = $this->session->userdata('userID');
					$start=0;$end=0;
					$topFeed = $this->Ansquick_model->getTopFeed($start,$end,$currentUserID);
					$topFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
					//var_dump($topFeed);
					$this->load->view('AnsQuick/index',$topFeed);
				}
				else{
					redirect(base_url(""));
				}
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
			public function success(){
				$this->load->view('AnsQuick/success');
			}
			public function error(){
				$this->load->view('AnsQuick/error');
			}
			public function about(){
				$this->load->view('AnsQuick/about');
			}
			public function profile(){
				$this->load->view('AnsQuick/profile');
			}
			public function logout(){
   			$this->session->unset_userdata('userName');
   			$this->session->unset_userdata('loginUser');
        session_destroy();
				redirect(base_url());
			}
		}
?>
