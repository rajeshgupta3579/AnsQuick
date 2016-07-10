<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AddAnswer extends CI_Controller{
		public function __construct(){
			parent:: __construct();
			$this->load->model('Ansquick_model');
			$this->load->helper(array('form','url'));
			$this->load->library('session');
			$this->load->database();
			$this->load->model('Ansquick_model');
		}
	  public function index(){
				if(!$this->session->userdata('userID')){
					echo "noUser";
				}
				else {
							 $addAnswerText = $this->input->post('addAnswerText');
							 $questionID 		= $this->input->post('questionID');
							 $userID 				= $this->session->userdata('userID');
							 if($this->Ansquick_model->addAnswer($addAnswerText,$questionID,$userID)){
								 $this->addMailLog($questionID,$userID);
								 echo "true";
							 }
							 else {
									echo "false";
							 }

				}
	  }
		private function addMailLog($questionID,$answeredByUserID){
				$users = $this->Ansquick_model->getQuestionContributerEmails($questionID,$answeredByUserID);
				if(count($users)){
					$file = fopen(MAILER_LOG, 'a');
					$data = array();
					$answeredByUserName = $this->Ansquick_model->getUserName($answeredByUserID);
					foreach ($users as $user) {
						$data[] = implode(DELIMITER,array('emailID'=>$user['emailID'],'answeredByUserName'=>$answeredByUserName,'questionID'=>$questionID,'time'=>time()));
					}
					foreach ($data as $row) {
						fwrite($file, $row.PHP_EOL);
					}
					fclose($file);
			  }
	  }

}
?>
