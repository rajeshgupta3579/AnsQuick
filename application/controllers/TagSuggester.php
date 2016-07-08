<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class TagSuggester extends CI_Controller {
			public function __construct(){
		        parent::__construct();
		        $this->load->helper(array('form','url'));
						$this->load->database();
						$this->load->library('session');
	          $this->load->model('Ansquick_model');
						$this->load->model('Solr_model');
			}
			public function index(){
				$methodName=suggestorMethod;
				if($methodName=="sql"){
					$this->Ansquick_model->getTags();
				}
				else if($methodName="solr"){
					$this->Solr_model->searchTags();
					//$this->Solr_model->questionDetails("ni");
				}
			}
		}
?>
