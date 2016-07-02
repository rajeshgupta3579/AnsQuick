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
      * Returns true if currentUserID already follows current tagid
      * returns false otherwise
     */
     function alradyFollows($currentUserID,$tagID){
       $query=$this->db->query("SELECT * FROM Follow WHERE tagID='".$tagID."' AND userID='".$currentUserID."'");
       $result = $query->result_array();
       if(count($result)>0){
         return 1;
       }
       else return 0;
     }



     /*
      * Add a user tag relationship to the follow table
      *
     */
     function makeFollow($currentUserID,$tagID){
       $s = "INSERT INTO Follow(tagID,userID) VALUES('".$tagID."','".$currentUserID."')";
       //var_dump($s);
       $query = $this->db->query($s);
     }

     /*
      * Removes a user tag relationship from the follow table
      *
     */
     function makeUnFollow($currentUserID,$tagID){
       $s = "DELETE FROM Follow WHERE tagID='".$tagID."' AND userID ='".$currentUserID."'";
       //var_dump($s);
       $query = $this->db->query($s);
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
          $query          = "SELECT * from Answer WHERE questionID='".$questionID."' ORDER BY Answer.time DESC LIMIT 1";
          $answerDetails  = $this->db->query($query)->result_array();
          $answerdBy      = "";
          if(count($answerDetails)>0){
                                      $answerdBy = $answerDetails[0]['userID'];
                                      $query     = "SELECT firstName,lastName from UserInfo WHERE userID='".$answerdBy."'";
                                      $result    = $this->db->query($query)->result_array();
                                      $answerdBy = $result[0]['firstName']." ".$result[0]['lastName'];
                  $answerDetails[0]['answerdBy'] = $answerdBy;
                  //var_dump($result);
          }


          //var_dump($answerDetails);
          return $answerDetails;

     }
     /*
     * A function to return tags of a question
     * Input is questionID
     * Output is a string of tags with deliminater
     */
     function getTagsOfQuestion($questionID){

       $query = $this->db->query("SELECT
                                  GROUP_CONCAT(a.tagID SEPARATOR '".DELIMITER."') as tag_ids,
                                  GROUP_CONCAT(a.tagName SEPARATOR '".DELIMITER."') as tag_names
                                  from
                                  Tags a,QuestionTag b
                                  where
                                  a.tagID=b.tagID AND
                                  b.questionID='".$questionID."'
                                  GROUP BY(b.questionID)
                                ");
      //echo $questionID;
      //var_dump($query->result());
      $tagsOfQuestion = $query->result_array();
      //var_dump($tagsOfQuestion);
      return $tagsOfQuestion;
     }
     /*
     * A function to process feed data into one array for each question
     * Input is data containing details about question and answer
     * Ouputs an aray with one row for each question
     */
     function process_feed($data){
        //var_dump($data);
        $questionDetails =   $data['question'];
        $feed            =   array();
      //  var_dump($questionDetails);
        for($i=0;$i<count($questionDetails);$i++){

          $questionID      =   $questionDetails[$i]['questionID'];
          $tagsOfQuestion  =   $this->getTagsOfQuestion($questionID);

          if($questionDetails[$i]['answerCount']>0){

                $answerDetails                      =   $this->getAnswer($questionID);
                $questionDetails[$i]['answerdBy']   =   $answerDetails[0]['answerdBy'];
                $questionDetails[$i]['likes']       =   $answerDetails[0]['likes'];
                $questionDetails[$i]['answerText']  =   $answerDetails[0]['answerText'];
                $questionDetails[$i]['answerTime']  =   $answerDetails[0]['time'];
                $questionDetails[$i]['answerID']    =   $answerDetails[0]['answerID'];
          }
          else{
                $questionDetails[$i]['answerdBy']   =   "";
                $questionDetails[$i]['likes']       =   "";
                $questionDetails[$i]['answerText']  =   "";
                $questionDetails[$i]['answerTime']  =   "";
                $questionDetails[$i]['answerID']    =   "";
          }
        //  echo "1";
        //  var_dump($questionDetails);
        //  echo "2";
          $questionDetails[$i]['tag_names'] = $tagsOfQuestion[0]['tag_names'];
          $questionDetails[$i]['tag_ids']   = $tagsOfQuestion[0]['tag_ids'];
          //var_dump($questionDetails);

        }
        //var_dump($answerDetails);
        //var_dump($questionDetails);
        $temp = array('questionDetails'=>$questionDetails);
        return $temp;

     }
     /*
     * A function to return the tagName of currentTag
     * Takes Input a TagID
     * Returns a string containing the tagName
     */
     function currentTag($tagID){
       $query  = $this->db->query("SELECT tagName from Tags WHERE tagID='".$tagID."'");
       $result = $query->result_array();
       //var_dump ($result);
       $currentTag="noTag";
       //echo count($result);
       if(count($result)>0)
       $currentTag= $result[0]['tagName'];
      // echo "adasdassd",$currentTag;
       return $currentTag;

     }

     /*
     * A function to check if current user follows the current tag
     * Takes input the userID and tagID
     * returns a flag as 0 if does not follow pr 1 if follows
     */
     function doesFollow($tagID,$currentUserID)
     {
       $query  = $this->db->query("select * from Follow where tagID='".$tagID."' AND userID='".$currentUserID."'");
       $result = $query->result_array();
       //echo "<br>","<br>","<br>","<br>","<br>","<br>","<br>";
       //var_dump($result);
       if(count($result)>0)
       return 1;
       else return 0;

     }
     /*
     A function fetches recent feed from the database having tag as selected tag
     */
     function getRecentTagFeed($start,$end,$tagID,$currentUserID){
       //$tagID = (int)$tagID;
      // echo $tagID;
       $query = $this->db->query("SELECT

                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.tagID='".$tagID."' AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");
        $currentTag=$this->currentTag($tagID);
        $follow=0;
        if($currentUserID!="NoUser")
        $follow = $this->doesFollow($tagID,$currentUserID);
        //echo $follow;
        //echo $currentTag;
      //$result=$query->result_array();
      //$result['type']="getRecentTagFeed";
    //  var_dump($result);
      $data=array(
              'question'  =>  $query->result_array(),
              );
              //  var_dump($data);
      $data =  $this->process_feed($data);
      $data['questionDetails']['type']          = "getRecentTagFeed";
      $data['questionDetails']['currentTag']    = $currentTag;
      $data['questionDetails']['currentTagID']  = $tagID;
      $data['questionDetails']['follow']        = $follow;
      //var_dump($data);
      //echo $follow;
      return $data;
     }




     /*
     * A function to fetch recent feed from database
     */
     function getRecentFeed($start,$end){
       $query = $this->db->query("SELECT
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");

    /*   $ansQuery=$this->db->query("SELECT
                                        b.questionID,
                                        GROUP_CONCAT(a.answerID SEPARATOR '".DELIMITER."') as answer_ids,
                                        GROUP_CONCAT(a.answerText SEPARATOR '".DELIMITER."') as answers,
                                        GROUP_CONCAT(c.firstName SEPARATOR '".DELIMITER."') as answeredBy
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
       $data['questionDetails']['type']="getRecentFeed";
      // var_dump($data);
       return $data;
       //$query ="";
     }

     /*
     * A function to fetch recent feed from database
     */
     function getTopFeed($start,$end,$currentUserID){
       $query = $this->db->query("SELECT
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic
                                  from
                                  Follow a,QuestionTag b,Question c,UserInfo d
                                  where
                                  a.userID='".$currentUserID."' AND
                                  a.tagID = b.tagID AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");
       $data=array(
                    'question'  =>  $query->result_array(),
                  );
       $data =  $this->process_feed($data);
       $data['questionDetails']['type']="getTopFeed";
      // var_dump($data);
       return $data;
       //$query ="";
     }

     /*
     * A function to add an answer to a question.
     * Takes addAnswerText,questionID and userID as input
     * returns true
     */
     function addAnswer($addAnswerText,$questionID,$userID){
        $data=array(
            'userID'      =>  $userID,
            'answerText'  =>  $addAnswerText,
            'questionID'  =>  $questionID
        );
        $this->db->insert('Answer', $data);
        $this->db->set('answerCount', '`answerCount`+1', FALSE);
        $this->db->where('questionID', $questionID);
        $this->db->update('Question');
        return true;
     }

     /*
     * A function to add a like to an answer.
     * Takes answerID and userID as input
     * returns true
     */
     function addLike($answerID,$userID){
        $data=array(
            'userID'      =>  $userID,
            'answerID'    =>  $answerID
        );
        $this->db->insert('`Like`', $data);
        $this->db->set('likes', '`likes`+1', FALSE);
        $this->db->where('answerID', $answerID);
        $this->db->update('Answer');
        return true;
     }

     /*
     * A function to remove a like from an answer.
     * Takes answerID and userID as input
     * returns true
     */
     function removeLike($answerID,$userID){
        $query = $this->db->query("DELETE
                                    FROM `Like`
                                    WHERE
                                    userID = '".$userID."'
                                    AND
                                    answerID = '".$answerID."'
                                    ");
        $this->db->set('likes', '`likes`-1', FALSE);
        $this->db->where('answerID', $answerID);
        $this->db->update('Answer');
        return true;
     }

     /*
     * A function to return All the answers of a question.
     * Takes questionID as an input
     * Return an array with details about an answer
     */
     function getAllAnswer($questionID){
          $query          = "SELECT * from Answer WHERE questionID='".$questionID."' ORDER BY Answer.time DESC";
          $answerDetails  = $this->db->query($query)->result_array();
          $answerdBy      = "";
          for($i=0;$i<count($answerDetails);$i++){
                                      $answerdBy = $answerDetails[$i]['userID'];
                                      $query     = "SELECT firstName,lastName from UserInfo WHERE userID='".$answerdBy."'";
                                      $result    = $this->db->query($query)->result_array();
                                      $answerdBy = $result[0]['firstName']." ".$result[0]['lastName'];
                  $answerDetails[$i]['answerdBy'] = $answerdBy;
                  //var_dump($result);
          }


          //var_dump($answerDetails);
          return $answerDetails;

     }


     /*
     * A function to return only dicription of a question
     * Input is a questionID
     */

     function getquestionDetails($questionID){
       $query = $this->db->query("SELECT
                                  c.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic
                                  from
                                  Question c,UserInfo d
                                  where
                                  c.userID=d.userID AND
                                  c.questionID='".$questionID."'

                                ");
       $data=$query->result_array();
       return $data;
     }

     /*
     * A function which returns complete data about a question.
     * Input is a questionID
     */
     function expandQuestion($questionID){
                $tags                 = $this->getTagsOfQuestion($questionID);
                $answerDetails        = $this->getAllAnswer($questionID);
                $questionDiscription  = $this->getquestionDetails($questionID);
                $questionDetails      = array('questionDiscription'=>$questionDiscription,
                                              'tags'=>$tags,
                                              'answerDetails'=>$answerDetails
                                             );
                                $data = array("questionDetails"=>$questionDetails);
                return $data;

     }
     function getUserLikes($userID){
       $query = $this->db->query("SELECT
                                  GROUP_CONCAT(answerID SEPARATOR '".DELIMITER."') as answerIDs
                                  from
                                  `Like`
                                  where
                                  userID='".$userID."'
                                ");
       $data=$query->result_array();
       return explode(DELIMITER,$data[0]['answerIDs']);
     }
}
?>
