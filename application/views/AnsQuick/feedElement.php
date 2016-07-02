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

    <?php /*loop is upto count-offset because there are three
            extra rows,  request type,currentTag,currentTagID, and follow flag.
            Last two rows are only for tag discription page
            */
      $offset=1;
      for($i=0;$i<count($questionDetails)-$offset;$i++) {
    ?>
    <div class="col-md-7" style="margin-left:180px">
                  <!-- Status update #1 -->

                    <?php if($questionDetails['type']=="getRecentTagFeed"&&$i==0){
                        $offset=4;
                        ?>
                        <ul class="list-inline">
                        <li >  <h3>Tag: <a href="#" id="<?php ?>"><?php echo $questionDetails['currentTag']; ?></a></h3><?php
                          ?></li>
                          <li class="pull-right">
                          <?php if($questionDetails['follow']){
                                    echo '<button type="button" class="btn btn-danger" id="currentTagID'.$questionDetails['currentTagID'].'" onclick="unFollow(this)"><span class="glyphicon glyphicon-remove" id="asdtagEvent"></span>Unfollow</button>';

                                            }
                                        else {
                                          echo '<button type="button" class="btn btn-success" id="currentTagID'.$questionDetails['currentTagID'].'" onclick="follow(this)"><span class="glyphicon glyphicon-ok" id="asdtagEvent"></span>Follow</button>';
                                        }
                                      ?>
                                    </li>
                        </ul>
                          <?php

                        }
                              if($questionDetails['type']=="getRecentFeed"&&$i==0) {
                                ?>
                                <ul class="list-inline">
                                <li>
                                <h3>Recent Questions</h3>
                                  </li>
                                </ul>
                                <?php
                              }
                              if($questionDetails['type']=="getTopFeed"&&$i==0) {
                                ?>
                                <ul class="list-inline">
                                <li>
                                <h3>Top Questions</h3>
                                  </li>
                                </ul>
                                <?php
                              }
                        ?>
              <div class="panel panel-default">
              <div class="panel-body">
                <!-- Post metadata -->
                <?php if(isset($questionDetails[$i])){?>
                <div class="row">
                  <div class="col-md-10">
                    <div class="media">
                      <div class="media-left media-top">
                        PIC
                      </div>
                      <div class="media-body">



                        <h4 class="media-heading"><?php echo $questionDetails[$i]['questionText'];?></h4>
                        Posted By <a href="#"><?php echo $questionDetails[$i]['firstName']," ",$questionDetails[$i]['lastName'];?></a>
                         <?php echo $questionDetails[$i]['time'];?>
                      </div>
                    </div>
                  </div>

                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="list-inline">
                      Tags :
                      <?php $tagsOfQuestion  = $questionDetails[$i]['tag_names'];
                            $tagIDOfQuestion = $questionDetails[$i]['tag_ids'];
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
                      <a href="#addAnswerText<?php echo $questionDetails[$i]['questionID'];?>"><span class="glyphicon glyphicon-comment"></span> Write Answer</a>
                      </li>
                      <li>
                      <a href="<?php echo base_url('index.php/Question/expand/'.$questionDetails[$i]['questionID']);?>"><span class="glyphicon glyphicon-comment"></span> View All Answers</a>
                      </li>
                    </ul>


                  </div>
                </div>
                <?php }
                else {
                ?>
                  No Questions yet.
                <?php }?>
              </div>
              <?php if(isset($questionDetails[$i])){?>
            <div class="panel-footer">
              <div class="row">
                <div class="col-md-12">
                  <?php if($questionDetails[$i]['answerCount']>0){?>
                  <a href="#"><?php echo $questionDetails[$i]['answerCount'];?> people</a> have answered!!
                    <hr>

                            <ul class="media-list">
                              <li class="media">
                                <div class="media-left media-top">
                                  PIC
                                </div>
                                <div class="media-body">
                                  <a href="#"><?php echo $questionDetails[$i]['answerdBy'];?></a> <?php echo $questionDetails[$i]['answerText'];?>
                                  <br><a href="#">Like</a> · <a href="#">Comment</a> · <span class="glyphicon glyphicon-thumbs-up"></span><span class="badge"><?php echo $questionDetails[$i]['likes']?></span>
                                </div>
                              </li>





                  <?php }
                  else {?>
                    No answers yet!!
                    <hr>
                    <ul class="media-list">                      
                        <?php }?>
                        <li class="media">
                          <div class="media-left media-top">
                            PIC
                          </div>
                        <div class="media-body">

                          <div class="input-group">
                            <input type="text" class="form-control" id="addAnswerText<?php echo $questionDetails[$i]['questionID'];?>" placeholder="Write an answer...">
                            <span class="input-group-btn" id="FeedElements">
                              <button class="btn btn-default" id="addAnswerSubmit<?php echo $questionDetails[$i]['questionID'];?>" onclick="addAnswer(this)" type="button">
                                <span class="glyphicon glyphicon-ok"></span>
                              </button>
                              <button class="btn btn-default" type="button">
                                ☺
                              </button>
                            </span>

                          </div>
                          <div class="alert alert-danger" role="alert" id="addAnswerError<?php echo $questionDetails[$i]['questionID'];?>" hidden="true"> </div>
                        </div>
                      </li>
                    </ul>


                </div>
              </div>


            </div>
            <?php }?>
              </div>
    </div>
    <?php }?>
  </div>
    <!-- Right sidebar: A cell that spans 3 columns -->
    <div class="col-md-3">
      Right Sidebar
    </div>
  </div>
</div>
