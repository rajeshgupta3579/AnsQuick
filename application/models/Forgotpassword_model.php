<?php
class Forgotpassword_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function get_user($userName){
          $sql = "select * from UserInfo where userName = '" .$userName."'OR emailID='".$userName."'";
          $query = $this->db->query($sql);
          return $query;
    }
     /*
     * Encrypts the user password.
     * Takes the user entered password as input and adds random salt to it and perform encryption.
     * Returns the encrypted password and generated salt.
     */
    function encryptPassword($password,$salt){
         $password 	=	utf8_encode($password);
         $saltEncoded= 	utf8_encode($salt);
         $password 	= 	md5($password);
         $password 	= 	md5($password ."". $saltEncoded);
         $password 	=	base64_encode($password);
         return $password;

     }
     /*
     *
     *
     *
     ***/
     function userExists($userName){
          $query = $this->get_user($userName);
          if($query->num_rows()>0){
            return 1;            
          }
          return 0;
     }
}
?>
