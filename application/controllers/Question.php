<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Question extends CI_Controller {
			public function __construct(){
		        parent::__construct();

		        $this->load->helper(array('form','url'));
		        $this->load->database();
						$this->load->library(array('session', 'form_validation', 'email'));
		        $this->load->model('Ansquick_model');
			}
			function index(){
					redirect(base_url());
    	}
      function expand($questionID){
        if(!$questionID){
          redirect(base_url());
        }
        else{
            $data= $this->Ansquick_model->expandQuestion($questionID);
            //var_dump($data);
            $this->load->view('AnsQuick/question.php',$data);
        }
      }
			function success(){
				redirect('AnsQuick/success');
			}

		}
?>
