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
						$this->load->library('pagination');
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
									$config['base_url'] = base_url('index.php/AnsQuick/top');
									$config['total_rows'] = $this->Ansquick_model->countRowsTopFeed($currentUserID);
									$config['per_page'] = "1";
									$config["uri_segment"] = 3;
									$choice = $config["total_rows"]/$config["per_page"];
									$config["num_links"] = floor($choice);

								$config['full_tag_open'] = '<ul class="pagination">';
								$config['full_tag_close'] = '</ul>';
								$config['first_link'] = false;
								$config['last_link'] = false;
								$config['first_tag_open'] = '<li>';
								$config['first_tag_close'] = '</li>';
								$config['prev_link'] = '«';
								$config['prev_tag_open'] = '<li class="prev">';
								$config['prev_tag_close'] = '</li>';
								$config['next_link'] = '»';
								$config['next_tag_open'] = '<li>';
								$config['next_tag_close'] = '</li>';
								$config['last_tag_open'] = '<li>';
								$config['last_tag_close'] = '</li>';
								$config['cur_tag_open'] = '<li class="active"><a href="#">';
								$config['cur_tag_close'] = '</a></li>';
								$config['num_tag_open'] = '<li>';
								$config['num_tag_close'] = '</li>';

								$this->pagination->initialize($config);



								$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
								$topFeed = $this->Ansquick_model->getTopFeed($config["per_page"], $data['page'],$currentUserID);
								$topFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
					//var_dump($topFeed);

					$data['questionDetails'] = $topFeed['questionDetails'];
					$data['pagination'] = $this->pagination->create_links();


					$this->load->view('AnsQuick/index',$data);

				}
				else{
					redirect(base_url(""));
				}
			}
			public function recent(){

				//var_dump($_REQUEST);
				//var_dump($_GET);


									$config['base_url'] = base_url('index.php/AnsQuick/recent');
				        	$config['total_rows'] = $this->Ansquick_model->countRowsRecentFeed();
				        	$config['per_page'] = "2";
				        	$config["uri_segment"] = 3;
				        	$choice = $config["total_rows"]/$config["per_page"];
				        	$config["num_links"] = floor($choice);

								$config['full_tag_open'] = '<ul class="pagination">';
				        $config['full_tag_close'] = '</ul>';
				        $config['first_link'] = false;
				        $config['last_link'] = false;
				        $config['first_tag_open'] = '<li>';
				        $config['first_tag_close'] = '</li>';
				        $config['prev_link'] = '«';
				        $config['prev_tag_open'] = '<li class="prev">';
				        $config['prev_tag_close'] = '</li>';
				        $config['next_link'] = '»';
				        $config['next_tag_open'] = '<li>';
				        $config['next_tag_close'] = '</li>';
				        $config['last_tag_open'] = '<li>';
				        $config['last_tag_close'] = '</li>';
				        $config['cur_tag_open'] = '<li class="active"><a href="#">';
				        $config['cur_tag_close'] = '</a></li>';
				        $config['num_tag_open'] = '<li>';
				        $config['num_tag_close'] = '</li>';

								$this->pagination->initialize($config);


					$currentUserID = $this->session->userdata('userID');
					$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
					$recentFeed = $this->Ansquick_model->getRecentFeed($config["per_page"], $data['page']);
					$recentFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
					//var_dump($recentFeed);



					$data['questionDetails'] = $recentFeed['questionDetails'];
					$data['pagination'] = $this->pagination->create_links();


					$this->load->view('AnsQuick/index',$data);
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
