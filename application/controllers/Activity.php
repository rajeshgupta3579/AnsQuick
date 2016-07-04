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

                  $currentUserID = $this->session->userdata('userID');
                $config['base_url'] = base_url('index.php/Activity/index');
                $config['total_rows'] = $this->Ansquick_model->countRowsAskedQuestion($currentUserID);
                $config['per_page'] = "1";
                $config["uri_segment"] = 3;
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



              $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

          $askedQuestion = $this->Ansquick_model->getAskedQuestion($config["per_page"], $data['page'],$currentUserID);
          $askedQuestion['questionDetails']['userLikes'] = $this->Ansquick_model->getUserLikes($currentUserID);
        //  var_dump($askedQuestion);
        $data['questionDetails'] = $askedQuestion['questionDetails'];
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('AnsQuick/index',$data);
          //$this->load->view('AnsQuick/index',$askedQuestion);
      }
      else{
        redirect(base_url());
        //echo "not";
      }
    }
}
?>
