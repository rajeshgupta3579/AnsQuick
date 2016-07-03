<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Tag extends CI_Controller {
			public function __construct(){
		        parent::__construct();

		        $this->load->helper(array('form','url'));
		        $this->load->database();
						$this->load->library(array('session', 'form_validation', 'email'));
		        $this->load->model('Ansquick_model');
						$this->load->library('pagination');
			}
			function index(){
        redirect(base_url(""));
    	}
			/*
			A function which makes current user follow the tag with give tagID
			*/
			function follow($tagID){
					if($this->session->userdata('userID')){
						$currentUserID = $this->session->userdata('userID');
						if(!$this->Ansquick_model->alradyFollows($currentUserID,$tagID)){
									//echo "not following";
									$this->Ansquick_model->makeFollow($currentUserID,$tagID);
									echo "nowFollowing";
						}
						else {
							echo "alreadyFollows";
						}

					}
					else{
						echo "noUser";
					}
			}
			/*
			A function which makes current user Unfollow the tag with give tagID
			*/
			function Unfollow($tagID){
					if($this->session->userdata('userID')){
						$currentUserID = $this->session->userdata('userID');
						if($this->Ansquick_model->alradyFollows($currentUserID,$tagID)){
									//echo "not following";
									$this->Ansquick_model->makeUnFollow($currentUserID,$tagID);
									echo "nowNotFollowing";
						}
						else {
							echo "notFollowing";
						}

					}
					else{
						echo "noUser";
					}
			}
      function recent($tagID){
        if(!isset($tagID)){
          redirect(base_url(""));
        }
        else{

            $start=0;$end=0;
						$currentUserID="NoUser";
						if($this->session->userdata('userName')){
							$currentUserID=$this->session->userdata('userID');
						}
						$tagExsists = $this->Ansquick_model->currentTag($tagID);
						if($tagExsists=="noTag"){
							//echo $tagExsists;
							redirect(base_url(""));
						}

						$config['base_url'] = base_url('index.php/Tag/recent/'.$tagID);
						$config['total_rows'] = $this->Ansquick_model->countRowsRecentTagFeed($tagID);
						$config['per_page'] = "1";
						$config["uri_segment"] = 4;
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




							$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $recentFeed = $this->Ansquick_model->getRecentTagFeed($config["per_page"], $data['page'],$tagID,$currentUserID);
          //   var_dump($recentFeed);
						$recentFeed['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
						//echo $currentUserID;
						$data['questionDetails'] = $recentFeed['questionDetails'];
						$data['pagination'] = $this->pagination->create_links();
            $this->load->view('AnsQuick/index',$data);
        }
      }
			function success(){
				redirect('AnsQuick/success');
			}

		}
?>
