<?php// var_dump($questionDetails);
?>
<div class="container" style="margin-top:6%">
  <!-- The row that contains the three main columns of the website. -->
  <div class="row">
    <!-- Left sidebar: A cell that spans 2 columns -->

    <div class="col-md-2" style="position: fixed;left: 0;">
      <?php
      if($this->session->userdata('userName')) {
        ?>
              <ul class="nav nav-pills nav-stacked">

              <li role="presentation">
                <a href="#"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>
              </li>
              <!-- List items that are just text are not indented, and look like the
                   Facebook section labels. -->
              <!-- The class "active" highlights this item in the list -->
              <li role="presentation" class="active">
                <a href="<?php echo base_url("index.php/AnsQuick/top");?>"><span class="glyphicon glyphicon-list-alt"></span> My Interests</a>
              </li>
              <!-- We can use badges in pills to add numbers beside them. -->
              <li role="presentation">
                <a href="<?php echo base_url("index.php/AnsQuick/recent");?>">
                  <span class="glyphicon glyphicon-flash"></span> Recent Questions
                </a>
              </li>
              <li role="presentation">
                <a href="<?php echo base_url('index.php/Activity')?>"><span class="glyphicon glyphicon-calendar"></span> Posted Questions</a>
              </li>


            </ul>
            <?php } ?>
    </div>

    <!-- Main feed: A cell that spans 7 columns -->
    <div class="col-md-7" style="margin-left:180px">
                  <!-- Status update #1 -->

                                <ul class="list-inline">
                                <li>
                                <h3>Question Details</h3>
                                  </li>
                                </ul>

              <div class="panel panel-default">
              <div class="panel-body">
                <!-- Post metadata -->
                <div class="row">
                  <div class="col-md-10">
                    <div class="media">
                      <div class="media-left media-top">

                      </div>
                      <div class="media-body">


                        <ul class="list-inline"> <li><img src="<?php echo base_url("Uploads/Profile/".$questionDetails['questionDiscription'][0]['profilePic']);?>" class="img-rounded img-responsive" style="height:35px;width:35px" /> </li> <li><h4 class="media-heading"><?php echo $questionDetails['questionDiscription'][0]['questionText'];?></h4></li></ul>
                        Posted By <a href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['questionDiscription'][0]['userName']);?>"><?php echo $questionDetails['questionDiscription'][0]['firstName']," ",$questionDetails['questionDiscription'][0]['lastName'];?></a>
                         <?php echo $questionDetails['questionDiscription'][0]['time'];?>
                      </div>
                    </div>
                  </div>

                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="list-inline">
                      Tags :
                      <?php $tagsOfQuestion  = $questionDetails['tags'][0]['tag_names'];
                            $tagIDOfQuestion = $questionDetails['tags'][0]['tag_ids'];
                          //  echo $tagIDOfQuestion,"<br>";
                            $tagsOfQuestion  = explode(DELIMITER,$tagsOfQuestion);
                            $tagIDOfQuestion = explode(DELIMITER,$tagIDOfQuestion);
                          //  var_dump($tagIDOfQuestion);
                            for($j=0;$j<count($tagsOfQuestion);$j++){
                      ?>
                      <li><a href="<?php  echo base_url("index.php/tag/recent/".$tagIDOfQuestion[$j])?>"><?php echo $tagsOfQuestion[$j]; ?></a><?php if($j!=count($tagsOfQuestion)-1)echo " , ";?></li>
                      <?php }?>
                    </ul>
                  </div>
                </div>
                <!-- Post content -->
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ul class ="list-inline">
                      <li>
                      <a href="#addAnswerText<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>"><span class="glyphicon glyphicon-comment"></span> Write Answer</a>
                      </li>
                      <li>
                      <a href="<?php echo base_url('index.php/Question/expand/'.$questionDetails['questionDiscription'][0]['questionID']);?>"><span class="glyphicon glyphicon-comment"></span> View All Answers</a>
                      </li>
                    </ul>


                  </div>
                </div>
              </div>
            <div class="panel-footer">
              <div class="row">
                <div class="col-md-12">
                  <?php if($questionDetails['questionDiscription'][0]['answerCount']>0){?>
                  <a href="#"><?php echo $questionDetails['questionDiscription'][0]['answerCount'];?> people</a> have answered!!
                    <hr>
                    <?php for($k=0;$k<$questionDetails['questionDiscription'][0]['answerCount'];$k++){?>
                            <ul class="media-list">
                              <li class="media">
                                <div class="media-left media-top">
                                  <img src="<?php echo base_url("Uploads/Profile/".$questionDetails['answerDetails'][$k]['answerdByPic']);?>" class="img-rounded img-responsive" style="position:absolute;height:35px;width:35px" />
                                </div>
                                <div class="media-body">
                                  <a href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['answerDetails'][$k]['answerdByUserName']);?>"><?php echo $questionDetails['answerDetails'][$k]['answerdBy'];?></a> <?php echo $questionDetails['answerDetails'][$k]['answerText'];?>
                                  <br><?php echo $questionDetails['answerDetails'][$k]['answerTime']; ?> ·<a style="cursor: pointer;" id="likeAnswerButton<?php echo $questionDetails['answerDetails'][$k]['answerID'];?>" onclick="<?php if(in_array($questionDetails['answerDetails'][$k]['answerID'],$questionDetails['userLikes'])){ echo "removeLike(this)";} else{echo "addLike(this)";}?>"><?php if(in_array($questionDetails['answerDetails'][$k]['answerID'],$questionDetails['userLikes'])) echo"Unlike"; else echo"Like"; ?></a> · <span class="glyphicon glyphicon-thumbs-up"></span><span class="badge" id="likeCount<?php echo $questionDetails['answerDetails'][$k]['answerID'];?>"><?php echo $questionDetails['answerDetails'][$k]['likes']?></span>
                                  <div class="alert alert-danger" role="alert" id="likeAnswerError<?php echo $questionDetails['answerDetails'][$k]['answerID'];?>" hidden="true"> </div>
                                </div>
                              </li>
                                <hr>


                  <?php }}
                  else {?>
                    No answers yet!!
                    <hr>
                    <ul class="media-list">

                        <?php }?>
                        <li class="media">
                          <div class="media-left media-top">
                            <img src="<?php echo base_url("Uploads/Profile/".$this->session->userdata('profilePic'));?>" class="img-rounded img-responsive" style="position:absolute;height:35px;width:35px" />
                          </div>
                        <div class="media-body">

                          <div class="input-group">
                            <input type="text" class="form-control" id="addAnswerText<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" placeholder="Write an answer...">
                            <span class="input-group-btn" id="FeedElements">
                              <button class="btn btn-default" id="addAnswerSubmit<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" onclick="addAnswer(this)" type="button">
                                <span class="glyphicon glyphicon-ok"></span>
                              </button>

                            </span>

                          </div>
                          <div class="alert alert-danger" role="alert" id="addAnswerError<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" hidden="true"> </div>
                        </div>
                      </li>
                    </ul>


                </div>
              </div>


            </div>
              </div>
    </div>
    <!-- Right sidebar: A cell that spans 3 columns -->
    <div class="col-md-3">
      Right Sidebar
    </div>
  </div>

  </div>
