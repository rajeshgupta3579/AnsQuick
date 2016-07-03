<?php
if(!defined('BASEPATH'))exit ('No direct scripts allowed');
 class Activity extends CI_controller{
    public function __construct(){
      parent::__construct();

      $this->load->library('session');
      $this->load->helper(array('form','url'));
      $this->load->database();
      $this->load->model('Ansquick_model');
    }
    public function index(){

      	if($this->session->userdata('userID')){
          $currentUserID = $this->session->userdata('userID');
          $askedQuestion = $this->Ansquick_model->getAskedQuestion($currentUserID);
          $askedQuestion['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
        //  var_dump($askedQuestion);
          $this->load->view('AnsQuick/index',$askedQuestion);
      }
      else{
        redirect(base_url());
        //echo "not";
      }
    }
}
?>
