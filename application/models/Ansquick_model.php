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
          $sql = "select * from UserInfo where userName = '".$userName."'OR emailID='".$userName."'";
          $query = $this->db->query($sql);
          return $query;
     }

     /*
     * Returns the maximum tagID present in the database
     */
     function topTagID(){
        $sql = "SELECT MAX(tagID) as maxTagID FROM Tags";
        $query = $this->db->query($sql)->result();
        $result = $query[0]->maxTagID;
        return $result;
     }

     /*
     * A function to insert a new tag into database
     * Takes input a tag in string
     */
     function insertTag($tag){
       //echo $tag;
       $topTagID=$this->topTagID();
       //echo $topTagID;
       $sql = "INSERT INTO Tags (tagName) VALUES ('".$tag."')";
       $query = $this->db->query($sql);
       return $topTagID;
     }



     function insertQuestion($question){

       $topQuestionID=$this->topQuestionID();
       //echo $topTagID;
       $sql = "INSERT INTO Question () VALUES ('".$tag."')";
       $query = $this->db->query($sql);
       return $topTagID;
     }

     /*
     *  A function to post question into the database
     *  Takes input the contents of a question like discription, category and tags attached
     *  Adds question to the database, if given tag are not present alreay then it is inserted as well.
     */
    function postQuestion($question,$category,$tagList){



       $tagListQuery = implode("', '", $tagList);

       $sql  = "SELECT * FROM Tags WHERE tagName in ('$tagListQuery')";
       $query = $this->db->query($sql);
       $result=$query->result();

       $tagsArray = array();
       foreach ($result as $row){
         $tagName = $row->tagName;
         $tagID   = $row->tagID;
         $tagsArray[$tagName]= $tagID;
       }
       print_r($tagsArray);

       echo "<br>";
       $sql = "SELECT categoryId FROM Category WHERE categoryName='".$category."'";
       $query = $this->db->query($sql);
       $result = $query->result();
       $categoryId = $result[0]->categoryId;
       echo $categoryId,"<br>";


       print_r($tagList);
       $length = count($tagList);
       for($i=0;$i<$length;$i++){
         $temp_tag = $tagList[$i];
         echo $temp_tag;
         if(!isset($tagsArray[$temp_tag])){
            //echo "andar";
            $topTagID=$this->insertTag($temp_tag);

         }
       }

     }





     /*
     * A function to give suggestions of tags when user is posting a question
     * Input is taken from the request made by jquery
     * Output is list of suggestions in json format
     */
     function getTags(){
        //  echo "jkj,";
        //  die();

             if(!isset($_REQUEST['term'])){
               //$_REQUEST['term']='g';
               //echo "adad";
                exit();
             }

              $sql = 'SELECT * FROM Tags WHERE tagName	LIKE "'.ucfirst($_REQUEST['term']).'%" ORDER BY tagID ASC	LIMIT 0,10';
              $query = $this->db->query($sql);
              $data = array();

            /*  $data[] = array(
                'label' => 'nice',
                'value' => 'nice',
              );
              /*while($query->result() as $row)
              	$data[] = array(
              		'label' => $row['tagName'],
              		'value' => $row['tagName'],
              	);
              }*/
              $result=$query->result();
              //print_r($dd);
              foreach ($result as $row){
                $tag = $row->tagName;
                $data[] = array(
              		'label' => $tag,
              		'value' => $tag,
              	);
              //  echo $row->tagName;
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
     function userNameExists($userName){
          $query = $this->get_user($userName);
          if($query->num_rows()>0){
            return 1;
          }
          return 0;
     }
     function updateUser($data,$userName){
       $this->db->where('userName',$userName);
       return $this->db->update('UserInfo',$data);
     }
}
?>
