<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Like extends CI_Controller{
      public function __construct(){
          parent::__construct();
          $this->load->library('session');
          $this->load->helper(array('form','url'));
          $this->load->database();
          //load the login model
          $this->load->model('Ansquick_model');
          $this->load->model('Ansquick_model');
      }
      public function index(){

      }
      public function addLike(){
          if(!$this->session->userdata('userID')){
               echo "noUser";
          }
          else {
               $answerID  = $this->input->post('answerID');
               $userID    = $this->session->userdata('userID');
               if($this->Ansquick_model->addLike($answerID,$userID)){
                 echo "true";
               }
               else {
                  echo "false";
               }
          }
       }
       public function removeLike(){
           if(!$this->session->userdata('userID')){
                echo "noUser";
           }
           else {
                $answerID  = $this->input->post('answerID');
                $userID    = $this->session->userdata('userID');
                if($this->Ansquick_model->removeLike($answerID,$userID)){
                  echo "true";
                }
                else {
                   echo "false";
                }
           }
        }
  }
?>
