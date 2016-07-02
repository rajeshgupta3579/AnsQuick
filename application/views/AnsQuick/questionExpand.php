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
                <a href="<?php echo base_url("index.php/AnsQuick/top");?>"><span class="glyphicon glyphicon-list-alt"></span>   Top</a>
              </li>
              <!-- We can use badges in pills to add numbers beside them. -->
              <li role="presentation">
                <a href="<?php echo base_url("index.php/AnsQuick/recent");?>">
                  <span class="glyphicon glyphicon-flash"></span> Recent
                </a>
              </li>
              <li role="presentation">
                <a href="#"><span class="glyphicon glyphicon-calendar"></span> Activity</a>
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
                        PIC
                      </div>
                      <div class="media-body">



                        <h4 class="media-heading"><?php echo $questionDetails['questionDiscription'][0]['questionText'];?></h4>
                        Posted By <a href="#"><?php echo $questionDetails['questionDiscription'][0]['firstName']," ",$questionDetails['questionDiscription'][0]['lastName'];?></a>
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
                            $tagsOfQuestion  = explode('-|::|-',$tagsOfQuestion);
                            $tagIDOfQuestion = explode('-|::|-',$tagIDOfQuestion);
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
                                  PIC
                                </div>
                                <div class="media-body">
                                  <a href="#"><?php echo $questionDetails['answerDetails'][$k]['answerdBy'];?></a> <?php echo $questionDetails['answerDetails'][$k]['answerText'];?>
                                  <br><a href="#">Like</a> · <a href="#">Comment</a> · <span class="glyphicon glyphicon-thumbs-up"></span><span class="badge"><?php echo $questionDetails['answerDetails'][$k]['likes']?></span>
                                </div>
                              </li>
                              <li class="media">
                                <div class="media-left media-top">
                                  PIC
                                </div>



                  <?php }}
                  else {?>
                    No answers yet!!
                    <hr>
                    <ul class="media-list">
                      <li class="media">
                        <div class="media-left media-top">
                          PIC
                        </div>
                        <?php }?>
                        <div class="media-body">

                          <div class="input-group">
                            <input type="text" class="form-control" id="addAnswerText<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" placeholder="Write an answer...">
                            <span class="input-group-btn" id="FeedElements">
                              <button class="btn btn-default" id="addAnswerSubmit<?php echo $questionDetails['questionDiscription'][0]['questionID'];?>" onclick="addAnswer(this)" type="button">
                                <span class="glyphicon glyphicon-ok"></span>
                              </button>
                              <button class="btn btn-default" type="button">
                                ☺
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
  </div>
    <!-- Right sidebar: A cell that spans 3 columns -->
    <div class="col-md-3">
      Right Sidebar
    </div>
  </div>
</div>
