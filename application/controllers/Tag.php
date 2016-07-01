<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Tag extends CI_Controller {
			public function __construct(){
		        parent::__construct();

		        $this->load->helper(array('form','url'));
		        $this->load->database();
						$this->load->library(array('session', 'form_validation', 'email'));
		        $this->load->model('Ansquick_model');
			}
			function index(){
        redirect(base_url(""));
    	}
			function follow($tagID){
					if($this->session->userdata('userID')){
						$currentUserID = $this->session->userdata('userID');
						if(!$this->Ansquick_model->alradyFollows($currentUserID,$tagID)){
									//echo "not following";
									$this->Ansquick_model->makeFollow($currentUserID,$tagID);
									echo "now following";
						}
						else {
							echo "already follows";
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
            $recentFeed = $this->Ansquick_model->getRecentTagFeed($start,$end,$tagID,$currentUserID);
             var_dump($recentFeed);

						//echo $currentUserID;
            $this->load->view('AnsQuick/index',$recentFeed);
        }
      }
			function success(){
				redirect('AnsQuick/success');
			}

		}
?>
