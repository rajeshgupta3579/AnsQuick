<?php
class Addquestion extends CI_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Ansquick_model');
		$this->load->library('session');

	}
  public function index(){
    	//$this->load->view('AnsQuick/aq');
			//echo "adad";
			if($this->session->userdata('userName')==null)
			{
				echo "No user";
				exit();
			}
			else {
						 $question = $_GET['question'];
						 $category = $_GET['category'];
						 $tags = $_GET['tags'];
						 $tags = explode (",", $tags);

						 $userName = $this->session->userdata('userName');
						 //echo $userName;
						 /*echo $question,"<br>",$category,"<br>",$tags,"<br>";
						 echo trim($chunks[0]),trim($chunks[1]);
						 print_r($chunks);
						 */
						 //print_r($tags);
						 $tagList = array();
						 $length = count($tags);
						 for($i=0;$i<$length;$i++){
							 $s= trim($tags[$i]);
							 if($s!="")
							 $tagList[$i]=$s;
						 }
						 //echo $tags[0],$tags[1];
						 //print_r($tagList);
						 $tagList = array_unique($tagList);
						 $this->Ansquick_model->postQuestion($question,$category,$tagList,$userName);

			}
  }
}
?>
