<?php
class Solr_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }



              /* This is for using the inbuild suggester of solr.

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

          }
          */


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
             $json= file_get_contents("http://localhost:8983/solr/collection1/select?q=tagName%3A*".$term."*&wt=json&indent=true");
             $obj=json_decode($json,true);
             $suggestions=$obj['response']['docs'];
             $tags = array();
             for($i=0;$i<count($suggestions);$i++){
               $tag  = $suggestions[$i]['tagName'][0];
               $tags[] = array('label'=>$tag,'value'=>$tag);
             }
             echo json_encode($tags);
             flush();
          }

          /*
          * A function to count the number of rows in recent tag feed.
          * Input is a specific tagID and output is number of rows.
          */
          function countRowsRecentTagFeed($tagID){
            $json= file_get_contents("http://localhost:8983/solr/collection2/select?q=tagID%3A".$tagID."&wt=json&indent=true");
            $obj=json_decode($json,true);
            $questions=$obj['response']['docs'];
            return count($questions);
          }

          /*
          * Return the question elements for current tag and current page number
          */
          function getRecentTagFeed($limit,$start,$tagID,$currentUserID){
              $json= file_get_contents("http://localhost:8983/solr/collection2/select?q=tagID%3A".$tagID."&start=".$start."&rows=".$limit."&wt=json&indent=true");
              $obj=json_decode($json,true);
              $questions=$obj['response']['docs'];
              for($i=0;$i<count($questions);$i++){
                  $tag_ids = implode(DELIMITER,$questions[$i]['tagID']);
                  $tag_names = implode(DELIMITER,$questions[$i]['tagName']);
                  $questions[$i]['tag_ids'] = $tag_ids;
                  $questions[$i]['tag_names'] = $tag_names;
                  $questions[$i]['questionID'] = $questions[$i]['id'];
              }
                  $follow=0;
                  if($currentUserID!="NoUser")
                  $follow = $this->Ansquick_model->doesFollow($tagID,$currentUserID);
                  $data=array(
                          'question'  =>  $questions,
                          );
                  $data =  $this->Ansquick_model->process_feed($data);
                  $data['questionDetails']['type']          = "getRecentTagFeed";
                  $data['questionDetails']['currentTagID']  = $tagID;
                  $data['questionDetails']['follow']        = $follow;
                  return $data;
           }
}
?>
