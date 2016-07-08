<?php
class Ansquick_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function insertUser($data){
        return $this->db->insert('UserInfo', $data);
    }
    //get the username & password from tbl_usrs
    function getUserDetails($userName){
          /*$this->db->where('userName', $userName);
          $q = $this->db->get('my_users_table');
          */
          $this->db->or_where(array('userName' => $userName, 'emailID' => $userName));
          $query = $this->db->get('UserInfo');
          return $query->result();
    }
    function getUserArray($userName){
          $this->db->or_where(array('userName' => $userName, 'emailID' => $userName));
          $query = $this->db->get('UserInfo');
          return $query->result_array();
    }

     /*
      * Returns true if currentUserID already follows current tagid
      * returns false otherwise
     */
     function alradyFollows($currentUserID,$tagID){
       $this->db->where(array('userID' => $currentUserID, 'tagID' => $tagID));
       $query = $this->db->get('Follow');
       //$query=$this->db->query("SELECT * FROM Follow WHERE tagID='".$tagID."' AND userID='".$currentUserID."'");
       $result = $query->result_array();
       if(count($result)>0){
         return 1;
       }
       else
         return 0;
     }


     /*
      * Add a user tag relationship to the follow table
     */
     function makeFollow($currentUserID,$tagID){
       $data=array(
           'tagID'      =>  $tagID,
           'userID'  =>  $currentUserID,
       );
       $this->db->insert('Follow', $data);
       /*$s = "INSERT INTO Follow(tagID,userID) VALUES('".$tagID."','".$currentUserID."')";
       //var_dump($s);
       $query = $this->db->query($s);
       */
     }

     /*
      * Removes a user tag relationship from the follow table
      *
     */
     function makeUnFollow($currentUserID,$tagID){
       $data=array(
           'tagID'      =>  $tagID,
           'userID'  =>  $currentUserID,
       );
       $this->db->delete('Follow', $data);
       /*$s = "DELETE FROM Follow WHERE tagID='".$tagID."' AND userID ='".$currentUserID."'";
       //var_dump($s);
       $query = $this->db->query($s);
       */
     }

     /*
     * Returns the userID for a username
     */
     function getUserID($userName){
         $query = $this->db->select("userID")->from("UserInfo")->where("userName", $userName)->get();

         /*$sql      = "SELECT userID FROM UserInfo WHERE userName='".$userName."'";
         $query    = $this->db->query($sql);
         */
         $result   = $query->result();
         $userID   = $result[0]->userID;
         return $userID;
     }


    /*
    * A function to check if current user follows the current tag
    * Takes input the userID and tagID
    * returns a flag as 0 if does not follow pr 1 if follows
    */
    function doesFollow($tagID,$currentUserID)
    {
      $this->db->where(array('userID' => $currentUserID, 'tagID' => $tagID));
      $query = $this->db->get('Follow');
      //      $query  = $this->db->query("select * from Follow where tagID='".$tagID."' AND userID='".$currentUserID."'");
      $result = $query->result_array();
      if(count($result)>0)
      return 1;
      else return 0;

    }
     /*
     *A function to check if the user has given the correct username and password combination
     */
     function userExists($userName,$password){
          $row = $this->getUserDetails($userName);
          if(count($row)){
            $encryptedPassword = $this->encryptPassword($password,$row[0]->salt);
            if($encryptedPassword==$row[0]->password){
              return 1;
            }
          }
          return 0;
     }
     function userNameExists($userName){
          $row = $this->getUserDetails($userName);
          if(count($row)){
            return 1;
          }
          return 0;
     }
     function updateUser($data,$userName){
       $this->db->where('userName',$userName);
       return $this->db->update('UserInfo',$data);
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

      /*
      * A function to remove a like from an answer.
      * Takes answerID and userID as input
      * returns true
      */
      function removeLike($answerID,$userID){
        $this->db->where(array('userID'=>$userID,'answerID'=>$answerID));
        $this->db->delete('`Like`');
         /*$query = $this->db->query("DELETE
                                     FROM `Like`
                                     WHERE
                                     userID = '".$userID."'
                                     AND
                                     answerID = '".$answerID."'
                                     ");*/
         $this->db->set('likes', '`likes`-1', FALSE);
         $this->db->where('answerID', $answerID);
         $this->db->update('Answer');
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
     * Returns the name of the based on the number of the month
     */
     /*function getMonth($monthNumber){
       $arr = array("1"=>"Jan",
                    "2"=>"Feb",
                    "3"=>"Mar",
                    "4"=>"Apr",
                    "5"=>"May",
                    "6"=>"Jun",
                    "7"=>"Jul",
                    "8"=>"Aug",
                    "9"=>"Sep",
                    "10"=>"Oct",
                    "11"=>"Nov",
                    "12"=>"Dec"
                  );
          //  return $arr[$monthNumber];

     }
     */
     /*
     * A function which returns the date from the timestamp
     * Input is a timestamp
     */
     /*
     function getDate($timee){
       $arr = explode(" ",$timee);
       $date= $arr[0];
       $date = explode("-",$date);
       $day  = $date[2];
       $month = $date[1];
       $year = $date[0];
       $date2 = $day.",".$month.",".$year;
        return $date2;

     }
     */
     /*
     * Returns the maximum tagID present in the database
     */
     /*function topTagID(){
        $sql = "SELECT MAX(tagID) as maxTagID FROM Tags";
        $query = $this->db->query($sql)->result();
        $result = $query[0]->maxTagID;
        return $result;
     }*/

     /*
     * A function to insert a new tag into database
     * Takes input a tag in string
     */
     function insertTag($tag){
       $data = array('tagName'=>$tag);
       $this->db->insert('Tags', $data);
       $insert_id = $this->db->insert_id();
       return  $insert_id;
     }

     /*function topQuestionID(){
         $sql = "SELECT MAX(questionID) as maxQuestionID FROM Question";
         $query = $this->db->query($sql)->result();
         $result = $query[0]->maxQuestionID;
         return $result;
     }*/

     function insertQuestion($question,$userID,$categoryID){
         $post_data = array('questionText'=>$question,'userID'=>$userID,'categoryID'=>$categoryID);
         $this->db->insert('Question', $post_data);
         $insert_id = $this->db->insert_id();


         return  $insert_id;
     }

    /*
    * A function to fetch tagID of the tags which already exsists in the DB
    */
     function getTagsArray($tagList){

           $tagListQuery = implode("', '", $tagList);
           $this->db->where_in('tagName', $tagListQuery);
           //$sql     = "SELECT * FROM Tags WHERE tagName in ('$tagListQuery')";
           $query   = $this->db->get('Tags');
           $result  = $query->result();

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

          $query = $this->db->select("categoryID")->from("Category")->where("categoryName", $category)->get();
          //$sql    = "SELECT categoryID FROM Category WHERE categoryName='".$category."'";
          //$query  = $this->db->query($sql);
          $result = $query->result();
          $categoryID = $result[0]->categoryID;
          return $categoryID;

     }



     function insertQuestionTag($questionID,$tagID){
       return $this->db->insert('QuestionTag', array('questionID' => $questionID, 'tagID'=>$tagID));
       //$sql = "INSERT INTO QuestionTag (questionID,tagID) VALUES ('".$questionID."','".$tagID."')";
       //$query = $this->db->query($sql);

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
      $questionID=$this->insertQuestion($question,$userID,$categoryID);
       $length   = count($tagList);
       for($i=0;$i<$length;$i++){
         $temp_tag = $tagList[$i];
         $tagID=0;
         if(!isset($tagsArray[$temp_tag])){
            $tagID=$this->insertTag($temp_tag);
         }
         else {
            $tagID=$tagsArray[$temp_tag];
         }
         $this->insertQuestionTag($questionID,$tagID);

       }
       return $questionID;

     }


          /*
          * A function to give suggestions of tags when user is posting a question
          * Input is taken from the request made by jquery
          * Output is list of suggestions in json format
          */
    function searchTags(){


      if(!isset($_REQUEST['term'])){
         exit();
      }
        $term = $_REQUEST['term'];
        $json= file_get_contents('http://localhost:8983/solr/collection1/suggest?suggest=true&suggest.build=true&suggest.dictionary=mySuggester&wt=json&suggest.q='.$term);
        $obj=json_decode($json,true);
        $suggestions=$obj['suggest']['mySuggester'][$term]['suggestions'];
        $tags = array();
        for($i=0;$i<count($suggestions);$i++){
          $tag  = $suggestions[$i]['term'];
          $tags[] = array('label'=>$tag,'value'=>$tag);
        }
        echo json_encode($tags);
        flush();
        /*$questionObj=$obj->response->docs;
        $noOfQuestion = count($questionObj);
        $questions = array();
        for($i=0;$i<$noOfQuestion;$i++){
          $question  = $questionObj[$i]->firstName;
          $questions[]=array("label"=>$question,"value"=>$question);
        }
      echo json_encode($questions);
      flush();
*/
     }


     /*
     * A function to give suggestions of tags when user is posting a question
     * Input is taken from the request made by jquery
     * Output is list of suggestions in json format
     */
     function getTags(){

             if(!isset($_REQUEST['term'])){
               //$_REQUEST['term']='g';
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
              foreach ($result as $row){
                $tagName = $row->tagName;
                $tagID   = $row->tagID;
                $data[] = array(
              		'label' => $tagName,
              		'value' => $tagName,
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
     * A function to return the latest answer of a question.
     * Takes questionID as an input
     * Return an array with details about an answer
     */
     function getAnswer($questionID){
          $query          = "SELECT * from Answer WHERE questionID='".$questionID."' ORDER BY Answer.time DESC LIMIT 1";
          $answerDetails  = $this->db->query($query)->result_array();
          $answerdBy      = "";
          if(count($answerDetails)>0){
                                      $answerdBy          = $answerDetails[0]['userID'];
                                      $query              = "SELECT userName,firstName,lastName,profilePic from UserInfo WHERE userID='".$answerdBy."'";
                                      $result             = $this->db->query($query)->result_array();
                                      $answerdBy          = $result[0]['firstName']." ".$result[0]['lastName'];
                                      $answerdByPic       = $result[0]['profilePic'];
                                      $answerdByUserName  = $result[0]['userName'];
                                      $answerTime         = $answerDetails[0]['time'];
                  $answerDetails[0]['answerdBy']          = $answerdBy;
                  //$answerTime = getDate($answerTime);;
                  $answerDetails[0]['answerTime']         = $answerTime;
                  $answerDetails[0]['answerdByPic']       = $answerdByPic;
                  $answerDetails[0]['answerdByUserName']  = $answerdByUserName;
          }

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
      $tagsOfQuestion = $query->result_array();
      return $tagsOfQuestion;
     }
     /*
     * A function to fetch tags and latest answer of a question and put data into an array fo
     * Input is data containing basic details about a question
     * Ouputs an aray with one row for each question
     */
     function process_feed($data){
        $questionDetails =   $data['question'];
        $feed            =   array();
        for($i=0;$i<count($questionDetails);$i++){

          $questionID      =   $questionDetails[$i]['questionID'];

          if(!isset($questionDetails[$i]['tag_names'])){
                $tagsOfQuestion  =   $this->getTagsOfQuestion($questionID);
                $questionDetails[$i]['tag_names'] = $tagsOfQuestion[0]['tag_names'];
                $questionDetails[$i]['tag_ids']   = $tagsOfQuestion[0]['tag_ids'];
          }

          if($questionDetails[$i]['answerCount']>0){

                $answerDetails                              =   $this->getAnswer($questionID);
                $questionDetails[$i]['answerdBy']           =   $answerDetails[0]['answerdBy'];
                $questionDetails[$i]['likes']               =   $answerDetails[0]['likes'];
                $questionDetails[$i]['answerText']          =   $answerDetails[0]['answerText'];
                $questionDetails[$i]['answerTime']          =   $answerDetails[0]['time'];
                $questionDetails[$i]['answerID']            =   $answerDetails[0]['answerID'];
                $questionDetails[$i]['answerdByPic']        =   $answerDetails[0]['answerdByPic'];
                $questionDetails[$i]['answerdByUserName']   =   $answerDetails[0]['answerdByUserName'];
          }
          else{
                $questionDetails[$i]['answerdBy']           =   "";
                $questionDetails[$i]['likes']               =   "";
                $questionDetails[$i]['answerText']          =   "";
                $questionDetails[$i]['answerTime']          =   "";
                $questionDetails[$i]['answerID']            =   "";
                $questionDetails[$i]['answerdByPic']        =   "";
                $questionDetails[$i]['answerdByUserName']   =   "";
          }



        }
        $temp = array('questionDetails'=>$questionDetails);
        return $temp;

     }
     /*
     * A function to return the tagName of currentTag
     * Takes Input a TagID
     * Returns a string containing the tagName
     */
     function currentTag($tagName){
       $query = $this->db->select("tagID")->from("Tags")->where("tagName", $tagName)->get();
       //$query  = $this->db->query("SELECT tagID from Tags WHERE tagName='".$tagName."'");
       $result = $query->result_array();
       $currentTag="noTag";
       if(count($result)>0)
       $currentTag= $result[0]['tagID'];
       return $currentTag;
     }
     /*
     * Returns total number of rows in the recent tag feed of a teg.
     */
     function countRowsRecentTagFeed($tagID){
       $query = $this->db->query("SELECT

                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.tagID='".$tagID."' AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");

      $result = $query->result_array();
      $numRows = count($result);
      return $numRows;
     }

     /*
     A function fetches recent feed from the database having tag as selected tag
     */
     function getRecentTagFeed($limit,$start,$tagID,$currentUserID){
       $query = $this->db->query("SELECT

                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.tagID='".$tagID."' AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                  limit " . $start . ", " . $limit
                                  );
        //$currentTag=$this->currentTag($tagID);
        $follow=0;
        if($currentUserID!="NoUser")
        $follow = $this->doesFollow($tagID,$currentUserID);
      //$result=$query->result_array();
      //$result['type']="getRecentTagFeed";
      $data=array(
              'question'  =>  $query->result_array(),
              );
      var_dump($data);
      $data =  $this->process_feed($data);
      $data['questionDetails']['type']          = "getRecentTagFeed";
    //  $data['questionDetails']['currentTag']    = $currentTag;
      $data['questionDetails']['currentTagID']  = $tagID;
      $data['questionDetails']['follow']        = $follow;
      var_dump($data);
      return $data;
     }


     /*
     * A function which returns number of total questions in RecentFeed
     */
     function countRowsRecentFeed(){
       $query = $this->db->query("SELECT
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                ");
      $result = $query->result_array();
      $numRows = count($result);
      return $numRows;
     }
     /*
     * A function to fetch recent feed from database
     */
     function getRecentFeed($limit,$start){
       $this->db->limit($limit,$start);
       $query = $this->db->query("SELECT
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  QuestionTag b,Question c,UserInfo d
                                  where
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                  limit " . $start . ", " . $limit
                                );

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
                                    //      var_dump("<br><br><br><br>");
       $data=array(
               'question'  =>  $query->result_array(),
               );
       $data =  $this->process_feed($data);
       $data['questionDetails']['type']="getRecentFeed";
       return $data;
     }


     /*
     * A function to return total number of questions in top feed of current user
     */
     function countRowsTopFeed($currentUserID){
       $query = $this->db->query("SELECT
                                  b.questionID
                                  from
                                  Follow a,QuestionTag b
                                  where
                                  a.userID='".$currentUserID."' AND
                                  a.tagID = b.tagID
                                  "
                                );
      $result = $query->result_array();
      $numRows = count($result);
      return $numRows;
     }
     /*
     * A function to fetch recent feed from database
     */
     function getTopFeed($limit,$start,$currentUserID){
       $query = $this->db->query("SELECT
                                  b.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  Follow a,QuestionTag b,Question c,UserInfo d
                                  where
                                  a.userID='".$currentUserID."' AND
                                  a.tagID = b.tagID AND
                                  b.questionID=c.questionID AND
                                  c.userID=d.userID
                                  GROUP BY(c.questionID)
                                  ORDER BY c.time DESC
                                  limit " . $start . ", " . $limit
                                );
       $data=array(
                    'question'  =>  $query->result_array(),
                  );
       $data =  $this->process_feed($data);
       $data['questionDetails']['type']="getTopFeed";
       return $data;
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
     * A function to return All the answers of a question.
     * Takes questionID as an input
     * Return an array with details about an answer
     */
     function getAllAnswer($questionID){
          $query          = "SELECT * from Answer WHERE questionID='".$questionID."' ORDER BY Answer.time DESC";
          $answerDetails  = $this->db->query($query)->result_array();
          $answerdBy      = "";
          for($i=0;$i<count($answerDetails);$i++){
                                      $answerdBy          = $answerDetails[$i]['userID'];
                                      $query              = "SELECT userName,firstName,lastName,profilePic from UserInfo WHERE userID='".$answerdBy."'";
                                      $result             = $this->db->query($query)->result_array();
                                      $answerdBy          = $result[0]['firstName']." ".$result[0]['lastName'];
                                      $answerdByPic       = $result[0]['profilePic'];
                                      $answerdByUserName  = $result[0]['userName'];
                                      $answerTime         = $answerDetails[0]['time'];
                  $answerDetails[$i]['answerdBy']         = $answerdBy;
                  $answerDetails[$i]['answerTime']        = $answerTime;
                  $answerDetails[$i]['answerdByPic']      = $answerdByPic;
                  $answerDetails[$i]['answerdByUserName'] = $answerdByUserName;
          }
          return $answerDetails;

     }


     /*
     * A function to return only dicription and stuff of a question
     * Input is a questionID
     */

     function getquestionDetails($questionID){
       $query = $this->db->query("SELECT
                                  c.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
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


     /*
     * A function to return the total number of questions asked by a user
     */
     function countRowsAskedQuestion($currentUserID){
       $query = $this->db->select("questionID")->from("Question")->where("userID", $currentUserID)->get();
       /*$query = $this->db->query("SELECT
                                  c.questionID
                                  from
                                  Question c
                                  where
                                  c.userID='".$currentUserID."'
                                ");*/
       $result = $query->result_array();
       $rows   = count($result);
       return $rows;
     }

     /*
     * A function which returns the current user Activity,  Questions ansked by the current user and answers posted.
     * Input is current user userID.
     * Output is a data variable which contains all the details about question asked by the current user.
     */
     function getAskedQuestion($limit,$start,$currentUserID){

       $query = $this->db->query("SELECT
                                  c.questionID,c.answerCount,c.questionText,c.time, d.firstName,d.lastName,d.profilePic,d.userName
                                  from
                                  Question c,UserInfo d
                                  where
                                  c.userID='".$currentUserID."' AND
                                  c.userID=d.userID
                                  ORDER BY c.time DESC
                                  limit " . $start . ", " . $limit
                                );
       $data=array(
                    'question'  =>  $query->result_array(),
                  );
       $data =  $this->process_feed($data);
       $data['questionDetails']['type']="getAskedQuestion";
       return $data;

     }
     /*
     * A function which returns the tagIDs and tagNames of tags followed by any user
     * Input is the userID.
     * Output is a data variable which contains the details of the tags followed by the user
     */
     function getUserTags($userID){
       $query = $this->db->query("SELECT
                                  b.tagName,a.tagID
                                  from
                                  Follow a,Tags b
                                  where
                                  a.userID= '".$userID."' AND
                                  b.tagID=a.tagID
                                ");
       return $query->result_array();
     }

     function getQuestionContributerEmails($questionID,$answeredByUserID){
         $query = $this->db->select("userID")->from("Question")->where("questionID", $questionID)->get();
         $row = $query->result_array();
         $userIDs = array();
         foreach ($row as $r) {
            $userIDs[] = $r['userID'];
         }
         // var_dump($row);
         $query = $this->db->select("userID")->from("Answer")->where("questionID", $questionID)->get();
         $row = $query->result_array();
         foreach ($row as $r) {
            $userIDs[] = $r['userID'];
         }
         $uniqueUsers = array_unique($userIDs, SORT_REGULAR);
         //var_dump($uniqueUsers);
         $answeredByUser = array();
         $answeredByUser[] = $answeredByUserID ;
         $uniqueUsers = array_diff($uniqueUsers,$answeredByUser);
         $query = $this->db->select("emailID")->from("UserInfo")->where_in("userID", $uniqueUsers)->get();
         return $query->result_array();
     }
}
?>
