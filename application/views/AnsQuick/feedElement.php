<div class="container">
  <!-- The row that contains the three main columns of the website. -->
  <div class="row">
    <!-- Left sidebar: A cell that spans 2 columns -->

    <div class="col-md-2">
      <?php
      if($this->session->userdata('userName')) {
        ?>
              <ul class="nav nav-pills nav-stacked">
              <li role="presentation"><a href="#">John Vilk</a></li>
              <li role="presentation">
                <a href="#"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>
              </li>
              <!-- List items that are just text are not indented, and look like the
                   Facebook section labels. -->
              <!-- The class "active" highlights this item in the list -->
              <li role="presentation" class="active">
                <a href="#"><span class="glyphicon glyphicon-list-alt"></span>   Top</a>
              </li>
              <!-- We can use badges in pills to add numbers beside them. -->
              <li role="presentation">
                <a href="#">
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
    <div class="col-md-7">
                  <!-- Status update #1 -->
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



                        <h4 class="media-heading">Media heading</h4>
                        Posted By <a href="#">Someone</a>
                         Yesterday at 3:48pm · Austin, TX
                      </div>
                    </div>
                  </div>

                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ui class="list-inline">
                      Tags :
                      <li><a href="#">c/c++</a></li>,
                      <li><a href="#">c/c++</a></li>,
                    </ul>
                  </div>
                </div>
                <!-- Post content -->
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <ul class ="list-inline">
                      <li>
                      <a href="#"><span class="glyphicon glyphicon-comment"></span> Write Answer</a>
                      </li>
                    </ul>


                  </div>
                </div>
              </div>

            <div class="panel-footer">
              <div class="row">
                <div class="col-md-12">
                  <a href="#">13 people</a> have answered
                </div>
              </div>
              <hr>
              <ul class="media-list">
                <li class="media">
                  <div class="media-left media-top">
                    PIC
                  </div>
                  <div class="media-body">
                    <a href="#">Someone Else</a> hope everything is ok!
                    <br><a href="#">Like</a> · <a href="#">Comment</a> · <span class="glyphicon glyphicon-thumbs-up"></span><span class="badge">5</span>
                  </div>
                </li>
                <li class="media">
                  <div class="media-left media-top">
                    PIC
                  </div>
                  <div class="media-body">
                    <a href="#">Someone Else</a> hope everything is ok!
                    <br><a href="#">Like</a> · <a href="#">Comment</a> · <span class="glyphicon glyphicon-thumbs-up"></span><span class="badge">5</span>
                  </div>
                </li>
                <li class="media">
                  <div class="media-left media-top">
                    PIC
                  </div>
                  <div class="media-body">
                    <div class="input-group">
                      <input type="text" class="form-control" id="addComment"placeholder="Write an answer...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                          <span class="glyphicon glyphicon-camera"></span>
                        </button>
                        <button class="btn btn-default" type="button">
                          ☺
                        </button>
                      </span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
              </div>
    </div>
    <!-- Right sidebar: A cell that spans 3 columns -->
    <div class="col-md-3">
      Right Sidebar
    </div>
  </div>
</div>
