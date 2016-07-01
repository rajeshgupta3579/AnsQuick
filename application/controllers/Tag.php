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
      function recent($tagID){
        if(!isset($tagID)){
          redirect(base_url(""));
        }
        else{
            $start=0;$end=0;
						//$userName = $this->sessiondata->
            $recentFeed = $this->Ansquick_model->getRecentTagFeed($start,$end,$tagID);
            //var_dump($recentFeed);
            $this->load->view('AnsQuick/index',$recentFeed);
        }
      }
			function success(){
				redirect('AnsQuick/success');
			}

		}
?>
