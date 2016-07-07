<?php
if(!defined('BASEPATH'))exit ('No direct scripts allowed');
 class Activity extends CI_controller{
    public function __construct(){
      parent::__construct();

      $this->load->library('session');
      $this->load->helper(array('form','url'));
      $this->load->database();
      $this->load->model('Ansquick_model');
      $this->load->library('pagination');
    }
    public function index(){

      	if($this->session->userdata('userID')){


                $config = unserialize(Pagination_links);
                $currentUserID = $this->session->userdata('userID');
                $config['base_url'] = base_url('index.php/Activity/index');
                $config['total_rows'] = $this->Ansquick_model->countRowsAskedQuestion($currentUserID);
                $config['per_page'] = "1";
                $config["uri_segment"] = 3;
                $choice = $config["total_rows"]/$config["per_page"];
                $config["num_links"] = floor($choice);



                $this->pagination->initialize($config);
                $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $askedQuestion = $this->Ansquick_model->getAskedQuestion($config["per_page"], $data['page'],$currentUserID);
                $askedQuestion['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
                $data['questionDetails'] = $askedQuestion['questionDetails'];
                $data['pagination'] = $this->pagination->create_links();
                $this->load->view('AnsQuick/index',$data);
                //$this->load->view('AnsQuick/index',$askedQuestion);
      }
      else{
        redirect(base_url());
      }
    }
}
?>
