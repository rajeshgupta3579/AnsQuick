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
       return $topTagID+1;
     }

     function topQuestionID(){
       $sql = "SELECT MAX(questionID) as maxQuestionID FROM Question";
       $query = $this->db->query($sql)->result();
       $result = $query[0]->maxQuestionID;
       return $result;
     }

     function insertQuestion($question,$userID,$categoryID){

       $topQuestionID=$this->topQuestionID();
       //echo $topTagID;
       $sql = "INSERT INTO Question (questionText,userID,categoryID) VALUES ('".$question."','".$userID."','".$categoryID."')";
       $query = $this->db->query($sql);
       return $topQuestionID+1;
     }

/*
* A function to fetch tagID of the tags which already exsists in the DB
*/
     function getTagsArray($tagList){

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
           return $tagsArray;
     }
/*
* A function to  return the categoryID of the selected Category
*/
     function getCategoryID($category){

          $sql = "SELECT categoryID FROM Category WHERE categoryName='".$category."'";
          $query = $this->db->query($sql);
          $result = $query->result();
          $categoryID = $result[0]->categoryID;
          return $categoryID;

     }
     /*
     * Returns the userID for a username
     */
     function getUserID($userName){
       $sql = "SELECT userID FROM UserInfo WHERE userName='".$userName."'";
       $query = $this->db->query($sql);
       $result = $query->result();
       $userID = $result[0]->userID;
       return $userID;
     }


     function insertQuestionTag($questionID,$tagID){

       $sql = "INSERT INTO QuestionTag (questionID,tagID) VALUES ('".$questionID."','".$tagID."')";
       $query = $this->db->query($sql);

     }
     /*
     *  A function to post question into the database
     *  Takes input the contents of a question like discription, category and tags attached
     *  Adds question to the database, if given tag are not present alreay then it is inserted as well.
     */
    function postQuestion($question,$category,$tagList,$userName){



      $tagsArray = $this->getTagsArray($tagList);
      $categoryID= $this->getCategoryID($category);
      $userID    = $this->getUserID($userName);
      print_r($tagsArray);
      echo "<br>",$categoryID,"<br>";
      print_r($tagList);


       $questionID=$this->insertQuestion($question,$userID,$categoryID);


       echo "<br>",$questionID,"<br>";
       $length = count($tagList);
       for($i=0;$i<$length;$i++){
         $temp_tag = $tagList[$i];
         //echo $temp_tag;
         $tagID=0;
         if(!isset($tagsArray[$temp_tag])){
            //echo "andar";
            $tagID=$this->insertTag($temp_tag);
         }
         else {
            $tagID=$tagsArray[$temp_tag];
         }
         echo $tagID;
         $this->insertQuestionTag($questionID,$tagID);

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


     /*
     * A function to return the latest answer of a question.
     * Takes questionID as an input
     * Return an array with details about an answer
     */
     function getAnswer($questionID){
          $query = "SELECT * from Answer WHERE questionID='".$questionID."' ORDER BY Answer.time DESC LIMIT 1";
          $answerDetails = $this->db->query($query)->result_array();
          $answerdBy="";
          if(count($answerDetails)>0){
          $answerdBy = $answerDetails[0]['userID'];
          $query = "SELECT firstName,lastName from UserInfo WHERE userID='".$answerdBy."'";
          $result = $this->db->query($query)->result_array();
          //var_dump($result);
          $answerdBy = $result[0]['firstName']." ".$result[0]['lastName'];
          $answerDetails[0]['answerdBy']=$answerdBy;
          }


          //var_dump($answerDetails);
          return $answerDetails;

     }
     /*
     * A function to process feed data into one array for each question
     * Input is data containing details about question and answer
     * Ouputs an aray with one row for each question
     */
     function process_feed($data){
        //var_dump($data);
        $questionDetails = $data['question'];
        $feed            = array();
      //  var_dump($questionDetails);
        for($i=0;$i<count($questionDetails);$i++){
          if($questionDetails[$i]['answerCount']>0){
                $questionID = $questionDetails[$i]['questionID'];
                $answerDetails = $this->getAnswer($questionID);
                $questionDetails[$i]['answerdBy']   =   $answerDetails[0]['answerdBy'];
                $questionDetails[$i]['likes']       =   $answerDetails[0]['likes'];
                $questionDetails[$i]['answerText']  =   $answerDetails[0]['answerText'];
                $questionDetails[$i]['answerTime']  =   $answerDetails[0]['time'];
          }
          else{
                $questionDetails[$i]['answerdBy']   =   "";
                $questionDetails[$i]['likes']       =   "";
                $questionDetails[$i]['answerText']  =   "";
                $questionDetails[$i]['answerTime']  =   "";
          }
        }
        //var_dump($answerDetails);
        //var_dump($questionDetails);
        $temp = array('questionDetails'=>$questionDetails);
        return $temp;

     }
     /*
     * A function to fetch recent feed from database
     */
     function getRecentFeed($start,$end){
       $query = $this->db->query("SELECT
                                  GROUP_CONCAT(a.tagID SEPARATOR '-|::|-') as tag_ids,
                                  GROUP_CONCAT(a.tagName SEPARATOR '-|::|-') as tag_names,
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic
                                  from
                                  Tags a,QuestionTag b,Question c,UserInfo d
                                  where
                                  a.tagID=b.tagID AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");

    /*   $ansQuery=$this->db->query("SELECT
                                        b.questionID,
                                        GROUP_CONCAT(a.answerID SEPARATOR '-|::|-') as answer_ids,
                                        GROUP_CONCAT(a.answerText SEPARATOR '-|::|-') as answers,
                                        GROUP_CONCAT(c.firstName SEPARATOR '-|::|-') as answeredBy
                                        from
                                        Answer a,Question b, UserInfo c
                                        where
                                        a.questionID = b.questionID AND
                                        c.userID     = a.userID
                                        GROUP BY (b.questionID)");
                                        */
       $data=array(
               'question'  =>  $query->result_array(),

               );
       $data =  $this->process_feed($data);
      // var_dump($data);
       return $data;
       //$query ="";
     }
}
?>
