<?php
class Addquestion extends CI_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Ansquick_model');
		$this->load->library('session');
		$this->load->helper(array('form','url'));
		$this->load->model('Ansquick_model');

	}
  public function index(){
			if($this->session->userdata('userName')==null){
				redirect(base_url());
				/*echo "No user";
				exit();*/
			}
			else {
						 $question = $_GET['question'];
						 $category = $_GET['category'];
						 $tags = $_GET['tags'];
						 $tags = explode (",", $tags);

						 $userName = $this->session->userdata('userName');
						 $tagList = array();
						 $length = count($tags);
						 for($i=0;$i<$length;$i++){
							 $s= trim($tags[$i]);
							 if($s!="")
							 $tagList[$i]=$s;
						 }
						 $tagList = array_unique($tagList);
						 $questionID=$this->Ansquick_model->postQuestion($question,$category,$tagList,$userName);
						 redirect(base_url("index.php/Question/expand/".$questionID));
			}
  }
}
?>
