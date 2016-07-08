<?php
class Solr_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

         function searchTags(){


           if(!isset($_REQUEST['term'])){
              exit();
           }
             $term = $_REQUEST['term'];
             $json= file_get_contents("http://localhost:8983/solr/collection1/select?q=tagName%3A*".$term."*&wt=json&indent=true");
             $obj=json_decode($json,true);
            // var_dump($obj);

             $suggestions=$obj['response']['docs'];
            // var_dump($suggestions);
             $tags = array();
             for($i=0;$i<count($suggestions);$i++){
               $tag  = $suggestions[$i]['tagName'][0];
               $tags[] = array('label'=>$tag,'value'=>$tag);
             }
             //var_dump($tags);
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

          function countRowsRecentTagFeed($tagID){
            $json= file_get_contents("http://localhost:8983/solr/collection2/select?q=tagID%3A".$tagID."&wt=json&indent=true");
            $obj=json_decode($json,true);
            $questions=$obj['response']['docs'];
            return count($questions);
          }




          /*function getRecentTagFeed($limit,$start,$tagID,$currentUserID){
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
           $data =  $this->process_feed($data);
           $data['questionDetails']['type']          = "getRecentTagFeed";
         //  $data['questionDetails']['currentTag']    = $currentTag;
           $data['questionDetails']['currentTagID']  = $tagID;
           $data['questionDetails']['follow']        = $follow;
           return $data;
          }






*/


          function getRecentTagFeed($limit,$start,$tagID,$currentUserID){
              $json= file_get_contents("http://localhost:8983/solr/collection2/select?q=tagID%3A".$tagID."&start=".$start."&rows=".$limit."&wt=json&indent=true");
              $obj=json_decode($json,true);
              $questions=$obj['response']['docs'];
              //var_dump($questions);
              //var_dump(count($questions));
              for($i=0;$i<count($questions);$i++){
                //var_dump($i);
                  $tag_ids = implode(DELIMITER,$questions[$i]['tagID']);
                  $tag_names = implode(DELIMITER,$questions[$i]['tagName']);
                  $questions[$i]['tag_ids'] = $tag_ids;
                  $questions[$i]['tag_names'] = $tag_names;
                  $questions[$i]['questionID'] = $questions[$i]['id'];
              }
                  //var_dump($questions);
                  //$currentTag=$this->currentTag($tagID);
                  $follow=0;
                  if($currentUserID!="NoUser")
                  $follow = $this->doesFollow($tagID,$currentUserID);
                  //$result=$query->result_array();
                  //$result['type']="getRecentTagFeed";
                  $data=array(
                          'question'  =>  $questions,
                          );
                  $data =  $this->Ansquick_model->process_feed($data);
                  $data['questionDetails']['type']          = "getRecentTagFeed";
                  //  $data['questionDetails']['currentTag']    = $currentTag;
                  $data['questionDetails']['currentTagID']  = $tagID;
                  $data['questionDetails']['follow']        = $follow;
                //  var_dump($data);
                  return $data;
           }
}
?>
