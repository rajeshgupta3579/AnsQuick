<?php
   class Email_controller extends CI_Controller {

      function __construct() {
         parent::__construct();
      }
      public function index() {

        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'quickanswer16@gmail.com',
        'smtp_pass' => 'Jindal9@',
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
        );


        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

         $from_email = "quickanswer16@gmail.com";
         $to_email = "ashujindal92@gmail.com";

         $this->email->from($from_email, 'Your Name');
         $this->email->to($to_email);
         $this->email->subject('Email Test');
         $this->email->message('Testing the email class.');

         //Send mail
         if($this->email->send())
         echo "success";
         else echo "failure";
      }
   }
?>
