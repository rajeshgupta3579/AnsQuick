<?php
class Ansquick_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function insertUser($data){
        return $this->db->insert('UserInfo', $data);
    }
    //get the username & password from tbl_usrs
     function get_user($userName){
          $sql = "select * from UserInfo where userName = '" .$userName."'OR emailID='".$userName."'";
          $query = $this->db->query($sql);
          return $query;
     }

     /*
     * A function to give suggestions of tags when user is posting a question
     * Input is taken from the request made by jquery
     * Output is list of suggestions in json format
     */
     function getTags(){


              if(!isset($_REQUEST['term']))
              exit();
              $sql = 'SELECT * FROM Tags WHERE tagName	LIKE "'.ucfirst($_REQUEST['term']).'%" ORDER BY tagID ASC	LIMIT 0,10';
              $query = $this->db->query($sql);
              $data = array();

              while($query->result() as $row)
              	$data[] = array(
              		'label' => $row['tagName'],
              		'value' => $row['tagName'],
              	);
              }

              echo json_encode($data);
              flush();

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
     function userExists($userName,$password){
          $query = $this->get_user($userName);
          if($query->num_rows()>0){
            $row = $query->result();
            $encryptedPassword = $this->encryptPassword($password,$row[0]->salt);
//            print_r($row);
            if($encryptedPassword==$row[0]->password){
              return 1;
            }
          }
          return 0;
     }
}
?>
