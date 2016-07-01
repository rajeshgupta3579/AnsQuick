<?php
class AddAnswer extends CI_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Ansquick_model');
		$this->load->library('session');
		$this->load->database();

	}
  public function index(){
			if($this->session->userdata('userName')==null){
				echo "noUser";
			}
			else {
						 $addAnswerText = $this->input->post('addAnswerText');
						 $questionID 		= $this->input->post('questionID');
						 $userID = $this->session->userdata('userID');
						 if($this->Ansquick_model->addAnswer($addAnswerText,$questionID,$userID)){
							 echo "true";
						 }
						 else {
								echo "false";
						 }

			}
  }
}
?>
