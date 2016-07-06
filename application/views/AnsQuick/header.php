<!DOCTYPE html>
<html lang="en">
<head>
  <title>AnsQuick</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- x-editable (bootstrap version) -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>



  <style>
  #searchBox{
    width: 400px;
  }
  #searchButton{
    /*margin-left: 0px;*/
  }
  #post{
    /*margin-left: 10px;*/
  }
  #navbar{
    /*margin-left: 200px;
    margin-right: 200px;
    */
  }
  #leftSide{
    height: 100%;
  }
  .hr {
 margin-top: 5px;
 margin-bottom: 5px;
 /* The color of `hr` is set by its top border color.
    Yeah, it's weird. */
 border-top: 1px solid lightgray;
}
.list-inline {
  margin-bottom: 0px;
}
.panel-body {
  padding-bottom: 5px;
}

  </style>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default "  role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url();?>">AnsQuick</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="navbar-collapse-1">
    <ul class="nav navbar-nav">

      <li class="Category">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#" class="active">Business</a></li>
          <li class="divider"></li>
          <li><a href="#">Sports</a></li>
          <li class="divider"></li>
          <li><a href="#">Entertainment</a></li>
          <li class="divider"></li>
          <li><a href="#">Education</a></li>
        </ul>
      </li>
    </ul>
    <div class="col-sm-6 col-md-6">
        <form class="navbar-form" id="searchBoxForm" role="search" >
        <div class="input-group">
            <input id="searchBox" type="text" class="form-control searchBox" placeholder="Search a Tag" name="q">
            <div class="input-group-btn">
                <button class="btn btn-success " type="submit"  ><i class="glyphicon glyphicon-search"></i></button>

            </div>
        </div>
        </form>
    </div>
    <ul class="nav navbar-nav navbar-right" style="margin-right:50px">
      <li><a href="#postQuestion" data-toggle="modal">Post Question!!</a></li>
      <li><a href="<?php echo base_url('index.php/AnsQuick/about'); ?>">About</a></li>
      <?php
      if(!$this->session->userdata('userName')) {
        ?>
        <li><a href="#logIn" data-toggle="modal">Log In/Sign Up</a></li> </ul>
      <?php }  else{?>
        <li>
          <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <span class="glyphicon glyphicon-user"></span> 
                              <strong><?php echo $this->session->userdata('userName');?></strong>
                              <span class="glyphicon glyphicon-chevron-down"></span>
                          </a>
                          <ul class="dropdown-menu">
                              <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-10">
                                                <a href="<?php echo base_url("index.php/AnsQuick/profile/".$this->session->userdata('userName')); ?>" class="btn btn-block">Profile</a>
                                        </div>
                                    </div>
                              </li>
                              <li class="divider"></li>
                              <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-10">
                                                <a href="<?php echo base_url('index.php/AnsQuick/activity'); ?>" class="btn btn-block">Activity</a>
                                        </div>
                                    </div>
                              </li>
                              <li class="divider"></li>
                              <li>
                                  <div class="navbar-login navbar-login-session">
                                      <div class="row">
                                          <div class="col-lg-10">

                                                  <a href="<?php echo base_url('index.php/AnsQuick/logout'); ?>" class="btn btn-block">Logout</a>

                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </li>
                  </ul>

        </li>
        </ul>

    <?php }?>
  </div><!-- /.navbar-collapse -->
</nav>

<div class="modal fade" id="postQuestion" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4>Post a Question!!</h4>
      </div>
        <div class="modal-body">

          <form role="form" action="<?php echo base_url('index.php/Addquestion'); ?>" method ="get" id="postQuestionForm">

            <div class="form-group">
            <label for="cate">Select Category:&emsp;</label>
            <select class="selectpicker" id="category" name="category">
              <option disabled selected value> -- Select a Category -- </option>
              <option>Business</option>
              <option>Entertainment</option>
              <option>Sports</option>
              <option>Education</option>
            </select>
            <div class="alert alert-danger" role="alert" id="categoryError" hidden="true"> </div>
            </div>
               <div class="form-group">
                 <label for="question">Question:</label>
                  <textarea class="form-control" rows="3" id="question" placeholder="Type your Question" name="question"></textarea>
                  <div class="alert alert-danger" role="alert" id="questionError" hidden="true"> </div>
               </div>
               <div class="form-group">
                 <label for="tags">Tags:</label>
                 <input type="text" class="form-control" id="tags" placeholder="Enter ',' seperated tags" name="tags">
                 <div class="alert alert-danger" role="alert" id="tagsError" hidden="true"> </div>
               </div>
               <button type="submit" id="postQuestionSubmit" class="btn btn-success">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="logIn" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">

              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
                <li><a data-toggle="tab" href="#signup">SignUp</a></li>

              </ul>

              <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                        </br>
                        <?php
                          $attributes = array("class" => "form-horizontal", "id" => "loginForm", "name" => "loginForm","role"=>"form");
                          echo form_open("Login/success", $attributes);?>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="username">Username:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="userNameLogin" name="userName" placeholder="Enter Username or Email">
                            <div class="alert alert-danger" role="alert" id="userNameLoginError" hidden="true"> </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Enter password">
                            <div class="alert alert-danger" role="alert" id="passwordLoginError" hidden="true">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                              <label><input type="checkbox"> Remember me</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button id="loginSubmit" type="submit" class="btn btn-success">Submit</button>
                            <a  class="btn btn-success" type="button" href="<?php echo base_url('index.php/ForgotPassword/'); ?>"> Forgot Password</a>
                          </div>
                        </div>
                      <?php echo form_close(); ?>

                </div>
                <div id="signup" class="tab-pane fade">

                      </br>
                      <?php
                        $attributes = array("class" => "form-horizontal", "id" => "signUpForm", "name" => "signUpForm","role"=>"form");
                        echo form_open("Signup/success", $attributes);?>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="firstName">First Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName">
                              <div class="alert alert-danger" role="alert" id="firstNameError" hidden="true">

                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName">
                            <div class="alert alert-danger" role="alert" id="lastNameError" hidden="true">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="userName">Username:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="userName" name="userName"  placeholder="Enter Username">
                            <div class="alert alert-danger" role="alert" id="userNameError" hidden="true">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="emailID">Email ID:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="emailID" name="emailID"  placeholder="Enter Email">
                            <div class="alert alert-danger" role="alert" id="emailIDError" hidden="true">

                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <div class="alert alert-danger" role="alert" id="passwordError" hidden="true">

                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="confirmpwd">Confirm Password:</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password">
                            <div class="alert alert-danger" role="alert" id="cpasswordError" hidden="true">

                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button id="signUpSubmit" type="submit" class="btn btn-success" >Submit</button>
                          </div>
                        </div>
                      <?php echo form_close(); ?>


                </div>

              </div>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
