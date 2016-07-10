<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
class ContributerEmails extends CI_Controller{
		public function __construct(){
			parent:: __construct();
			$this->load->helper(array('form','url'));
		}

	  public function index(){
				if(!$this->input->is_cli_request()){
      		redirect(base_url());
  			}
	      $file = file_get_contents(MAILER_LOG);
	      file_put_contents(MAILER_LOG, "");
	      $data = explode(PHP_EOL,$file);
	      $contributers = array();
	      for($i=0;$i<count($data)-1;$i++){
	        $contributers[] = explode(DELIMITER,$data[$i]);
	      }
				$logFile = fopen(MAILED_TO_LOG, 'a');
	      foreach ($contributers as $contributer) {
	          $config = unserialize(EMAIL_CONFIG);
	          $this->load->library('email', $config);
	          $this->email->set_newline("\r\n");

	          $from_email = EMAIL_ADDRESS;
	          $this->email->from($from_email, HOST_NAME);
	          $this->email->to($contributer[0]);
	          $this->email->subject('New Answer Posted');
	          $message = NEW_ANSWER_MAIL_MESSAGE;
	          $this->email->message($message.base_url("index.php/Question/expand/".$contributer[2])." by the user: ".base_url("index.php/AnsQuick/profile/".$contributer[1])." on: ".date("d F Y H:i:s",$contributer[3]));
	          if($this->email->send()){
								fwrite($logFile, $contributer[0]." ".time().PHP_EOL);
						}
	    	}
				fclose($logFile);
	  }
}
?>
