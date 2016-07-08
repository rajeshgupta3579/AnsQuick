<div id="content" style="margin-top:6%;padding-bottom:5%;">
<div class="container">
  <div class="row">

    <div class="col-md-2" style="position: fixed;left: 0;margin-top:2%">
      <?php
      if($this->session->userdata('userName')) {
        ?>
              <ul class="nav nav-pills nav-stacked">

              <li role="presentation">
                <a href="<?php echo base_url("index.php/AnsQuick/Profile/".$this->session->userdata('userName'));?>"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>
              </li>
              <li role="presentation">
                <a href="<?php echo base_url("index.php/AnsQuick/top");?>"><span class="glyphicon glyphicon-list-alt"></span> My Interests</a>
              </li>
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

    <div class="col-md-7" style="margin-left:180px">

                                <ul class="list-inline">
                                <li>
                                <h3>Question Details</h3>
                                  </li>
                                </ul>

              <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-10">
                    <div class="media">
                      <a class="media-left" href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['questionDiscription'][0]['userName']);?>">
                        <img src="<?php echo base_url("Uploads/Profile/".$questionDetails['questionDiscription'][0]['profilePic']);?>" style="margin-right:5px;height:60px;width:60px" />
                      </a>
                      <div class="media-body">
                        <p class="media-heading">
                        <a href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['questionDiscription'][0]['userName']);?>"><?php echo $questionDetails['questionDiscription'][0]['firstName']," ",$questionDetails['questionDiscription'][0]['lastName'];?></a></p>
                        <b><?php echo $questionDetails['questionDiscription'][0]['time'];?></b>
                        <br>
                        <?php $a= $questionDetails['questionDiscription'][0]['questionText'];
                              echo wordwrap($a,70,"<br>\n",TRUE);;
                        ?>
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
                            $tagsOfQuestion  = explode(DELIMITER,$tagsOfQuestion);
                            $tagIDOfQuestion = explode(DELIMITER,$tagIDOfQuestion);
                            for($j=0;$j<count($tagsOfQuestion);$j++){
                      ?>
                      <li><a href="<?php  echo base_url("index.php/tag/recent/".$tagsOfQuestion[$j])?>"><?php echo $tagsOfQuestion[$j]; ?></a><?php if($j!=count($tagsOfQuestion)-1)echo " , ";?></li>
                      <?php }?>
                    </ul>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ul class ="list-inline">
                      <li>
                      <a onclick="writeAnswerFocus(this)" id="writeAnswer<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" >
                        <span class="glyphicon glyphicon-comment"></span> Write Answer</a>
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
                                <a class="media-left" href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['answerDetails'][$k]['answerdByUserName']);?>">
                                  <img src="<?php echo base_url("Uploads/Profile/".$questionDetails['answerDetails'][$k]['answerdByPic']);?>" style="margin-right:5px;height:35px;width:35px" />
                                </a>
                                <div class="media-body">

                                  <a href="<?php echo base_url("index.php/AnsQuick/Profile/".$questionDetails['answerDetails'][$k]['answerdByUserName']);?>"><?php echo $questionDetails['answerDetails'][$k]['answerdBy'];?></a>
                                  <br><?php $a= $questionDetails['answerDetails'][$k]['answerText'];
                                    echo wordwrap($a,70,"<br>\n",TRUE);;
                                  ?>
                                  <br><?php echo $questionDetails['answerDetails'][$k]['answerTime']; ?> ·<a style="cursor: pointer;" id="likeAnswerButton<?php echo $questionDetails['answerDetails'][$k]['answerID'];?>" onclick="<?php if(in_array($questionDetails['answerDetails'][$k]['answerID'],$questionDetails['userLikes']))
                                    { echo "removeLike(this)";} else{echo "addLike(this)";}?>">
                                    <?php if(in_array($questionDetails['answerDetails'][$k]['answerID'],$questionDetails['userLikes'])) echo"Unlike"; else echo"Like"; ?></a> · <span class="glyphicon glyphicon-thumbs-up"></span>
                                    <span class="badge" id="likeCount<?php echo $questionDetails['answerDetails'][$k]['answerID'];?>"><?php echo $questionDetails['answerDetails'][$k]['likes']?></span>
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
    <div class="col-md-3" style="position: absolute;right: 0;">
      <img src="<?php echo base_url("Uploads/Ads/ad.jpg");?>" class="pull-left img-responsive" style="margin-right:5px; height:550px;width:300px;" />
    </div>
  </div>

  </div>
</div>
