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
						//			var_dump($topFeed);

					$data['questionDetails'] = $topFeed['questionDetails'];
					$data['pagination'] = $this->pagination->create_links();

						//var_dump($data);
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

					//var_dump($data);return ;
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
			public function profile($userName){
				if(!isset($userName)){
          redirect(base_url());
        }
				if($this->Ansquick_model->userNameExists($userName)){
					$query = $this->Ansquick_model->get_user($userName);
	        if($query->num_rows()>0){
	          $row = $query->result_array();

						//var_dump($row[0]);
						$tags = $this->Ansquick_model->getUserTags($row[0]['userID']);
						$data = array('userInfo' => $row[0],'userTags' => $tags );
						//var_dump($data);return ;
						$this->load->view('AnsQuick/profile',$data);
					}
				}
				else{
					redirect(base_url());
				}
			}
			public function editProfile(){
					if(!$this->session->userdata('userName')){
						redirect(base_url());
					}
					else{
						//var_dump($_POST); return;
						$data = array();
						if($this->input->post("name")=="profileFirstName"){
							$data['firstName'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileLastName"){
							$data['lastName'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileTitle"){
							$data['title'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileAboutMe"){
							$data['aboutMe'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileMobileNo"){
							$data['mobileNo'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileGender"){
							$data['gender'] = trim($this->input->post("value"));
						}
						else if($this->input->post("name")=="profileBirthday"){
							$data['dateOfBirth'] = trim($this->input->post("value"));
						}
						if($this->Ansquick_model->updateUser($data,$this->session->userdata('userName'))){
							echo "success";
						}
						else {
							echo "Error in updating";
						}
					}
			}

			public function editProfilePic(){
					if(!$this->session->userdata('userName')){
						redirect(base_url());
					}
					else{
							$config['upload_path']   = './Uploads/Profile/';
						  $config['allowed_types'] = 'gif|jpg|jpeg|png';
						  $config['max_size']      = 200;
						  $config['max_width']     = 1920;
						  $config['max_height']    = 1080;
							$config['overwrite'] = TRUE;
							$config['file_name'] 		 = $this->session->userdata('userID').".png";
						  $this->load->library('upload', $config);
							if ( ! is_dir($config['upload_path'])) {
		            die("The Upload Folder Does not exists");
		         	}
						  if ( !$this->upload->do_upload('profilePicFile')) {
						  	$error = array('error' => $this->upload->display_errors());
						    die($error['error']);
						  }
						  else {
								$uploadData=$this->upload->data();
								$fileName=$uploadData['file_name'];
								$data = array('profilePic'=>$fileName);
								$userName = $this->session->userdata('userName');
								if($this->Ansquick_model->updateUser($data,$userName))
									redirect(base_url("index.php/AnsQuick/profile/".$userName));
								else {
										echo "Error Uploading File";
								}
							}
					}

			}
			public function logout(){
   			$this->session->unset_userdata('userName');
   			$this->session->unset_userdata('loginUser');
        session_destroy();
				redirect(base_url());
			}
		}
?>
